<?php

namespace App\Repository\Category;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface {
    public function getCategories(): Collection;
}
