@extends('master')

@section('myContent')
    <div class="container">
        <div class="row mt-1">
            <div class="col-5">
                <div class="p-3">

                    @if (session('insertSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('insertSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}


                    <form action="{{ route('post#create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text"
                                class="form-control @error('postTitle')
                            is-invalid
                            @enderror"
                                name="postTitle" value="{{ old('postTitle') }}" placeholder="Enter Post Title ...">
                            @error('postTitle')
                                <div class="invalid-feedback">
                                    {{-- The postTitle field is required. --}}
                                    {{-- {{ $errors->first('postTitle') }} --}}
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Description</label>
                            <textarea name="postDescription"
                                class="form-control @error('postDescription')
                                is-invalid
                            @enderror"
                                cols="30" rows="7 " placeholder="Enter Post Description ...">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Image</label>
                            <input type="file" name="postImage"
                                class="form-control @error('postImage')
                                is-invalid
                            @enderror">
                            @error('postImage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Fee</label>
                            <input type="number" name="postFee" value="{{ old('postFee') }}"
                                class="form-control @error('postFee')
                                is-invalid
                            @enderror"
                                placeholder="Enter Your Post Fee...">
                            @error('postFee')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Fee</label>
                            <input type="text" name="postAddress" value="{{ old('postAddress') }}"
                                class="form-control @error('postAddress')
                                is-invalid
                            @enderror"
                                placeholder="Enter Your Address...">
                            @error('postAddress')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Rating</label>
                            <input type="number" name="postRating" value="{{ old('postRating') }}"
                                class="form-control @error('postRating')
                                is-invalid
                            @enderror"
                                max="5" min="0" placeholder="Enter Your Post Rating...">
                            @error('postRating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input type="submit" value="Create" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 p-3">
                <div class="row mb-2">
                    <h1 class="fs-4 col-4">
                        Total Data - {{ $posts->total() }}
                    </h1>
                    <div class="col-7 offset-1">
                        <form action="{{ route('post#createPage') }}" method="GET">
                            <div class="d-flex">
                                <input type="text" name="searchKey" class="form-control"
                                    value="{{ request('searchKey') }}" placeholder="Enter Your Search Key...">
                                <button type="submit" class="btn btn-danger"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="data-container">

                    @foreach ($posts as $item)
                        <div class="post p-3 shadow-sm rounded mb-3 bg-light">
                            <div class="row">
                                <h5 class="col-6">{{ $item->title }}</h5>
                                <div class="col-5 offset-1">{{ $item->created_at->format('j-F-Y h:s A') }}</div>
                            </div>
                            {{-- <p class="text-muted">{{ substr($item['description'], 0, 100) }}</p> --}}
                            <p class="text-muted"> {{ Str::words($item->description, 20, '...') }} </p>
                            <div>
                                <span>
                                    <i class="fa-solid fa-money-bill-1 text-primary"></i> {{ $item->price }} |
                                </span>
                                <span>
                                    <i class="fa-solid fa-map-location text-danger"></i> {{ $item->address }} |
                                </span>
                                <span>
                                    <i class="fa-solid fa-star text-warning"></i> {{ $item->rating }}
                                </span>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('post#delete', $item->id) }}">
                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                        ဖျက်ရန်</button>
                                </a>
                                {{-- <form action="{{ route('post#delete', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> ဖျက်ရန်</button>
                                </form> --}}
                                <a href="{{ route('post#updatePage', $item->id) }}">
                                    <button class="ms-1 btn btn-primary btn-sm"><i class="fa-solid fa-file-lines"></i>
                                        အသေးစိတ်ကြည့်ရန်</button>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    @endsection
