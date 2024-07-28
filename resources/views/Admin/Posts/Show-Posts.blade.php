@extends('layouts.admin')
@section('title', 'Admin-Posts')
@section('content')
    @if (\Session::has('delete'))
        <div class="alert alert-success" role="alert" id="delete-alert">
            <p>{{ \Session::get('delete') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Posts</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Username</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin_posts as $posts)
                                <tr>
                                    <th scope="row">{{ $posts->id }}</th>
                                    <td>{{ $posts->title }}</td>
                                    <td>{{ $posts->category }}</td>
                                    <td>{{ $posts->username }}</td>
                                    <td><a href="{{ route('Admin.posts.delete', $posts->id) }}"
                                            class="btn btn-outline-danger  text-center ">delete</a></td>
                                    <td><a href="{{ route('posts.show', $posts->id) }}"
                                            class="btn btn-outline-primary  text-center ">Show</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
