@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-4 text-uppercase">{{ $title }}</div>

                    <div class="card-body">
                        <div class="row mb-2">
                            @foreach($posts as $post)
                                <div class="col-md-4">
                                    @if($post->img)
                                        <img class="mb-2" src="{{ asset('storage/images/' . $post->img) }}" width="400"
                                             height="500">
                                    @else
                                        <img class="mb-2" src="https://via.placeholder.com/400x500">
                                    @endif
                                    <div class="d-flex justify-content-between">
                                        <div class="text-muted">{{ $post->created_at->format('d F Y') }}</div>
                                        <div class="text-primary">{{ $post->category->name }}</div>
                                    </div>
                                    <div class="text-center">
                                        <a class="fs-1 text-decoration-none"
                                           href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                    </div>
                                    <div>{{ $post->text }}</div>
                                </div>
                            @endforeach
                        </div>
                        @if(Request::is('posts'))
                            {{ $posts->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

