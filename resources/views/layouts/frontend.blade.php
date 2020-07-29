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
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="/">{{ __('Home') }}</a>
            </div>
            <div class="col-2 text-center">
                @auth
                    @can('create', new \App\Blog())
                        <a class="btn btn-primary" href="{{ URL::to('/blog/create') }}"><i class="glyph-icon icon-plus"
                                                                                           style="margin-right:10px;"></i><i
                                class="fa fa-plus"></i> {{ __('Add New')}}
                        </a>
                    @endif
                @endauth

            </div>

            <div class="col-2 text-center">
                <form class="text-muted" action="{{ route("root") }}" method="get">
                    @csrf
                    <div id="search-compo"></div>
                </form>
            </div>

            <div class="col-4 d-flex justify-content-end align-items-center">

                @guest
                    <a class="btn btn-sm btn-outline-secondary ml-1" href="/login">Sign In</a>
                @endguest
                @auth
                    <span id="notification-compo" class="ml-1"></span>

                    <div class="dropdown">
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
        </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach($data['categories'] as $category)
                <a class="p-2 text-muted" href="{{ url('?category_id='.$category->id) }}">{{$category->title}}</a>
            @endforeach
        </nav>
    </div>

    <div class="row mb-2">
        @foreach($data['blogs'] as $blog)
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">{{ $blog->category->title }}</strong>
                        <h5 class="mb-0">
                            <a class="text-dark" href="#">{{$blog->description}}</a>
                        </h5>
                        <div
                            class="mb-1 text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('MMM Do YY') }}</div>
                        <p class="card-text mb-auto">{{ Str::limit($blog->body, 40) }}</p>
                        <a href="{{ route('blog.view',$blog->id) }}">Continue reading</a>
                    </div>

                    <img class="card-img-right flex-auto d-none d-md-block"
                         alt="{{$blog->title}}"
                         style="width: 200px; height: 250px; object-fit: cover"
                         src="{{ asset($blog->image ? 'storage/blog/' . $blog->image : "image/1586616649jpfCl.jpg") }}"
                         data-holder-rendered="true">
                </div>
            </div>
        @endforeach
    </div>
</div>

<main role="main" class="container" id="app">
    <search-component></search-component>
    @auth
    <notification-component :user="{{ auth()->user() }}"
                            :notif="`{{ asset('notification/notif.mp3') }}`"></notification-component>
    @endauth
    @yield("content")

</main><!-- /.container -->

<footer class="blog-footer">
    <p>
        <a href="#app">Back to top</a>
    </p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="{{asset("js/jquery-slim.min.js")}}"></script>
@yield('scripts')
{{--<script>--}}
{{--    Holder.addTheme('thumb', {--}}
{{--        bg: '#55595c',--}}
{{--        fg: '#eceeef',--}}
{{--        text: 'Thumbnail'--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
