@extends('layouts.app')
@section('title', 'Create-Post')

@section('content')


    <div class="container">
        <div class="comment-form-wrap pt-5">
            @if (\Session::has('error'))
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ \Session::get('error') }}</p>
                </div>
            @endif
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorAlert = document.getElementById('error-alert');
                    if (errorAlert) {
                        setTimeout(function() {
                            errorAlert.style.display = 'none';
                        }, 8000); // 8000 milliseconds = 8 seconds
                    }
                });
            </script>

            <h3 class="mb-5">Create a New Post</h3>
            <form action="{{ route('posts.store') }}" method="POST" class="p-5 bg-light" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" name="title" placeholder="Enter The Title " class="form-control" id="website"
                        value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected>Categories</option>
                    @foreach ($categories as $postCategory)
                        <option value="{{ $postCategory->name }}"
                            {{ old('category') == $postCategory->name ? 'selected' : '' }}>{{ $postCategory->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <br>
                <div class="form-group">
                    <label for="image">Choose The Image</label>
                    <input type="file" name="image" class="form-control" id="website">
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea placeholder="Type your description here ." name="description" id="Description" cols="30" rows="10"
                        class="form-control">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Submit" class="btn btn-outline-secondary">
                </div>
            </form>

        </div>
    </div>
@endsection
