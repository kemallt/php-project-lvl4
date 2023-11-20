<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />

        <title>@lang('main.app.title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="vsc-initialized">
        <div id='app'>
            <header class="fixed w-full">
                @include('layouts.navigation', ['userIsLoggedIn' => $attributes['userIsLoggedIn']])
            </header>
            <!-- Page Content -->
            <main>
                <section class="bg-white dark:bg-gray-900">
                    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">            
                {{ $slot }}
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
