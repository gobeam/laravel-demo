@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    Welcome {{ Auth::user()->name }}, You have role as {{ Auth::user()->role }}.

@endsection
