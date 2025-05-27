<?php

namespace App\Repository\Post;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function update(array $postArrayData, Post $post): Post {    
        $post->update($postArrayData);
        if (!empty($postArrayData['tag_ids'])) {
            $post->tags()->sync($postArrayData['tag_ids']);
        } else {
            $post->tags()->detach();
        }
        return $post;
    }

    public function destroy(Post $post): void {
        $post->delete();
    }
}
