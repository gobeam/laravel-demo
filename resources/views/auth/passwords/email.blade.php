@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@endsection
@section('login-forgot')

    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h1 class="h3 mb-3 font-weight-normal">{{ __('Reset Password') }}</h1>
        <label for="inputEmail" class="sr-only">{{ __('Email Address') }}</label>
        <input id="email" type="email" placeholder="Email Address"
               class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <div class="checkbox mb-3">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Send Password Reset Link') }}</button>

    </form>
@endsection
