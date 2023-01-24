@extends('master')

@section('myContent')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5">
                <div class="my-3">
                    <a href="{{ route('post#createPage') }}" class="text-decoration-none text-dark"><i
                            class="fa-solid fa-arrow-left"></i> back</a>
                </div>
                <h1 class="fs-2">{{ $post->title }}</h1>
                <p class="text-muted">{{ $post->description }}</p>
                <div>
                    <span>
                        <i class="fa-solid fa-money-bill-1 text-primary"></i> {{ $post->price }} |
                    </span>
                    <span>
                        <i class="fa-solid fa-map-location text-danger"></i> {{ $post->address }} |
                    </span>
                    <span>
                        <i class="fa-solid fa-star text-warning"></i> {{ $post->rating }}
                    </span>
                </div>
                <div>{{ $post->created_at->format('j-F-Y') }}</div>
            </div>
            <div class="row">
                <div class="col-3 offset-8 my-3">
                    <a href="{{ route('post#editPage', $post['id']) }}"><button class="btn btn-dark">Edit</button></a>
                </div>
            </div>

        </div>
    </div>
@endsection
