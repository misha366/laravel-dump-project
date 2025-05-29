<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostService {
    public function getPaginatedAndFilteredPosts(array $postArrayData): LengthAwarePaginator {
        $validator = Validator::make($postArrayData, [
            'is_published' => 'nullable|boolean',
            'category_id' => 'nullable|integer|exists:categories,id'
        ]);
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        $query = Post::query();

        if (array_key_exists('is_published', $validated))
            $query->where('is_published', $validated['is_published']);

        if (array_key_exists('category_id', $validated))
            $query->where('category_id', $validated['category_id']);

        return $query->paginate(10);
    }

    public function store(array $postArrayData) : Post {

        $validator = Validator::make($postArrayData, [
            'title' => 'required|string|max:225',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'tag_ids' => 'nullable|array|max:1000',
            'tag_ids.*' => 'integer|exists:tags,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            return DB::transaction(function() use ($postArrayData) {
                $post = Post::create($postArrayData);
                if (!empty($postArrayData['tag_ids'])) {
                    $post->tags()->sync($postArrayData['tag_ids']);
                }
                return $post;
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to store the post, Transaction rolled back', 0, $e);
        }
    }

    public function update(array $postArrayData, Post $post) {

        $validator = Validator::make($postArrayData, [
            'title' => 'required|string|max:225',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'tag_ids' => 'nullable|array|max:1000',
            'tag_ids.*' => 'integer|exists:tags,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            return DB::transaction(function() use ($postArrayData, $post) {
                $post->update($postArrayData);
                if (!empty($postArrayData['tag_ids'])) {
                    $post->tags()->sync($postArrayData['tag_ids']);
                } else {
                    $post->tags()->detach();
                }
                return $post;
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to update the post, Transaction rolled back', 0, $e);
        }
    }

    public function destroy(Post $post): void {
        try {
            DB::transaction(function () use ($post) {
                $post->delete();
            });
        } catch (Throwable $e) {
            throw new Exception('Failed to destroy the post, Transaction rolled back', 0, $e);
        }
        
    }

}
