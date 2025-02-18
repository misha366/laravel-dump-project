<?php

namespace App\Providers;

use App\Repository\Category\CategoryRepository;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Post\PostRepository;
use App\Repository\Post\PostRepositoryInterface;
use App\Repository\Tag\TagRepository;
use App\Repository\Tag\TagRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // after php artisan vendor:publish --tag=laravel-pagination
        Paginator::defaultView("vendor.pagination.bootstrap-5");

        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }
}
