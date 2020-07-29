@extends('layouts.frontend')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{$blog->title}}</h2>
                <p class="blog-post-meta">{{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('MMM Do YY') }} by <a
                        href="#">{{ $blog->user->name }}</a> <span
                        class="badge badge-pill badge-secondary">{{$blog->category->title}}</span></p>
                @if($blog->image)
                    <hr>
                    <img class="img-fluid rounded" src="{{ asset( 'storage/blog/' . $blog->image) }}" alt="">
                @endif
                <hr>
                <p>{{ $blog->description }}</p>
                <hr>
                <p>
                    {!! $blog->body  !!}
                </p>
            </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        @include("frontend.includes.archives")

    </div><!-- /.row -->
@endsection
