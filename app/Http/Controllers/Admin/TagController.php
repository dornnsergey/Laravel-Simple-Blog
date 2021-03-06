<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\EditTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create($request->validated());

        return redirect()->route('admin.tags.index')->with('status', 'Tag has been successfully created.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(EditTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('admin.tags.index')->with('status', 'Tag has been successfully updated.');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts()->count()) {
            foreach ($tag->posts as $post) {
                $post->tags()->detach($tag);
            }
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')->with('status', 'Tag has been successfully deleted.');
    }
}
