@extends('layouts.app')
@section('title')
    {{ __($title) }}
@endsection
@section('content')
    @component('slots.breadcrumb',['title'=>$title])
        <li class="breadcrumb-item"><a href="{{URL::to('/category')}}">{{ __('Category')}}</a></li>
    @endcomponent
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ __($title) }} </h4>
                {!! Form::open(array('route'=>'category.store','method'=>'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data')) !!}
                @include('backend.category.includes.form',['btnTxt' => 'Save', 'readOnly'=>false])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
