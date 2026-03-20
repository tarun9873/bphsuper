@extends('layouts.app')


@section('meta')
@section('title', $blog->meta_title ?? $blog->title)

@section('meta_description', $blog->meta_description)

@section('meta_keywords', $blog->meta_keywords)

@section('meta_image', asset($blog->image))
@endsection

@section('content')

<div class="blog-wrapper">

    <!-- BLOG TITLE -->
    <h1 class="blog-title">
        {{ $blog->title }}
    </h1>

    <!-- BLOG IMAGE -->
  @if($blog->image)
    <div class="blog-image-box">
        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
    </div>
@endif

    <!-- BLOG CONTENT -->
    <div class="blog-content">
        {!! str_replace('{ps777}', '', $blog->description) !!}
    </div>

</div>

<style>

/* MAIN WRAPPER */
.blog-wrapper {
    max-width: 900px;
    margin: 50px auto;
    padding: 20px;
    color: #ffffff;
}

/* TITLE */
.blog-title {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 25px;
    line-height: 1.3;
}

/* IMAGE */
.blog-image-box {
    margin-bottom: 25px;
}

.blog-image-box img {
    width: 100%;
    border-radius: 12px;
}

/* CONTENT */
.blog-content {
    font-size: 17px;
    line-height: 1.8;
}

/* HEADINGS */
.blog-content h1,
.blog-content h2,
.blog-content h3 {
    margin-top: 25px;
    margin-bottom: 15px;
    font-weight: 600;
}

/* PARAGRAPH */
.blog-content p {
    margin-bottom: 15px;
}

/* IMAGE INSIDE CONTENT */
.blog-content img {
    max-width: 100%;
    border-radius: 10px;
    margin: 15px 0;
}

/* LIST */
.blog-content ul,
.blog-content ol {
    margin-left: 20px;
    margin-bottom: 15px;
}

/* LINKS */
.blog-content a {
    color: #4da6ff;
    text-decoration: underline;
}

/* MOBILE */
@media (max-width: 768px) {
    .blog-wrapper {
        margin: 20px;
        padding: 10px;
    }

    .blog-title {
        font-size: 26px;
    }
}

</style>

@endsection