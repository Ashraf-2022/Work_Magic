@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <style>
        .span {
            font-size: 16px;
            color: #333333;
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin: 5px 0;
        }

        .span:hover {
            color: #ffffff;
            background-color: #787878;
            transition: color 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .certificate-container {
            margin-top: 20px;
        }

        .certificate-container h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .certificates-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .certificate {
            flex: 2;
            max-width: 600px;
            /* Adjust size as needed */
        }

        .certificate-container img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInRotate 1s ease-in-out forwards;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Fade In with Slide Effect */
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fade In with Blur Effect */
        @keyframes fadeInBlur {
            from {
                opacity: 0;
                filter: blur(10px);
            }

            to {
                opacity: 1;
                filter: blur(0);
            }
        }

        /* Fade In with Color Change */
        @keyframes fadeInColor {
            from {
                opacity: 0;
                color: rgba(0, 0, 0, 0);
            }

            to {
                opacity: 1;
                color: rgba(0, 0, 0, 1);
            }
        }

        .wave-animation {
            animation: colorWave 4s infinite alternate;
        }

        @keyframes colorWave {

            0%,
            100% {
                color: #fff;
                /* Starting and ending color */
            }

            50% {
                color: #9e5c50;
                /* Intermediate color (Tomato) */
            }
        }
    </style>
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url({{ asset('assets/images/hero_1.jpg') }});background-size: cover;background-position: center center;margin-top:-24px">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4 wave-animation">
                            @foreach (str_split($user->name) as $char)
                                <span>{{ $char }}</span>
                            @endforeach
                        </h1>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <section class="section" style="text-decoration: none">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="post-content-body">
                        <p style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:20px">
                            {{ $user->bio }}
                        </p>
                    </div>

                    <!-- Image Upload Section -->
                    <section>
                        <br>
                        <div class="certificate-container">
                            <div class="certificates-container">
                                @foreach ($user->certificates as $certificate)
                                    <div class="certificate">
                                        <img src="{{ asset($certificate->path) }}" alt="Certificate">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br><br>
                        <div class="post-content-body">
                            <h3>Upload Certificate</h3>
                            <form action="{{ route('certificates.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="certificates[]" class="form-control" multiple required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                            </form>

                        </div>
                    </section>

                </div>

                <!-- END main-content -->
                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <div style="margin-left: 10px;">
                            <h3 class="heading">Latest Posts By <span class="span">{{ $user->name }}</span></h3>
                            <div style="margin-left: 10px;" class="post-entry-sidebar">
                                <ul>

                                    @foreach ($latest_posts as $post)
                                        <li style="margin: -20px;margin-left: 10px;">
                                            <a href="{{ route('posts.show', $post->id) }}">
                                                <img style="width: 90px; height:70px"
                                                    src="{{ asset('assets/images/' . $post->image) }}"
                                                    alt="Image placeholder" class="me-4 rounded">
                                                <div class="text">
                                                    <h4>{{ Str::limit($post->title, 28) }}</h4>
                                                    <div class="post-meta">
                                                        <span
                                                            class="mr-2">{{ $post->created_at->format('M. d, Y') }}</span>
                                                    </div>
                                                </div>
                                            </a><br>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END sidebar -->
        </div>
    </section>
@endsection
