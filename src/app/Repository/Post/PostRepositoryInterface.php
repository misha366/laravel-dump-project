<?php

namespace App\Repository\Post;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface {
    public function getPaginatedAndFilteredPosts(
        ?bool $isPublished,
        ?int $categoryId
    ): LengthAwarePaginator;
    public function store(array $postArrayData): Post;
    public function update(array $postArrayData, Post $post): Post;
    public function destroy(Post $post): void;
}
