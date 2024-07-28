@extends('layouts.admin')
@section('title', 'Create-Category')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Categories</h5>
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control"
                                placeholder="name" />
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" name="submit" class="btn btn-outline-primary  mb-4 text-center">create</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
