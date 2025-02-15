<?php

namespace App\Services;

use App\Repository\Tag\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TagService {
    private TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    public function getTags(): Collection {
        return $this->tagRepository->getTags();
    }
}
