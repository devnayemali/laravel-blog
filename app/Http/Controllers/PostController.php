<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'sub_category', 'user', 'tag')->latest()->paginate(20);
        return view('backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::where('status', 1)->select('name', 'id')->get();
        $categories = Category::where('status', 1)->pluck('name', 'id');
        return view('backend.modules.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $post_data = $request->except(['slug', 'tag_ids', 'photo']);

        $post_data['slug'] = Str::slug($request->input('slug'));
        // $post_data['user_id'] = Auth::user()->id;
        $post_data['user_id'] = 1;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 450;
            $width = 750;
            $thumb_height = 300;
            $thumb_width = 500;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumbnail/';

            // orginal image size upload
            // $post_data['photo'] = PhotoUploadController::imageUpload($name, $path, $file);

            // crop image upload
            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            // thumbnail image
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));
        session()->flash('cls', 'success');
        session()->flash('msg', 'Post Created Successfully.');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category', 'sub_category', 'user', 'tag');
        return view('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::where('status', 1)->select('name', 'id')->get();
        $categories = Category::where('status', 1)->pluck('name', 'id');
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id', 'id')->toArray();
        return view('backend.modules.post.edit', compact('post', 'categories', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post_data = $request->except(['slug', 'tag_ids', 'photo']);

        $post_data['slug'] = Str::slug($request->input('slug'));
        // $post_data['user_id'] = Auth::user()->id;
        $post_data['user_id'] = 1;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 450;
            $width = 750;
            $thumb_height = 300;
            $thumb_width = 500;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumbnail/';

            PhotoUploadController::imageUnlink($path, $post->photo);
            PhotoUploadController::imageUnlink($thumb_path, $post->photo);

            // crop image upload
            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            // thumbnail image
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));
        session()->flash('cls', 'success');
        session()->flash('msg', 'Post Updated Successfully.');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
