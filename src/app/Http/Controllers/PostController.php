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
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function index(IndexRequest $request): View
    {
        $params = $request->validated();

        $posts = $this->postService->getPaginatedAndFilteredPosts(
            $params['is_published'] ?? null,
            $params['category_id'] ?? null
        );
        $categories = $this->categoryService->getCategories();

        return view('post/index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function create(): View
    {
        $categories = $this->categoryService->getCategories();
        $tags = $this->tagService->getTags();

        return view('post/create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $post = $this->postService->store($request->validated());

        return redirect()->route('posts.show', [
            'post' => $post
        ]);
    }

    public function show(Post $post): View
    {
        return view('post/show', [
            'post' => $post
        ]);
    }

    public function edit(Post $post): View
    {
        $categories = $this->categoryService->getCategories();
        $tags = $this->tagService->getTags();

        return view('post/edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $postDTO = PostDTO::fromArray($request->validated());
        $this->postService->update($postDTO, $post);

        return redirect()->route('posts.show', [
            'post' => $post->id
        ]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->destroy($post);
        return redirect()->route('posts.index');
    }
}
