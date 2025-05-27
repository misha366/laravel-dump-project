<?php

namespace App\Repository\Post;

use App\DTO\PostDTO;
use App\Exceptions\Post\PostDestroyException;
use App\Exceptions\Post\PostStoreException;
use App\Exceptions\Post\PostUpdateException;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PostRepository implements PostRepositoryInterface {
    public function getPaginatedAndFilteredPosts(
        ?bool $isPublished,
        ?int $categoryId
    ): LengthAwarePaginator {
        $query = Post::query();

        if (isset($isPublished)) $query->where('is_published', $isPublished);
        if (isset($categoryId)) $query->where('category_id', $categoryId);

        return $query->paginate(10);
    }
    public function store(array $postArrayData): Post {
        $post = Post::create($postArrayData);
        if (!empty($postArrayData['tag_ids'])) {
            $post->tags()->sync($postArrayData['tag_ids']);
        }
        return $post;
    }
    public function update(PostDTO $postDTO, Post $post): Post {
        try {
            return DB::transaction(function() use ($postDTO, $post) {
                $post->update(PostDTO::toArray($postDTO));
                $post->tags()->sync($postDTO->getTagIds());
                return $post;
            });
        } catch (Throwable $e) {
            $this->logPostError('FROM REPO: Transaction failed when updating a post.', $e);
            throw new PostUpdateException('Failed to update the post, Transaction rolled back', 0, $e);
        }
    }
    public function destroy(Post $post): void {
        try {
            DB::transaction(function () use ($post) {
                $post->delete();
            });
        } catch (Throwable $e) {
            $this->logPostError('FROM REPO: Transaction failed when destroying a post.', $e);
            throw new PostDestroyException('Failed to destroy the post, Transaction rolled back', 0, $e);
        }
    }

    private function logPostError(string $message, Throwable $e): void {
        Log::channel("post")->error($message, [
            "exception" => $e->getMessage(),
        ]);
    }
}
