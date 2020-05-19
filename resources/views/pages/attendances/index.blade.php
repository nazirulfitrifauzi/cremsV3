@extends('layouts.app')

@section('content')
<div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }"
    @keydown.window.escape="sidebarOpen = false">
    <!-- Off-canvas menu for mobile -->
    <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
        <div class="fixed inset-0 flex z-40">
            <div @click="sidebarOpen = false" x-show="sidebarOpen"
                x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0"
                style="display: none;">
                <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
            </div>
            <div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
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
                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    @include('layouts.sidebar.mobile')
                </div>
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
            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                @include('layouts.sidebar.desktop')
            </div>
        </div>
    </div>
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        @include('layouts.navbar.topbar')

        <main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0" x-data=""
            x-init="$el.focus()">

            <!-- Notification -->
            @if (session('status'))
            <div
                class="fixed mt-12 inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end notification">
                <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
                    <div class="rounded-lg shadow-xs overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm leading-5 font-medium text-gray-900">
                                        {{ session('status') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Attendances</h1>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-4 lg:-mx-3 xl:-mx-3">
                        <div
                            class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-4 md:px-4 md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                            <!-- Column Content -->
                            <div class="bg-white border border-gray-300 overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <!-- Content goes here -->
                                </div>
                            </div>
                        </div>
                        <div
                            class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-4 md:px-4 md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                            <!-- Column Content -->
                            <div class="bg-red-200 border border-red-300 overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <!-- Content goes here -->
                                </div>
                            </div>
                        </div>
                        <div
                            class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-4 md:px-4 md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                            <!-- Column Content -->
                            <div class=" bg-green-200 border border-green-300 overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <!-- Content goes here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>

    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {

        @if(session('status') || session('notAttend'))
        setTimeout(function () {
            $('.notification').animate({
                opacity: '1'
            });
        }, 500);

        setTimeout(function () {
            $('.notification').fadeOut('fast');
        }, 7000);
        @endif

    });

</script>
@endpush
