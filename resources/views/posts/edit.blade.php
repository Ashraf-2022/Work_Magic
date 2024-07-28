@extends('layouts.app')
@section('title', 'Edit-Post')

@section('content')


    <div class="container">
        <div class="comment-form-wrap pt-5">

            <h3 class="mb-5">Update This Post</h3>
            <form action="{{ route('posts.Update', $update_post->id) }}" method="POST" class="p-5 bg-light"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" name="title" placeholder="Enter The Title " class="form-control" id="website"
                        value="{{ $update_post->title }}">
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <label for="Category">Choose Category</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected></option>
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
                    <label for="Description">Description</label>
                    <textarea placeholder="Type your description here ." name="description" id="Description" cols="30" rows="10"
                        class="form-control">{{ $update_post->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-outline-primary">
                </div>
            </form>

        </div>
    </div>
@endsection
