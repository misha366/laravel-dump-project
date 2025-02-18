@extends('layouts.main')

@section('title', 'Edit #' . $post->id . ' post')

@section('content')
<x-errors.error-messages
    errTitle="Error Post"
    errSubtitle="Validation Error"
></x-errors.error-messages>

<form
    action="{{ route('posts.update', ['post' => $post->id]) }}"
    method="POST"
    class="container mt-4"
    novalidate
>
    @csrf
    @method("PATCH")
    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="mb-3 text-center">Edit Post #{{ $post->id }}</h3>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control"
                        value="{{ old("title", $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="3"
                            required>{{ old("content", $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" id="image" name="image" class="form-control"
                        value="{{ old("image", $post->image) }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">No Category</option>
                    @foreach($categories as $cat)
                        <option
                            value="{{ $cat->id }}"
                            @selected($cat->id === (int) old("category_id", $post->category_id))
                        >{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Tags</label>
                <select multiple name="tag_ids[]" class="form-select">
                    @php
                        /** @var \Illuminate\Support\ViewErrorBag $errors */
                        $isFirstAttempt = count($errors->all()) === 0;

                        $tagsFromDB = $post->tags?->pluck("id")->toArray() ?? [];
                        $tagsOld = array_map("intval", old("tag_ids", []));
                    @endphp
                    @foreach($tags as $tag)
                        <option
                            value="{{ $tag->id }}"
                            @selected(
                                ($isFirstAttempt && in_array($tag->id, $tagsFromDB))
                                ||
                                in_array($tag->id, $tagsOld)
                            )
                        >{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="submitBtn" class="btn btn-success w-100">Update</button>
        </div>
    </div>
</form>
@endsection
