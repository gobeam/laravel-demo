@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@endsection

@section('login-forgot')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        {{--<img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">--}}
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Login') }}</h1>
        <label for="inputEmail" class="sr-only">{{ __('Email Address') }}</label>
        <input id="email" type="email" placeholder="Email Address"
               class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

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
            <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                {{ __('Remember Me') }}
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a> or
            <a class="btn btn-link" href="{{ route('register') }}">
                {{ __('Sign Up') }}
            </a>
        @endif
        <p class="mt-5 mb-3 text-muted">&copy; {{ date("Y-m-d") }}</p>

    </form>
@endsection
