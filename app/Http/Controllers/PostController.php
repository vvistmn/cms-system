<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    
    public function index ()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show (Post $post)
    {
        return view('blog-post', ['post' => $post]);
    }

    public function create ()
    {
        return view('admin.posts.create');
    }

    public function store (Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required|unique:posts|min:8|max:255',
            'body' => 'required',
            'post_image' => 'mimes:jpg, jpeg,bmp,png'
        ]);
        
        if ($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
        }
        auth()->user()->posts()->create($inputs);

        return redirect('/admin');
    }

}
