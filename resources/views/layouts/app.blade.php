<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- Fonts -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
@auth
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }}</a>
        <a class="btn btn-primary" href="{{ URL::to('/') }}"><i class="fa fa-arrow-right" aria-hidden="true" style="margin-right:10px;"></i> {{ __('Visit Frontend')}}
        </a>
        {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
        <div class="col-4 d-flex justify-content-end align-items-center">
            @auth
                <span id="notification-compo" class="ml-1"></span>
                <div class="dropdown ml-1">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{auth()->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
@endauth

@yield('login-forgot')
@auth
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        @foreach($navList as $key => $item)
                            @if(in_array(auth()->user()->role, $item["permission"]))
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ "/$key" }}">
                                        <i class="{{ $item["icon"] }}" aria-hidden="true"></i> {{ __($item["name"]) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="app">
                <notification-component :user="{{ auth()->user() }}"
                                        :notif="`{{ asset('notification/notif.mp3') }}`"></notification-component>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Delete modal -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure, you want to delete?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i
                            class="glyph-icon icon-close"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" id="delete-btn"><i
                            class="glyph-icon icon-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
@endauth

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="{{asset("js/jquery-slim.min.js")}}"></script>
<script src="{{asset("js/popper.min.js")}}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
@yield('scripts')

</body>
</html>
