@extends('layouts.main')

@section('title', 'Posts - Posts site')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Posts list</h2>
        <button class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            Filters
        </button>
    </div>
    <hr>
    @if(count($posts) === 0)
        <h3 class="no-posts-capture">No posts</h3>
    @endif
    @foreach($posts as $post)
        <h3 class="post__title">
            <a href="{{ route("posts.show", ["post" => $post->id]) }}">
                #{{ $post->id }} {{ $post->title }}
            </a>
            <a href="{{ route("posts.edit", ["post" => $post->id]) }}" class="post__link-edit">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form class="post__link-form" action="{{ route("posts.destroy", ["post" => $post->id]) }}"
                    method="POST">
                @csrf
                @method("delete")
                <button type="submit" class="post__link-trash btn btn-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </h3>
        <div class="mb-2">
            <i class="badge text-bg-primary text-wrap">
                {{  $post->category?->title ?? "No category" }}
            </i>

            <i class="badge text-bg-warning text-wrap">
                {{ count($post->tags) === 0 ?
                        "No tags" :
                        implode(", ", $post->tags->pluck("title")->toArray()) }}
            </i>
        </div>
        <div class="mb-4">{{ $post->content }}</div>
        <hr>
    @endforeach
    <div class="navigation">
        {{ $posts->withQueryString()->links() }}
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="/posts">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="is_published">
                        <option @selected(request("is_published") === NULL) value="">All</option>
                        <option @selected(request("is_published") === "1") value="1">Only published</option>
                        <option @selected(request("is_published") === "0") value="0">Only not published</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        <option value="">All categories</option>
                        @foreach($categories as $cat)
                            <option
                                value="{{ $cat->id }}"
                                @selected($cat->id === (int) request("category_id"))
                            >{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Apply</button>
            </form>
        </div>
    </div>
</div>
<x-common.addpostbutton></x-common.addpostbutton>
@endsection
