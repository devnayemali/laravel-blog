<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('category', 'user', 'tag')->where('is_approved', 1)->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(5)->get();
        return view('frontend.modules.index', compact('posts', 'slider_posts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $all_posts = Post::with('category', 'user', 'tag')->where('is_approved', 1)->where('status', 1)->where('category_id', $category->id)->latest()->paginate(10);
        }
        $title = 'Post By Category';
        $sub_title = $category->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }


    public function sub_category($slug, $sub_slug){
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        if ($sub_category) {
            $all_posts = Post::with('category', 'user', 'tag')->where('is_approved', 1)->where('status', 1)->where('sub_category_id', $sub_category->id)->latest()->paginate(10);
        }
        $title = 'Post By Sub Category';
        $sub_title = $sub_category->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }


    public function tag($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $all_posts = Post::with('category', 'user', 'tag')->where('is_approved', 1)->where('status', 1)->where('category_id', $category->id)->latest()->paginate(10);
        }
        $title = 'Post By Category';
        $sub_title = $category->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }

    public function single()
    {
        return view('frontend.modules.single');
    }

    public function all_post()
    {
        $all_posts = Post::with('category', 'user', 'tag')->where('is_approved', 1)->where('status', 1)->latest()->paginate(10);

        $title = 'All Post';
        $sub_title = 'View All Post';
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }

    public function search(Request $request)
    {
        $data = $request->input('search');
        $all_posts = Post::with('category', 'user', 'tag')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('title', 'LIKE', '%' . $data . '%')
            ->latest()->paginate(10);

        $title = 'Search Result';
        $sub_title = $data;

        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }
}
