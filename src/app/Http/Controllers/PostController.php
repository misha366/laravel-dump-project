<?php

namespace App\Http\Controllers;

use App\DTO\PostDTO;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\TagService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;
    private CategoryService $categoryService;
    private TagService $tagService;

    public function __construct(
        PostService $postService,
        CategoryService $categoryService,
        TagService $tagService
    ) {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    public function index(IndexRequest $request): void
    {
        $params = $request->validated();

        $posts = $this->postService->getPaginatedAndFilteredPosts(
            $params['is_published'] ?? null,
            $params['category_id'] ?? null
        );
        $categories = $this->categoryService->getCategories();

        dump([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function create(): void
    {
        $categories = $this->categoryService->getCategories();
        $tags = $this->tagService->getTags();

        dump([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(StoreRequest $request): void
    {
        $postDTO = PostDTO::fromArray($request->validated());
        $post = $this->postService->store($postDTO);
    }

    public function show(Post $post): void
    {
        dump([
            'post' => $post
        ]);
    }

    public function edit(Post $post): void
    {
        $categories = $this->categoryService->getCategories();
        $tags = $this->tagService->getTags();

        dump([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(UpdateRequest $request, Post $post): void
    {
        $postDTO = PostDTO::fromArray($request->validated());
        $this->postService->update($postDTO, $post);
    }

    public function destroy(Post $post): void
    {
        $this->postService->destroy($post);
    }
}
