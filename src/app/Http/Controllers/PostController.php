<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
    ) {}

    public function index(IndexRequest $request): View
    {
        $params = $request->validated();

        $posts = $this->postService->getPaginatedAndFilteredPosts(
            $params['is_published'] ?? null,
            $params['category_id'] ?? null
        );
        $categories = Category::all();

        return view('post/index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

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
        $categories = Category::all();
        $tags = Tag::all();

        return view('post/edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($request->validated(), $post);

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
