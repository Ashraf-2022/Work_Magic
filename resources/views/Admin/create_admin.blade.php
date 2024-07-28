@extends('layouts.admin')
@section('title', 'Create-Admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email"
                                value="{{ old('email') }}" />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="form2Example2" class="form-control"
                                placeholder="username" value="{{ old('username') }}" />
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example3" class="form-control"
                                placeholder="password" />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-outline-primary mb-4 text-center">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
