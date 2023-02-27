<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>
<body style="padding: 60px 0;">
    <div id="app">
        @include('layouts.header')
        {{-- @component('components.header')
        @endcomponent --}}
        <main>
            <article>
                <div class="container">
                    <h1 class="fs-2 my-3">@yield('title')</h1>
                    @yield('content')
                </div>
            </article>
        </main>
        @include('layouts.footer')
    </div>
</body>
</html>
