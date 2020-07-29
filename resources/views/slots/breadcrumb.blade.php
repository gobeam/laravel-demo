<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">{{ __('Home')}}</a></li>
        {{ $slot }}
        <li class="breadcrumb-item active" aria-current="page">{{ __($title)}}</li>
    </ol>
</nav>
