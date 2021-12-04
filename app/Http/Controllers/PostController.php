<?php

namespace App\Http\Controllers;


use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(6);
        $title = 'Posts';

        return view('posts.index', compact('posts', 'title'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $tags = $post->tags;

        return view('posts.show', compact('post', 'tags'));
    }
}
