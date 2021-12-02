@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success mb-2" href="{{ route('admin.categories.create') }}">Add category</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-5">Categories</div>

                    <div class="card-body">
                        <table class="table table-light table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th colspan="2">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr class="fs-6">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                           href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                        <form class="d-inline-block"
                                              action="{{ route('admin.categories.destroy', $category->id) }}"
                                              onsubmit="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No categories found.</td>
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
