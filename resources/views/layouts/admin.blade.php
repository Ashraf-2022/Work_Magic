<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar  fixed-top navbar-expand-lg " style="background-color: #fff;color:#000">
            <div class="container">
                <a class="navbar-brand" href="#">LOGO</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarText">
                    @auth('admins')
                        <ul class="navbar-nav side-nav">
                            {{-- <li class="nav-item">
                            <a class="nav-link text-white" style="margin-left: 20px;" href="index.html">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admins/admins.html" style="margin-left: 20px;">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories-admins/show-categories.html"
                                style="margin-left: 20px;">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="posts-admins/show-posts.html" style="margin-left: 20px;">Posts</a>
                        </li> --}}
                            <nav class="navbar-expand-lg">
                                <ul class="navbar-nav side-nav">
                                    <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                                    <li><a href="{{ route('admin.show') }}"><i class="fas fa-user"></i> Admins</a></li>
                                    <li><a href="{{ route('category.show') }}"><i class="fas fa-layer-group"></i>
                                            Categories</a></li>
                                    <li><a href="{{ route('Admin.posts.show-posts') }}"><i class="fas fa-signs-post"></i>
                                            Posts</a></li>
                                </ul>
                            </nav>
                        </ul>
                    @endauth
                    <ul class="navbar-nav ml-md-auto d-md-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @auth('admins')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::guard('admins')->user()->username }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">Login
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        @endauth


                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">


            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script type="text/javascript"></script>
</body>

</html>
