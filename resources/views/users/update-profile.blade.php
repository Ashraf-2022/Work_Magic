@extends('layouts.app')
@section('title', 'Update-Profile')

@section('content')


    <div class="container">
        <div class="comment-form-wrap pt-5">


            @if (session('Update'))
                <div class="alert alert-success">
                    {{ session('Update') }}
                </div>
            @endif
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
            <h3 class="mb-5">Update Profile Data</h3>
            <form action="{{ route('users.update-profile', $user->id) }}" method="POST" class="p-5 bg-light"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="website" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="website" value="{{ $user->name }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="Bio">Bio</label>
                    <textarea name="bio" id="bio" cols="30" rows="10" class="form-control">{{ $user->bio }}</textarea>
                    @if ($errors->has('bio'))
                        <span class="text-danger">{{ $errors->first('bio') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-outline-secondary">
                </div>
            </form>

        </div>
    </div>
@endsection
