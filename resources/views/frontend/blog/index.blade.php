@extends('layouts.frontend')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 blog-main">
            @if($blogs->isEmpty())
                <div class="blog-post">
                    <h2 class="blog-post-title">No Data Available</h2>
                </div>
            @endif
            @foreach($blogs as $blog)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{$blog->title}}</h2>
                    <p class="blog-post-meta">{{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('MMM Do YY') }} by
                        <a href="#">{{ $blog->user->name }}</a></p>

                    <p>{{ $blog->description }}</p>
                    <hr>
                    <p>
                        {!! Str::limit($blog->body, 400) !!}
                    </p>
                    <a href="{{ route('blog.view',$blog->id) }}">Continue reading</a>
                </div><!-- /.blog-post -->
            @endforeach

            @if(!$blogs->isEmpty())
                <div class="pagination-tile">
                    <label class="pagination-sub" style="display: block">
                        {{ __('Showing') }} {{($blogs->currentpage()-1)*$blogs->perpage()+1}} {{ __('to')}} {{(($blogs->currentpage()-1)*$blogs->perpage())+$blogs->count()}} {{ __('of')}} {{$blogs->total()}} {{ __('entries')}}
                    </label>
                    <ul class="pagination">
                        {!! str_replace('/?', '?',$blogs->appends(request()->query())->render()) !!}
                    </ul>
                </div>
            @endif
        </div><!-- /.blog-main -->

        @include("frontend.includes.archives")

    </div><!-- /.row -->
@endsection
