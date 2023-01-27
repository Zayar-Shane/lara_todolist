@extends('master')

@section('myContent')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="my-3">
                    <a href="{{ route('post#createPage') }}" class="text-decoration-none text-dark"><i
                            class="fa-solid fa-arrow-left"></i> back</a>
                </div>
                <h1 class="fs-2 mb-4">{{ $post->title }}</h1>
                <div class="d-flex">
                    <div class="btn btn-dark mx-2">
                        <i class="fa-solid fa-money-bill-1 text-primary"></i> {{ $post->price }}
                    </div>
                    <div class="btn btn-dark mx-2">
                        <i class="fa-solid fa-map-location text-danger"></i> {{ $post->address }}
                    </div>
                    <div class="btn btn-dark mx-2">
                        <i class="fa-solid fa-star text-warning"></i> {{ $post->rating }}
                    </div>
                    <div class="btn btn-dark mx-2"><i
                            class="fa-solid fa-calendar-day"></i>{{ $post->created_at->format('j-M-Y') }}</div>
                </div>
                <div class="my-3">
                    @if ($post->image == null)
                        <img src="{{ asset('404_image.png') }}" class="img-thumbnail">
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail">
                    @endif
                </div>
                <p class="text-muted">{{ $post->description }}</p>
            </div>
            <div class="row">
                <div class="col-3 offset-8 my-3">
                    <a href="{{ route('post#editPage', $post['id']) }}"><button class="btn btn-dark">Edit</button></a>
                </div>
            </div>

        </div>
    </div>
@endsection
