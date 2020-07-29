@extends('layouts.app')
@section('title')
    {{ __($title) }}
@endsection
@section('content')
    @component('slots.breadcrumb',['title'=>$title])
        <li class="breadcrumb-item"><a href="{{URL::to('/blog')}}">{{ __('Blog')}}</a></li>
    @endcomponent
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ __($title) }} </h4>
                {!! Form::open(array('route'=>'blog.store','method'=>'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data')) !!}
                @include('backend.blog.includes.form',['btnTxt' => 'Save', 'readOnly'=>false])
                {!! Form::close() !!}
            </div>
        </div>
@endsection
