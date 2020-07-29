@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@endsection

@section('login-forgot')
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        @csrf

        <h1 class="h3 mb-3 font-weight-normal">{{ __('Register') }}</h1>

        <label for="name" class="sr-only">{{ __('Name') }}</label>
        <input id="name" type="name" placeholder="Name"
               class="form-control @error('name') is-invalid @enderror" name="name"
               value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror


        <label for="email" class="sr-only">{{ __('Email Address') }}</label>
        <input id="email" type="email" placeholder="Email Address"
               class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror


        <label for="password" class="sr-only">{{ __('Password') }}</label>
        <input id="password" type="password" placeholder="Password"
               class="form-control @error('password') is-invalid @enderror" name="password" required
               autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <label for="password_confirmation" class="sr-only">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" type="password" placeholder="Confirm Password"
               class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required
               autocomplete="new-password">

        <div class="form-group row">
            <div class="col-sm-10 ">
                <div class="form-check form-check-inline">
                    {!! Form::checkbox('subscription',1,true ,array('class'=>'form-check-input', 'id'=> "inlineRadio1")) !!}
                    {!! Form::label('subscription','Send Me Email For New Posts', null,array('class'=>'form-check-label', 'for'=> "inlineRadio1")) !!}
                </div>

                @error('subscription')
                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>


        </div>




        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Register') }}</button>
        <a class="btn btn-link" href="{{ route('login') }}">
            {{ __('Login') }}
        </a>
@endsection
