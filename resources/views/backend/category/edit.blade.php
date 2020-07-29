@extends('layouts.app')
@section('title')
    {{ __($title) }}
@endsection
@section('content')
    @component('slots.breadcrumb',['title'=>$title])
        <li class="breadcrumb-item"><a href="{{URL::to('/category')}}">{{ __('Category')}}</a></li>
    @endcomponent

    @error('title')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ __($title) }}</h4>
                {!! Form::model($category,array('route'=>['category.update',$category->id],'method'=>'put','class'=>'form-horizontal style-form')) !!}
                @include('backend.category.includes.form',['btnTxt' => 'Update', 'readOnly'=>false])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
