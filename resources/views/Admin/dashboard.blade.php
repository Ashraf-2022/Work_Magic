@extends('layouts.admin')

@section('title', 'Admin-Dashboard')

@section('content')
    @if (\Session::has('delete'))
        <div class="alert alert-success" role="alert" id="delete-alert">
            <p>{{ \Session::get('delete') }}</p>
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alert = document.getElementById('delete-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 3000);
        });
    </script>
    @if (\Session::has('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ \Session::get('success') }}</p>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
                    <p class="card-text">{{ ucwords('number of posts') }}: {{ $posts_count }}</p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>

                    <p class="card-text">{{ ucwords('number of categories') }}: {{ $categories_count }} </p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admins</h5>

                    <p class="card-text">{{ ucwords('number of admins') }}: {{ $admins }} </p>

                </div>
            </div>
        </div>
    </div>
    <!--  <div class="row">
                                                    <div class="col">
                                                      <div class="card">
                                                        <div class="card-body">
                                                          <h5 class="card-title">Card title</h5>
                                                          <table class="table">
                                                <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">First</th>
                                                  <th scope="col">Last</th>
                                                  <th scope="col">Handle</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                  <th scope="row">1</th>
                                                  <td>Mark</td>
                                                  <td>Otto</td>
                                                  <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">2</th>
                                                  <td>Jacob</td>
                                                  <td>Thornton</td>
                                                  <td>@fat</td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">3</th>
                                                  <td>Larry</td>
                                                  <td>the Bird</td>
                                                  <td>@twitter</td>
                                                </tr>
                                                </tbody>
                                                </table> -->
@endsection
