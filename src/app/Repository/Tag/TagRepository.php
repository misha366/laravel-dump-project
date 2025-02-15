<?php

namespace App\Repository\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository implements TagRepositoryInterface {
    public function getTags(): Collection {
        return Tag::all();
    }
}
