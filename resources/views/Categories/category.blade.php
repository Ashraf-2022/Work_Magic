@extends('layouts.app')
@section('title', 'Category')
@section('content')
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <div class="section search-result-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">Category: {{ $name }}</div>
                </div>
            </div>
            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($post_category as $posts)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ route('posts.show', $posts->id) }}" class="img-link me-4">
                                <img style="width: 270px; height:170px"
                                    src="{{ asset('assets/images/' . $posts->image . '') }}" alt="Image"
                                    class="img-fluid">
                            </a>
                            <div>
                                <span class="date">{{ $posts->created_at->format('M, D. Y') }} <a
                                        href="#">{{ $posts->category }}</a></span>
                                <h2><a href="{{ route('posts.show', $posts->id) }}">{{ substr($posts->title, 0, 35) }}</a>
                                </h2>
                                <p>{{ substr($posts->description, 0, 190) }}</p>
                                <p><a href="{{ route('posts.show', $posts->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Read
                                        More</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 sidebar">


                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 style="margin-left: 10px;" class="heading">Popular Posts</h3>
                        <div style="margin-left: 10px; " class="post-entry-sidebar">
                            <ul>
                                <li>
                                    @foreach ($pop_post as $post)
                                        <a href="{{ route('posts.show', $post->id) }}">
                                            <img style="padding:10px; width:100px; height:80px"
                                                src="{{ asset('assets/images/' . $post->image . '') }}"
                                                alt="Image placeholder" class="me-4 rounded">
                                            <div class="text">
                                                <h4>{{ substr($post->title, 0, 35) }}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">{{ $post->created_at->format('M, D. Y') }} </span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <div style="margin-left: 10px ">
                            <h3 class="heading">Categories</h3>

                            <ul style="padding: 2px" class="categories">
                                @foreach ($cat_post as $post)
                                    <li><a href="{{ route('category.single', $post->name) }}">{{ $post->name }}
                                            <span>({{ $post->total }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->




                </div>
            </div>
        </div>
    </div>
@endsection
