@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@endsection
@section('login-forgot')
    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal"> {{ __('Please confirm your password before continuing.') }}</h1>
        <label for="inputEmail" class="sr-only">{{ __('Password') }}</label>
        <input id="password" type="password" placeholder="Password"
               class="form-control @error('password') is-invalid @enderror" name="password"
               required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <div class="checkbox mb-3">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Confirm Password') }}</button>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
@endsection
