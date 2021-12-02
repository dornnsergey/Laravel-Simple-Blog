@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success mb-2" href="{{ route('admin.posts.create') }}">Add post</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-5">Posts</div>

                    <div class="card-body">
                        <table class="table table-light table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th colspan="2">Category</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr class="fs-6">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                           href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                        <form class="d-inline-block"
                                              action="{{ route('admin.posts.destroy', $post->id) }}"
                                              onsubmit="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">No posts found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
