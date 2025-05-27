<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostService {
    public function getPaginatedAndFilteredPosts(?bool $isPublished, ?int $categoryId): LengthAwarePaginator {
        $query = Post::query();

        if (!is_null($isPublished)) $query->where('is_published', $isPublished);
        if (!is_null($categoryId)) $query->where('category_id', $categoryId);

        return $query->paginate(10);
    }

    public function store(array $postArrayData) : Post {
        try {
            return DB::transaction(function() use ($postArrayData) {
                $post = Post::create($postArrayData);
                if (!empty($postArrayData['tag_ids'])) {
                    $post->tags()->sync($postArrayData['tag_ids']);
                }
                return $post;
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to store the post, Transaction rolled back', 0, $e);
        }
    }

    public function update(array $postArrayData, Post $post) {
        try {
            return DB::transaction(function() use ($postArrayData, $post) {
                $post->update($postArrayData);
                if (!empty($postArrayData['tag_ids'])) {
                    $post->tags()->sync($postArrayData['tag_ids']);
                } else {
                    $post->tags()->detach();
                }
                return $post;
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to update the post, Transaction rolled back', 0, $e);
        }
    }

    public function destroy(Post $post): void {
        try {
            DB::transaction(function () use ($post) {
                $post->delete();
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to destroy the post, Transaction rolled back', 0, $e);
        }
        
    }

}
