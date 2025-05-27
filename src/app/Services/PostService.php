<?php

namespace App\Services;

use App\DTO\PostDTO;
use App\Models\Post;
use App\Repository\Post\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostService {
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function getPaginatedAndFilteredPosts(?bool $isPublished, ?int $categoryId): LengthAwarePaginator {
        return $this->postRepository->getPaginatedAndFilteredPosts($isPublished, $categoryId);
    }

    public function store(array $postArrayData) : Post {
        // try {
            return DB::transaction(function() use ($postArrayData) {
                return $this->postRepository->store($postArrayData);
            });
        // } catch (Throwable $e) {
        //     throw new Exception('Failed to store the post, Transaction rolled back', 0, $e);
        // }
    }

    public function update(PostDTO $postDTO, Post $post) {
        return $this->postRepository->update($postDTO, $post);
    }

    public function destroy(Post $post): void {
        $this->postRepository->destroy($post);
    }

}
