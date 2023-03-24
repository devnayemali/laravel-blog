<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        $categories = Category::with('sub_categories')->where('status', 1)->orderBy('order_by', 'asc')->get();
        $tags = Tag::where('status', 1)->orderBy('order_by', 'asc')->get();
        $recent_posts = Post::where('is_approved', 1)->where('status', 1)->latest()->take(5)->get();
        View::share([
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts,
            ]
        );
    }
}
