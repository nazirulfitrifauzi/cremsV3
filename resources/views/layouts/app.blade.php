<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Inter Font -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Hint.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Alpine js cdn -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Alpine js IE support -->
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
    
    <style>
        [x-cloak] { display: none; }
    </style>

</head>

<body class="bg-blue-100 h-screen antialiased leading-none">
    <div id="app">
        <div style="min-height: 640px" class="bg-gray-200">

        @if(is_null(auth()->user()))
        @else
            <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }"
                @keydown.window.escape="sidebarOpen = false">
                <!-- Off-canvas menu for mobile -->
                <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
                    <div class="fixed inset-0 flex z-40">
                        <div @click="sidebarOpen = false" 
                            x-show="sidebarOpen"
                            x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                            x-transition:enter="transition-opacity ease-linear duration-300" 
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" 
                            x-transition:leave="transition-opacity ease-linear duration-300"
                            x-transition:leave-start="opacity-100" 
                            x-transition:leave-end="opacity-0" 
                            class="fixed inset-0" style="display: none;">
                            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                        </div>
                        <div 
                            x-show="sidebarOpen" 
                            x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                            x-transition:enter="transition ease-in-out duration-300 transform"
                            x-transition:enter-start="-translate-x-full" 
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in-out duration-300 transform"
                            x-transition:leave-start="translate-x-0" 
                            x-transition:leave-end="-translate-x-full"
                            class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800" style="display: none;">
                            <div class="absolute top-0 right-0 -mr-14 p-1">
                                <button x-show="sidebarOpen" @click="sidebarOpen = false"
                                    class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                                    aria-label="Close sidebar" style="display: none;">
                                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-shrink-0 flex items-center px-4 justify-center">
                                <img class="h-8 w-auto" src="{{ asset('img/logo/csc.png') }}" alt="Workflow">
                            </div>

                            @include('layouts.sidebar.mobile')

                        </div>
                        <div class="flex-shrink-0 w-14">
                            <!-- Dummy element to force sidebar to shrink to fit close icon -->
                        </div>
                    </div>
                </div>

                <!-- Static sidebar for desktop -->
                <div class="hidden md:flex md:flex-shrink-0">
                    <div class="flex flex-col w-64">
                        <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900 justify-center">
                            <img class="h-8 w-auto" src="{{ asset('img/logo/csc.png') }}" alt="Workflow">
                        </div>
                        
                        @include('layouts.sidebar.desktop')
                        
                    </div>
                </div>
                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    @include('layouts.navbar.topbar')
        @endif

                    @yield('content')

                    @include('layouts.navbar.footer')
    
        @if(is_null(auth()->user()))
        @else
                </div>
            </div>
        @endif
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <link href='{{ asset('fullCalendar/packages/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/list/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('fullCalendar/packages/core/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/interaction/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/daygrid/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/timegrid/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/list/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/google-calendar/main.js') }}'></script>
    @stack('js')
</body>

</html>
