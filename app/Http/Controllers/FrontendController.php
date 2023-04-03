<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
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

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $all_posts = Post::with('category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('category_id', $category->id)
                ->latest()
                ->paginate(10);
        }
        $title = 'Post By Category';
        $sub_title = $category->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }


    public function sub_category(string $slug, string $sub_slug)
    {
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        if ($sub_category) {
            $all_posts = Post::with('category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('sub_category_id', $sub_category->id)
                ->latest()
                ->paginate(10);
        }
        $title = 'Post By Sub Category';
        $sub_title = $sub_category->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }


    public function tag(string $slug)
    {
        $tag = Tag::where('slug', $slug)->select('id', 'name')->first();
        $post_ids = DB::table('post_tag')->select('post_id')->where('tag_id', $tag->id)->distinct()->pluck('post_id');
        if ($tag) {
            $all_posts = Post::with('category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->whereIn('id', $post_ids)
                ->latest()
                ->paginate(10);
        }
        $title = 'Post By Tag';
        $sub_title = $tag->name;
        return view('frontend.modules.all_post', compact('all_posts', 'title', 'sub_title'));
    }

    public function all_post()
    {
        $all_posts = Post::with('category', 'user', 'tag')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->latest()
            ->paginate(10);

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


    public function single(string $slug)
    {
        $title = 'POST DETAILS';
        $sub_title = $slug;
        $post = Post::with('category', 'user', 'tag', 'comment', 'comment.user', 'comment.reply', 'post_count')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
        return view('frontend.modules.single', compact('post', 'title', 'sub_title'));
    }


    final public function contact_us()
    {
        $title = 'LET’S STAY IN TOUCH!';
        $sub_title = 'CONTACT US';
        return view('frontend.modules.contact', compact('title', 'sub_title'));
    }


    final public function postReadCount($post_id)
    {
        (new PostCountController($post_id))->postReadCount();
    }
}
