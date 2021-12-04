@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-primary">Edit post</div>

                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                       value="{{ old('title', $post->title) }}" autocomplete="0" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File input</label>
                                <input class="form-control" type="file" id="file" name="file" value="{{ old('file') }}">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="category"
                                        name="category" required>
                                    <option value="0"> ---SELECT CATEGORY---</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags"
                                       value="{{ old('tags', $tags) }}" autocomplete="0" required>
                                @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Text</label>
                                <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text"
                                          autocomplete="0" required>{{ old('text', $post->text) }}</textarea>
                                @error('text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
