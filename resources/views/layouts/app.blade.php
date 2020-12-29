<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KeizerPHP')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/684ea5eff4.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/turbolinks@5.2.0"></script>
    <!-- Styles -->
    @livewireStyles
    @auth
    @if(config('app.layout', 'app'))
    @if(config('app.layout') === 'app')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @elseif(config('app.layout') === 'blue')
    <link href="{{ asset('css/blue.css') }}" rel="stylesheet">
    @endif
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    @endauth
    @guest
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endguest
</head>

<body class="font-sans leading-normal tracking-normal mt-12">
    @include('layouts.navbar')
    <div class="flex flex-col md:flex-row">
        @include('layouts.sidebar')
        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="flex flex-wrap">
                <div class="w-full h-screen p-6 overflow-auto">
                    @if (session()->has('message'))
                        <div class="bg-yellow-lightest border-t-4 border-yellow rounded-b text-yellow-darkest px-4 py-3 shadow-md my-2" role="alert">
                            <div class="flex">
                                <div>
                                    {{ session('message') }}
                                </div>
                            </div>
                        </div>
                    @elseif(session()->has('success'))
                        <div class="bg-teal-lightest border-t-4 border-teal rounded-b text-teal-darkest px-4 py-3 shadow-md my-2" role="alert">
                            <div class="flex">
                                <div>
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    @elseif(session()->has('error'))
                        <div class="bg-red-lightest border-t-4 border-red rounded-b text-red-darkest px-4 py-3 shadow-md my-2" role="alert">
                            <div class="flex">
                                <div>
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @auth
    @if(config('app.notifications'))
    @if(config('app.notifications') == 2 OR config('app.notifications') == 3)
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
    @endif
    @endif
    @endauth
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"></script>
    <x-livewire-alert::scripts />

</body>

</html>
