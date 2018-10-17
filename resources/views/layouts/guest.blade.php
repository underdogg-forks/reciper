<!doctype html>
<html lang="{{ lang() }}">
<head>
    @yield('head')
    @include('includes.head')
    <title>@yield('title') - @lang('messages.app_name')</title>
</head>
<body>

    @include('includes.nav.sidenav')
    @include('includes.nav.navbar')

    @yield('home-header')

    <div id="app">
        @yield('content')
    </div>

    <!-- add-recipe-modal structure -->
    <div id="add-recipe-modal" class="modal">
        <div class="modal-content reset">
            <div class="center row">
                <span class="col s12 m5">
                    <img src="{{ asset('storage/other/logo.svg') }}" alt="logo" height="150">
                </span>
                <p class="pt-1 col s12 m7 left-align">{!! trans('messages.login_to_add_recipe') !!}</p>
                <div class="col s12">
                    @include('includes.buttons.btn', ['title' => trans('auth.login'), 'link' => '/login'])
                    @include('includes.buttons.btn', ['title' => trans('auth.register'), 'link' => '/register'])
                </div>
            </div>
        </div>
        <audio id="favs-effect" src="/storage/audio/favs-effect.mp3" class="hide" type="audio/mpeg"></audio>
    </div>

    @include('includes.footer')

    {!! script_timestamp('/js/app.js') !!}

    @yield('script')
    @include('includes.messages')
</body>
</html>