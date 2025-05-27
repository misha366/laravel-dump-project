<?php

namespace App\Services;

use App\Models\Post;
use App\Repository\Post\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostService {
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function getPaginatedAndFilteredPosts(?bool $isPublished, ?int $categoryId): LengthAwarePaginator {
        return $this->postRepository->getPaginatedAndFilteredPosts($isPublished, $categoryId);
    }

    public function store(array $postArrayData) : Post {
        try {
            return DB::transaction(function() use ($postArrayData) {
                return $this->postRepository->store($postArrayData);
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to store the post, Transaction rolled back', 0, $e);
        }
    }

    public function update(array $postArrayData, Post $post) {
        try {
            return DB::transaction(function() use ($postArrayData, $post) {
                return $this->postRepository->update($postArrayData, $post);
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to update the post, Transaction rolled back', 0, $e);
        }
    }

    public function destroy(Post $post): void {
        try {
            DB::transaction(function () use ($post) {
                $this->postRepository->destroy($post);
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to destroy the post, Transaction rolled back', 0, $e);
        }
        
    }

}
