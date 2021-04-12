<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    
    public function index ()
    {
        $posts = Post::paginate(15);
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

        $request->session()->flash('message_posts', 'Запись была создана "' . $inputs['title'] . '"');

        return redirect()->route('post.index');
    }

    public function edit (Post $post)
    {
        $user = Auth::user();

        if ($user->can('update', $post)) {
            return view('admin.posts.edit', ['post' => $post]);
        } else {
            return back();
        }
    }

    public function update (Request $request, Post $post) {
        $user = Auth::user();

        if ($user->can('update', $post)) {
            $inputs = $request->validate([
                'title' => 'required|min:8|max:255',
                'body' => 'required',
                'post_image' => 'mimes:jpg, jpeg,bmp,png'
            ]);

            if (!empty($request->post_image)) {
                $inputs['post_image'] = $request->post_image->store('images');
            } else {
                $inputs['post_image'] = $post->post_image;
            }
            // $this->authoriza('update'); // Не работает

            $post->update($inputs);

            $request->session()->flash('message_posts', 'Запись была отредактирована "' . $inputs['title'] . '"');

            return redirect()->route('post.index');
        } else {
            Session::flash('message_posts', 'К сожалению, вы не можете изнить запись "' . $post->title . '"');
            return redirect(route('post.index'));
        }
    }

    public function destroy (Post $post) 
    {
        $post->delete();
        Session::flash('message_posts', 'Запись была удалена "' . $post->title . '"');
        return redirect(route('post.index'));
    }

}
