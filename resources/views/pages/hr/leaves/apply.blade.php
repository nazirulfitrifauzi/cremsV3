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

            @if (session('error'))
            <div
                class="fixed mt-12 inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end notification">
                <div class="max-w-sm w-full bg-red-400 shadow-lg rounded-lg pointer-events-auto">
                    <div class="rounded-lg shadow-xs overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm leading-5 font-medium text-white">
                                        {{ session('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- breadcrumbs -->
                <div>
                    <nav class="hidden sm:flex items-center text-sm leading-5 font-medium">
                        <a href="{{ route('leave.index') }}"
                            class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Leaves</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Apply Leave</a>
                    </nav>
                </div>
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Apply Leave
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <form action="{{ route('leave.store') }}" method="POST">
                        @csrf

                        <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <div class="text-lg leading-6 ">
                                    <label for="reason" class="sr-only">Reason</label>
                                    <div class="relative rounded-md shadow-sm font-medium text-gray-900">
                                        <input id="reason" name="reason"
                                            class="form-input block w-full sm:text-sm sm:leading-5 @error('reason') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                                            placeholder="Reason" />
                                        @error('reason')
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-0" x-data="{ open: ''}">
                                <dl>
                                    <div class="sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Leave Type
                                        </dt>
                                        <dd
                                            class="mt-1 text-sm leading-5 text-gray-900 grid grid-cols-2 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="max-w-xs rounded-md shadow-sm">
                                                <select id="type" name="type" class="block form-select transition duration-150 ease-in-out sm:text-sm sm:leading-5" @change="open = $event.target.value">
                                                    <option value="AL">Annual Leave</option>
                                                    <option x-bind:value="'HL'">Halfday (Annual Leave)</option>
                                                    <option value="MC">Medical Leave</option>
                                                    <option value="EL">Emergency Leave</option>
                                                    <option value="UP">Unpaid Leave</option>
                                                    <option value="CL">Compassionate Leave</option>
                                                    <option value="M">Maternity Leave</option>
                                                    <option value="P">Paternity Leave</option>
                                                    <option value="X">Unrecorded Leave</option>
                                                </select>
                                            </div>
                                        </dd>
                                    </div>
                                    <div x-show="open === 'HL'" class="mt-8 sm:mt-0 sm:grid sm:grid-cols-4 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Halfday
                                        </dt>
                                        <dd
                                            class="mt-1 text-sm leading-5 text-gray-900 grid grid-cols-1 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="am" name="am" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="am" class="font-medium text-gray-700">AM</label>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="pm" name="pm" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="pm" class="font-medium text-gray-700">PM</label>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-4 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Leave Date
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="max-w-xs mt-2 sm:mt-0">
                                                <label for="start" class="text-sm leading-5 font-medium text-gray-500">From</label>
                                                <input id="start" name="start" type="date" value=""
                                                class="mt-1 form-input block py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('start') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            </div>
                                            <div class="max-w-xs mt-2 sm:mt-0">
                                                <label for="end" class="text-sm leading-5 font-medium text-gray-500">To</label>
                                                <input id="end" name="end" type="date" value=""
                                                class="mt-1 form-input block py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('end') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="px-4 py-5 border-t border-gray-200 bg-gray-200 sm:px-6">
                                <div class="flex justify-center sm:justify-end">
                                    <span class="inline-flex rounded-md shadow-sm">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                                </path>
                                                <path
                                                    d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                                </path>
                                            </svg>
                                            Save
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
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

        @if(session('status') || session('notAttend') || session('error'))
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
