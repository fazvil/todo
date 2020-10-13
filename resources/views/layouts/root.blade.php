<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>To Do list</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <div>
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>
            </div>
            <div>
                @yield('action')
            </div>
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
        </div>
    </body>
</html>