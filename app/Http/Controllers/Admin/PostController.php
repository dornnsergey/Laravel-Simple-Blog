<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(CreatePostRequest $request)
    {

        if ($request->has('file')) {
            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('images', $filename, 'public');
        }

        $post = Post::create([
            'title'       => $request->title,
            'img'         => $filename ?? null,
            'text'        => $request->text,
            'category_id' => $request->category,
        ]);

        $tags = explode(',', $request->tags);

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post has been successfully created.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = $post->tags->implode('name', ',');

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(EditPostRequest $request, Post $post)
    {
        if ($request->has('file')) {
            Storage::delete('public/images/' . $post->img);

            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('images', $filename, 'public');
        }

        $post->update([
            'title'       => $request->title,
            'img'         => $filename ?? null,
            'text'        => $request->text,
            'category_id' => $request->category,
        ]);

        $tags = explode(',', $request->tags);

        $newTags = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            array_push($newTags, $tag->id);
        }

        $post->tags()->sync($newTags);

        return redirect()->route('admin.posts.index')->with('status', 'Post has been successfully updated.');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post has been successfully deleted.');
    }
}
