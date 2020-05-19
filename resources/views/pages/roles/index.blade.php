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
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Roles
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul>
                            @foreach ($roles as $role)
                            @if ($loop->first)
                            <li>
                                @else
                            <li class="border-t border-gray-200">
                                @endif
                                <a href="{{ route('roles.show', $role->id) }}"
                                    class="block hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out">
                                    <div class="px-4 py-4 flex items-center sm:px-6">
                                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                            <div>
                                                <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                                    {{ $role->title }}
                                                </div>
                                                <div class="mt-2 flex">
                                                    <div class="flex items-center text-sm leading-5 text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                                        </svg>
                                                        <span>
                                                            {{ $role->description }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex-shrink-0 sm:mt-0">
                                                <div class="flex overflow-hidden">
                                                    @foreach ($role->user as $users)
                                                    <img class="{{ ($loop->first) ? '' : '-ml-1' }} inline-block h-6 w-6 rounded-full text-white shadow-solid"
                                                        src="{{ asset('img/avatar/').'/'.$users->avatar }}" alt="" />
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-5 flex-shrink-0">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach

                            <li
                                class="border-t border-gray-200 font-medium bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out">
                                <a href="{{ route('roles.create') }}"
                                    class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                    <div class="px-4 py-4 flex items-center sm:px-6">
                                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                            <div>
                                                <div class="text-sm leading-5 font-medium text-white truncate">
                                                    <span class="inline-flex">
                                                        <svg class="-ml-0.5 mr-2 h-5 w-5" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                                        </svg>
                                                        Add New Role
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-5 flex-shrink-0">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
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

        @if(session('status'))
        setTimeout(function () {
            $('.notification').animate({
                opacity: '1'
            });
        }, 500);

        setTimeout(function () {
            $('.notification').fadeOut('fast');
        }, 5000);
        @endif

    });

</script>
@endpush
