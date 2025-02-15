<?php

namespace App\Repository\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface {
    public function getCategories(): Collection {
        return Category::all();
    }
}
