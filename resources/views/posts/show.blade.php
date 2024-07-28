@extends('layouts.app')
@section('title', 'Single-Post')
@section('content')
    <style>
        .post-content-body {
            font-family: 'Cambria', 'Cochin', 'Georgia', 'Times', 'Times New Roman', serif;
            font-size: 20px;
            line-height: 1.6;
            text-align: justify;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.1);
        }

        .post-content-body p {
            margin-bottom: 18px;
        }
    </style>


    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url({{ asset('assets/images/' . $post->image . '') }});background-size: cover;background-position: center center;margin-top:-24px">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $post->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            {{-- <figure class="author-figure mb-0 me-3 d-inline-block"><img src="images/person_1.jpg"
                                    alt="Image" class="img-fluid"></figure> --}}
                            <span class="d-inline-block mt-1">{{ $post->username }}</span>
                            <span>&nbsp;-&nbsp; {{ $post->created_at->format('M. D, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section" style="text-decoration: none">
        <div class="container">
            @if (session('Update'))
                <div id="alert" class="alert alert-success">
                    {{ session('Update') }}
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
            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">

                    <div class="post-content-body">
                        <p class="styled-paragraph">
                            {!! nl2br(e($post->description)) !!}
                        </p>
                    </div>



                    <div class="pt-5">
                        <p style="font-size: 18px">Categories: <a
                                style="color:rgb(80, 44, 9);text-decoration: none; font-family:'Courier New', Courier, monospace"
                                href="{{ route('category.single', $post->category) }}">{{ $post->category }}</a></p>
                    </div>


                    @auth
                        @if (Auth::user()->id == $post->user_id)
                            <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-outline-danger"
                                role="button">Delete</a>
                        @endif
                    @endauth
                    @auth
                        @if (Auth::user()->id == $post->user_id)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning"
                                role="button">Update</a>
                        @endif
                    @endauth
                    <br><br>
                    @if (\Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ \Session::get('success') }}</p>
                        </div>
                    @endif

                    <div class="pt-5 comment-wrap">
                        <h3 class="mb-5 heading">{{ $number_comments }} <span>Comments</span></h3>
                        <ul class="comment-list">
                            @foreach ($comments as $post)
                                <li class="comment">
                                    <div class="vcard">
                                        {{-- <img src="{{asset('assets/images/' .$post->image. '')}}" alt="Image placeholder"> --}}
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{ $post->username }}</h3>
                                        <div class="meta">{{ $post->created_at->format('M. D, Y') }}</div>
                                        <p>{{ $post->comment }}</p>
                                        {{-- <p><a href="#" class="reply rounded">Reply</a></p> --}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>

                            <form action="{{ route('comments.store') }}" method="post" class="p-5 bg-light"
                                enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" class="form-control"
                                        id="website">
                                </div>
                                <div class="form-group">
                                    <label for="message">Comment</label>
                                    <textarea placeholder=" Enter Your Comment Here ." name="comment" id="message" cols="30" rows="10"
                                        class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Post Comment" class="btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <!-- END main-content -->


                <!-- END sidebar-box -->
                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            @if ($Author && $Author->image)
                                <img src="{{ asset('assets/images/avatar/' . $Author->image) }}" alt="Image Placeholder"
                                    class="img-fluid mb-3">
                            @else
                                <img src="{{ asset('assets/images/avatar/OIP.jpg') }}" alt="Default Placeholder"
                                    class="img-fluid mb-3">
                            @endif

                            <div class="bio-body">
                                <h2>{{ $Author->name ?? 'Unknown Author' }}</h2>
                                <p class="mb-4">{{ substr($Author->bio, 0, 35) ?? 'No bio available.' }}</p>
                            </div>

                            @if (Auth::check())
                                @php
                                    $user = Auth::user();
                                @endphp

                                @if (!empty($user->bio))
                                    <p><a href="{{ route('users.profile', $user->id) }}"
                                            class="btn btn-dark btn-sm rounded px-2 py-2">Read my bio</a></p>
                                @else
                                    <p>You don't have a bio yet.</p>
                                @endif
                            @else
                                <p>Please log in to read my bio.</p>
                            @endif




                        </div>
                    </div>

                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div style="margin-left: 10px; ">
                            <h3 class="heading">Popular Posts</h3>
                            <div style="margin-left: 10px " class="post-entry-sidebar">
                                <ul>
                                    <li>
                                        @foreach ($pop_post as $posts)
                                            <a href="{{ route('posts.show', $posts->id) }}">
                                                <img style="width: 90px; height:70px"
                                                    src="{{ asset('assets/images/' . $posts->image . '') }}"
                                                    alt="Image placeholder" class="me-4 rounded">
                                                <div class="text">
                                                    <h4>{{ substr($posts->title, 0, 28) }}</h4>
                                                    <div class="post-meta">
                                                        <span class="mr-2">{{ $posts->created_at->format('M. D, Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a><br>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    {{-- <div class="sidebar-box">
                        <div style="margin-left: 10px ">
                            <h3 class="heading">Categories</h3>

                            <ul style="padding: 2px" class="categories">
                                @foreach ($cat_post as $post)
                                    <li><a href="{{route('posts.show', $post->id)}}">{{ $post->name }}
                                            <span>({{ $post->total }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <!-- END sidebar-box -->


            </div>
            <!-- END sidebar -->

        </div>
        </div>
    </section>


    <!-- Start posts-entry -->
    <section class="section posts-entry posts-entry-sm bg-light" style="text-decoration: none">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-uppercase text-black">More Blog Posts</div>
            </div>
            <div class="row">
                @if ($moreposts->count() > 0)
                    @foreach ($moreposts as $post)
                        <div class="col-md-6 col-lg-3">
                            <div class="blog-entry">
                                <a href="{{ route('posts.show', $post->id) }}" class="img-link">
                                    <img style="height: 160px; width:400px"
                                        src="{{ asset('assets/images/' . $post->image . '') }}" alt="Image"
                                        class="img-fluid">
                                </a>
                                <span class="date">{{ $post->created_at->format('M. D, Y') }}</span>
                                <h2><a href="{{ route('posts.show', $post->id) }}">{{ substr($post->title, 0, 30) }}</a>
                                </h2>
                                <div class="post-container">
                                    <p>{{ substr($post->description, 0, 100) }}</p>
                                </div>
                                <p><a href="{{ route('posts.show', $post->id) }}" class="read-more">Continue
                                        Reading</a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning" role="alert">
                        <p>No More To Display.</p>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- End posts-entry -->

@endsection
