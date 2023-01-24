@extends('master')

@section('myContent')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5">
                <div class="my-3">
                    <a href="{{ route('post#updatePage', $post['id']) }}" class="text-decoration-none text-dark"><i
                            class="fa-solid fa-arrow-left"></i> back</a>
                </div>
                <form action="{{ route('post#update') }}" method="post">
                    @csrf
                    <input type="hidden" name="postID" value="{{ $post['id'] }}">
                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" name="postTitle"
                            class="form-control @error('postTitle')
                            is-invalid
                        @enderror"
                            placeholder="Enter Your Tasks..." value="{{ old('postTitle', $post['title']) }}">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="postDescription" cols="30" rows="10" placeholder="Write Your Tasks..."
                            class="form-control @error('postDescription')
                            is-invalid
                        @enderror">{{ old('postDescription', $post['description']) }}</textarea>
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mb-3">
                        <label for="">Post Fee</label>
                        <input type="number" name="postFee" value="{{ old('postFee', $post['price']) }}"
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
                        <input type="text" name="postAddress" value="{{ old('postAddress', $post['address']) }}"
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
                        <input type="number" name="postRating" value="{{ old('postRating', $post['rating']) }}"
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
                    <div class="float-end">
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
