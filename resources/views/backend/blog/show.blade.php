@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')

    @component('slots.breadcrumb',['title'=>$title])
        <li class="breadcrumb-item"><a href="{{URL::to('/blog')}}">{{ __('Blog')}}</a></li>
    @endcomponent



    @include('errors.error')
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ __($title) }}</h4>
                {!! Form::model($blog,array('route'=>['blog.update',$blog->id],'method'=>'put','class'=>'form-horizontal style-form','enctype'=>"multipart/form-data")) !!}
                @include('backend.blog.includes.form',['btnTxt' => 'Update', 'readOnly'=>true])

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
