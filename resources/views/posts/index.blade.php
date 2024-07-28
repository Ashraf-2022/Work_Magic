@extends('layouts.app')

@section('content')
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <div class="container" style="text-decoration: none">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close">
                    <span class="icofont-close js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <!-- Start retroy layout blog posts -->
        <section class="section bg-light">
            <div class="container">
                <div class="row align-items-stretch retro-layout">
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
                        <div id="alert" class="alert alert-success" role="alert">
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

                    <div class="col-md-4">
                        @foreach ($post as $posts)
                            <a href="{{ route('posts.show', $posts->id) }}" class="h-entry mb-30 v-height gradient">
                                <div class="featured-img"
                                    style="background-image: url({{ asset('assets/images/' . $posts->image) }});">
                                </div>
                                <div class="text">
                                    <span class="date">{{ $posts->created_at->format('M. d, Y') }}</span>
                                    <h2>{{ $posts->title }}</h2>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @foreach ($post_2 as $posting)
                            <a href="{{ route('posts.show', $posting->id) }}" class="h-entry img-5 h-100 gradient">
                                <div class="featured-img"
                                    style="background-image: url({{ asset('assets/images/' . $posting->image) }});">
                                </div>
                                <div class="text">
                                    <span class="date">{{ $posting->created_at->format('M. d, Y') }}</span>
                                    <h2>{{ $posting->title }}</h2>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        @foreach ($post_3 as $NewPost)
                            <a href="{{ route('posts.show', $NewPost->id) }}" class="h-entry mb-30 v-height gradient">
                                <div class="featured-img"
                                    style="background-image: url({{ asset('assets/images/' . $NewPost->image . '') }});">
                                </div>
                                <div class="text">
                                    <span class="date">{{ $NewPost->created_at->format('M. D, Y') }}</span>
                                    <h2>{{ $NewPost->title }}</h2>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- End retroy layout blog posts -->
        <section class="section posts-entry">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">Business</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a href="" class="read-more">View All</a></div>
                </div>
                <div class="row g-3">
                    <div class="col-md-9">
                        <div class="row g-3">
                            @foreach ($postbusiness as $business)
                                <div class="col-md-6">
                                    <div class="blog-entry">
                                        <a href="{{ route('posts.show', $business->id) }}" class="img-link">
                                            <img style="width: 350px; height:240px"
                                                src="{{ asset('assets/images/' . $business->image . '') }}" alt="Image"
                                                class="img-fluid">
                                        </a><br>
                                        <span class="date">{{ $business->created_at->format('M. D, Y') }}</span>
                                        <h2><a
                                                href="{{ route('posts.show', $business->id) }}">{{ substr($business->title, 0, 20) }}</a>
                                        </h2>
                                        <p>{{ substr($business->description, 0, 100) }}</p>
                                        <p><a href="{{ route('posts.show', $business->id) }}"
                                                class="btn btn-sm btn-outline-secondary">Read More</a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-unstyled blog-entry-sm">
                            @foreach ($postbusiness_2 as $post)
                                <li>
                                    <span class="date">{{ $post->created_at->format('M. D, Y') }}</span>
                                    <h3><a
                                            href="{{ route('posts.show', $NewPost->title) }}">{{ substr($post->title, 0, 35) }}</a>
                                    </h3>
                                    <p>{{ substr($post->description, 0, 100) }}</p>
                                    <p><a href="{{ route('posts.show', $NewPost->title) }}" class="read-more">Continue
                                            Reading</a></p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End posts-entry -->

        <!-- Start posts-entry -->
        <section class="section posts-entry posts-entry-sm bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($random as $post)
                        <div class="col-md-6 col-lg-3">
                            <div class="blog-entry">
                                <a href="{{ route('posts.show', $post->id) }}" class="img-link">
                                    <img style="width: 200px; height:120px"
                                        src="{{ asset('assets/images/' . $post->image . '') }}" alt="Image"
                                        class="img-fluid">
                                </a><br>
                                <span class="date">{{ $post->created_at->format('M. D, Y') }}</span>
                                <h2><a
                                        href="{{ route('posts.show', $post->id) }}">{{ Str::substr($post->title, 0, 32) }}</a>
                                </h2>
                                <p>{{ Str::substr($post->description, 0, 80) }}</p>
                                <p><a href="{{ route('posts.show', $post->id) }}" class="read-more">Continue
                                        Reading</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End posts-entry -->

        <!-- Start posts-entry -->
        <section class="section posts-entry">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">Culture</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-9 order-md-2">
                        <div class="row g-3">
                            @foreach ($culture as $posts)
                                <div class="col-md-6">
                                    <div class="blog-entry">
                                        <a href="{{ route('posts.show', $posts->id) }}" class="img-link">
                                            <img style="width: 350px; height:240px"
                                                src="{{ asset('assets/images/' . $posts->image . '') }}" alt="Image"
                                                class="img-fluid">
                                        </a><br>
                                        <span class="date">{{ $posts->created_at->format('M. D, Y') }}</span>
                                        <h2><a
                                                href="{{ route('posts.show', $posts->id) }}">{{ substr($posts->title, 0, 30) }}</a>
                                        </h2>
                                        <p>{{ substr($posts->decription, 0, 150) }}</p>
                                        <p><a href="{{ route('posts.show', $posts->id) }}"
                                                class="btn btn-sm btn-outline-secondary">Read More</a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-3">
                        <ul class="list-unstyled blog-entry-sm">
                            @foreach ($culture_2 as $post)
                                <li>
                                    <span class="date">{{ $post->created_at->format('M. D, Y') }}</span>
                                    <h3><a
                                            href="{{ route('posts.show', $post->id) }}">{{ substr($post->title, 0, 35) }}</a>
                                    </h3>
                                    <p>{{ substr($post->description, 0, 100) }}</p>
                                    <p><a href="{{ route('posts.show', $post->id) }}" class="read-more">Continue
                                            Reading</a></p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">

                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">Politics</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a>
                    </div>
                </div>

                <div class="row">
                    @foreach ($Politics as $posts)
                        {{-- @dd($posts) --}}
                        <div class="col-lg-4 mb-4">
                            <div class="post-entry-alt">
                                <a href="{{ route('posts.show', $posts->id) }}" class="img-link"><img
                                        style="width: 500px; height:300px"
                                        src="{{ asset('assets/images/' . $posts->image . '') }}" alt="Image"
                                        class="img-fluid"></a><br>
                                <div class="excerpt">
                                    <h2><a
                                            href="{{ route('posts.show', $posts->id) }}">{{ substr($posts->title, 0, 35) }}</a>
                                    </h2>
                                    <div class="post-meta align-items-center text-left clearfix">
                                        {{-- <figure class="author-figure mb-0 me-3 float-start"><img
                                                src="{{ asset('assets/images/' . $posts->image . '') }}" alt="Image"
                                                class="img-fluid"></figure> --}}
                                        <span class="d-inline-block mt-1">By <a
                                                href="#">{{ $posts->username ? $posts->username : 'not found' }}</a></span>
                                        <span>&nbsp;-&nbsp; {{ $posts->created_at->format('M. D, Y') }}</span>
                                    </div>

                                    <p>{{ substr($posts->description, 0, 90) }}</p>
                                    <p><a href="{{ route('posts.show', $posts->id) }}" class="read-more">Continue
                                            Reading</a></p>
                                </div><br>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <div class="section bg-light">
            <div class="container">

                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">Travel</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a>
                    </div>
                </div>

                <div class="row align-items-stretch retro-layout-alt">
                    @foreach ($Travel as $posts)
                        <div class="col-md-5 order-md-2">
                            <a href="{{ route('posts.show', $posts->id) }}" class="hentry img-1 h-100 gradient">
                                <div class="featured-img"
                                    style="background-image: url({{ asset('assets/images/' . $posts->image . '') }});">
                                </div>
                                <div class="text">
                                    <span>{{ $posts->created_at->format('M. D, Y') }}</span>
                                    <h2>{{ $posts->title }}</h2>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="col-md-7">
                        @foreach ($Travel_2 as $post)
                            <a href="{{ route('posts.show', $posts->id) }}" class="hentry img-2 v-height mb30 gradient">
                                <div class="featured-img"
                                    style="background-image: url({{ asset('assets/images/' . $post->image . '') }});">
                                </div>
                                <div class="text text-sm">
                                    <span>{{ $posts->created_at->format('M. D, Y') }}</span>
                                    <h2>{{ $posts->title }}</h2>
                                </div>
                            </a>
                        @endforeach

                        <div class="two-col d-block d-md-flex justify-content-between">
                            @foreach ($Travel_3 as $posts)
                                <a href="{{ route('posts.show', $posts->id) }}" class="hentry v-height img-2 gradient">
                                    <div class="featured-img"
                                        style="background-image: url({{ asset('assets/images/' . $posts->image . '') }});">
                                    </div>
                                    <div class="text text-sm">
                                        <span>{{ $posts->created_at->format('M. D, Y') }}</span>
                                        <h2>{{ $posts->title }}</h2>
                                    </div>
                                </a>
                                {{-- <a href="{{ route('posts.show', $posts->id) }}"
                                    class="hentry v-height img-2 ms-auto float-end gradient">
                                    <div class="featured-img"
                                        style="background-image: url({{ asset('assets/images/' . $posts->image . '') }});">
                                    </div>
                                    <div class="text text-sm">
                                        <span>{{ $posts->created_at->format('M. D, Y') }}</span>
                                        <h2>{{ $posts->title }}</h2>
                                    </div>
                                </a> --}}
                            @endforeach
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
