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
            {{-- <div class="row">
                <div class="col-12">
                    <div class="heading">Category: {{ $name }}</div>
                </div>
            </div> --}}
            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($result as $posts)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ route('posts.show', $posts->id) }}" class="img-link me-4">
                                <img style="width: 270px; height:170px"
                                    src="{{ asset('assets/images/' . $posts->image . '') }}" alt="Image" class="img-fluid">
                            </a>
                            <div>
                                <span class="date">{{ $posts->created_at->format('M, D. Y') }} <a
                                        href="#">{{ $posts->category }}</a></span>
                                <h2><a href="{{ route('posts.show', $posts->id) }}">{{ substr($posts->title, 0, 35) }}</a>
                                </h2>
                                <p>{{ substr($posts->description, 0, 190) }}</p>
                                <p>
                                    <a href="{{ route('posts.show', $posts->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Read
                                        More
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
