@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-4 text-uppercase">{{ $post->title }}</div>

                    <div class="card-body">
                        <p>{!! nl2br($post->text) !!}</p>
                        <div class="d-flex">
                            @foreach($tags as $tag)
                            <button class="btn btn-outline-info me-3">{{ $tag->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


