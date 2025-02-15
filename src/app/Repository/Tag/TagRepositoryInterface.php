<?php

namespace App\Repository\Tag;

use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface {
    public function getTags(): Collection;
}
