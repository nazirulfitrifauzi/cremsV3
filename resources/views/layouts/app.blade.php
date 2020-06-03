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

    @yield('style')
</head>

<body class="bg-blue-100 h-screen antialiased leading-none">
    <div id="app">
        <div style="min-height: 640px" class="bg-gray-100">
            @yield('content')
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
