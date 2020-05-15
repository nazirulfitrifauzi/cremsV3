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

    <!-- Alpine js cdn -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Alpine js IE support -->
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

    </style>
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <!-- up button -->
    <div class="fixed inset-0 flex flex-col items-end justify-end px-4 py-6 pointer-events-none sm:p-6">
        <div class="max-w-xs bg-white shadow-lg rounded-lg pointer-events-auto">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-3">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex">
                            <a href="#intro"
                                class="inline-flex text-green-400 focus:outline-none focus:text-green-500 transition ease-in-out duration-150">
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" fill-rule="evenodd">
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->
    <div id="intro" class="relative bg-white overflow-hidden" x-data="{ open: false }">
        <div class="max-w-screen-xl mx-auto ">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-40 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="#">
                                    <img class="h-8 w-auto sm:h-10" src="{{ asset('img/logo/csc_blue.png') }}" alt="" />
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <button type="button"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                        @click="open = true">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:ml-10 md:pr-4">
                            <a href="#services"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Services
                                & Products</a>
                            <a href="#clients"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Clients</a>
                            <a href="#contact"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Contacts</a>
                            <a href="{{ route('login') }}"
                                class="ml-8 font-medium text-indigo-600 hover:text-indigo-900 focus:outline-none focus:text-indigo-700 transition duration-150 ease-in-out">CREMS</a>
                        </div>
                    </nav>
                </div>

                <!--
        Mobile menu, show/hide based on menu open state.

        Entering: "duration-150 ease-out"
          From: "opacity-0 scale-95"
          To: "opacity-100 scale-100"
        Leaving: "duration-100 ease-in"
          From: "opacity-100 scale-100"
          To: "opacity-0 scale-95"
      -->
                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden" x-show="open"
                    @click.away="open = false">
                    <div class="rounded-lg shadow-md">
                        <div class="rounded-lg bg-white shadow-xs overflow-hidden">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto" src="{{ asset('img/logo/csc_blue.png') }}" alt="" />
                                </div>
                                <div class="-mr-2">
                                    <button type="button"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                        @click="open = !open">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3">
                                <a href="#services"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out">Services
                                    & Products</a>
                                <a href="#clients"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out">Clients</a>
                                <a href="#contact"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out">Contact
                                    Us</a>
                            </div>
                            <div>
                                <a href="{{ route('login') }}"
                                    class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100 hover:text-indigo-700 focus:outline-none focus:bg-gray-100 focus:text-indigo-700 transition duration-150 ease-in-out">
                                    CREMS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h2
                            class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                            Creative System
                            <br class="xl:hidden" />
                            <span class="text-indigo-600">Consultant</span>
                        </h2>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            CSC was incorporated on May 1999 as a software, software development, research center,
                            systems integration and IT consultancy company.
                        </p>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            CSC was founded and managed by individuals experienced in finance/banking and information
                            technology, IT consultancy, client server system development and corporate management.
                        </p>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            A fully Malaysian / Bumiputra-owned company; the company was started with a handful of
                            IT/technical staff knowledgeable in system management with financial and banking businesses.
                        </p>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            CSC helps organizations maximizing value from investments in information technology by
                            supplying consultancy, software and systems integration to the highest professional
                            standard.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                alt="" />
        </div>
    </div>
    <!-- Services & products -->
    <div id="services" class="py-12 bg-indigo-500">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h3
                    class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    Services & Products
                </h3>
                <p class="mt-4 max-w-2xl text-xl leading-7 text-white lg:mx-auto">
                    List of services and products that we provide to our customers
                </p>
            </div>

            <div class="mt-10">
                <div class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10">
                    <div>
                        <h3
                            class="my-4 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            Services
                        </h3>
                        <ul class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10">
                            <li>
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Projects Management</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">System Integration
                                            Provider</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Software Development &
                                            customization</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Data Warehouse & EIS
                                        </h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Document Image
                                            processing</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 17a5 5 0 01-.916-9.916 5.002 5.002 0 019.832 0A5.002 5.002 0 0116 17m-7-5l3-3m0 0l3 3m-3-3v12">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Internet Services</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Web-based Document
                                            Management System</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-gray-900">Credit Scoring System
                                        </h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3
                            class="my-4 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            Products
                        </h3>
                        <ul class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10">
                            <li>
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">CiBS</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Islamic Banking / Financing System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">CNS2000</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Custodian & Nominees Management
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">TMS2000</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Trustee Management System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">SIM2020</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Shares Investments Management System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">EIS</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Executive Information System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 17a5 5 0 01-.916-9.916 5.002 5.002 0 019.832 0A5.002 5.002 0 0116 17m-7-5l3-3m0 0l3 3m-3-3v12">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">CIF</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Customer Information System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">I-Fund</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Fund Management System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">CSC-HRP</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Human-Resource and Payroll System
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10 md:mt-0">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-md bg-white text-indigo-500">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14">
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg leading-6 font-medium text-white">SPFiling</h5>
                                        <p class="mt-2 text-base leading-6 text-gray-900">
                                            Filing Management System
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- clients -->
    <div id="clients" class="py-12 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h3
                    class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    Clients
                </h3>
                <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
                    List of clients that has been dealing with us
                </p>
            </div>

            <div class="mt-10">
                <ul class="grid grid-cols-2 col-gap-4 md:grid md:grid-cols-3 md:col-gap-0 md:row-gap-8">
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/mpob.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/muamalat.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/zanz.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/kobpm.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/affin.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/tekun.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/komani.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/ssm.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-center">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-auto" src="{{ asset('img/clients/felda.png') }}" alt="" />
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- contact -->
    <div id="contact" class="py-12 bg-gray-400">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h3
                    class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    Contact Us
                </h3>
            </div>

            <div class="mt-10">
                <div class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10">
                    <div class="text-center">
                        <h4 class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            For Enquiry
                        </h4>
                        <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-900 lg:mx-auto">
                            Email us at:
                        </p>
                        <ul class="mt-3 list-inside">
                            <li>admin@csc.net.my</li>
                            <li class="mt-2">info@csc.net.my</li>
                        </ul>
                        <h4 class="mt-8 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            Address
                        </h4>
                        <p class="mt-3 max-w-2xl text-l leading-7 text-gray-900 lg:mx-auto">
                            No. 11, Jalan 9/6,<br>Taman IKS, Seksyen 9,<br>43650 Bandar Baru Bangi,<br>Selangor, Malaysia
                        </p>
                        <h4 class="mt-8 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            Phone
                        </h4>
                        <p class="mt-3 max-w-2xl text-l leading-7 text-gray-900 lg:mx-auto">
                            03-8922 9588
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.1212340534252!2d101.7496390398879!3d2.962858375265061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdca2d0ac567eb%3A0xf602a620f3d30201!2s11%2C+Jalan+9%2F6%2C+Taman+Iks%2C+43650+Bandar+Baru+Bangi%2C+Selangor!5e0!3m2!1sen!2smy!4v1535600403791" style="border:0" allowfullscreen="" width="450" height="450" frameborder="0"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="py-6 bg-indigo-800">
        <small class="flex justify-center text-white">
            © 1999-{{ now()->year }} Creative System Consultant Sdn. Bhd.
        </small>
    </div>
</body>

</html>
