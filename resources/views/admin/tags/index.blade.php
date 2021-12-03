@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success mb-2" href="{{ route('admin.tags.create') }}">Add tag</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header fs-5">Tags</div>

                    <div class="card-body">
                        <table class="table table-light table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th colspan="2">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tags as $tag)
                                <tr class="fs-6">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                           href="{{ route('admin.tags.edit', $tag->id) }}">Edit</a>
                                        <form class="d-inline-block"
                                              action="{{ route('admin.tags.destroy', $tag->id) }}"
                                              onsubmit="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No tags found.</td>
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
