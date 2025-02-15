<?php

namespace App\Services;

use App\Repository\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService {
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): Collection {
        return $this->categoryRepository->getCategories();
    }
}
