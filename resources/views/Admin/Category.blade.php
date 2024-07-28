@extends('layouts.admin')
@section('title', 'Admin-Category')
@section('content')
    @if (\Session::has('Update'))
        <div id="alert" class="alert alert-success" role="alert">
            <p>{{ \Session::get('Update') }}</p>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alert = document.getElementById('alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 3000);
        });
    </script>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Categories</h5>
                    <a href="{{ route('category.create') }}" class="btn btn-outline-primary mb-4 text-center float-right">Create
                        Categories</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">update</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $category_1)
                                <tr>
                                    <th scope="row">{{ $category_1->id }}</th>
                                    <td>{{ $category_1->name }}</td>
                                    <td ><a href="{{ route('Admin.UpdateCategory', $category_1->id) }}"
                                            class="btn btn-outline-warning  text-center ">Update
                                        </a></td>
                                    <td><a href="{{ route('category.delete', $category_1->id) }}"
                                            class="btn btn-outline-danger  text-center ">Delete
                                        </a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
