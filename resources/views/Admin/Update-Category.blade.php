@extends('layouts.admin')
@section('title', 'Update-Category')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                    <form method="POST" action="{{ route('admin.editcategory', $update_category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" value="{{ $update_category->name }}" id="form2Example1"
                                class="form-control" placeholder="name" />
                        </div>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <br>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
