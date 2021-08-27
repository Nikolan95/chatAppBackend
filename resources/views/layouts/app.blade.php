<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="icon" href="{{asset('images/favicon.png')}}">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
	
    <!-- Custom scroll CSS -->
    <link rel="stylesheet" href="{{asset('plugins/mcustomscroll/jquery.mCustomScrollbar.css')}}">
	
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('css/appold.css')}}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        {{-- @include('modals') --}}

        @livewireScripts

        <script src="{{asset("/js/jquery-3.4.1.min.js")}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	
	<!-- Bootstrap Core JS -->
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
	
	<!-- Custom Scroll JS -->
    <script src="{{asset('/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('/plugins/mcustomscroll/jquery.mCustomScrollbar.js')}}"></script>

    <script src="{{asset('/js/custom.js')}}"></script>

    <script src="{{asset('/js/images.js')}}"></script>

    <script src="{{asset('/js/chatgroup.js')}}"></script>

    <script src="{{asset('/js/accounting.js')}}"></script>

    <script src="{{asset('/js/offerform.js')}}"></script>
	
	<!-- Custom JS -->
    <script src="{{asset('/js/script.js')}}"></script>
    </body>
</html>
