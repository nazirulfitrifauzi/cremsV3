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
                <!-- breadcrumbs -->
                <div>
                    <nav class="hidden sm:flex items-center text-sm leading-5 font-medium">
                        <a href="{{ route('roles.index') }}"
                            class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Roles</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Role
                            Detail</a>
                    </nav>
                </div>
                <!-- title -->
                <div class="mt-2 grid grid-cols-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Role Details
                        </h2>
                    </div>
                    <div class="text-right sm:hidden">
                        <span class="inline-flex rounded-md shadow-sm">
                            <a href="{{ route('roles.index') }}" type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                                Back
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $role->title }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                                    {{ $role->description }}
                                </p>
                            </div>
                            <div class="px-4 py-5 sm:p-0">
                                <dl>
                                    <div class="sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Human Resources
                                        </dt>
                                        <dd
                                            class="mt-1 text-sm leading-5 text-gray-900 grid grid-cols-2 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="attendances" name="attendances" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        {{ ($role->attendances == 1) ? 'checked' : '' }} />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="attendances"
                                                        class="font-medium text-gray-700">Attendances</label>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="leaves" name="leaves" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        {{ ($role->leaves == 1) ? 'checked' : '' }} />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="leaves" class="font-medium text-gray-700">Leaves</label>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="claims" name="claims" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        {{ ($role->claims == 1) ? 'checked' : '' }} />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="claims" class="font-medium text-gray-700">Claims</label>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                    <div
                                        class="mt-8 sm:mt-0 sm:grid sm:grid-cols-4 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Roles
                                        </dt>
                                        <dd
                                            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="roles" name="roles" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        {{ ($role->roles == 1) ? 'checked' : '' }} />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="roles" class="font-medium text-gray-700">Roles</label>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="px-4 py-5 border-t border-gray-200 bg-gray-200 sm:px-6">
                                <div class="flex justify-center sm:justify-end">
                                    <div class="inline-flex" x-data="{ open: false }">
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
                                        </form>
                                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                                            <button role="button"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150"
                                                @click.prevent="open = true">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </span>

                                        <!-- delete modal -->
                                        <div x-show="open"
                                            class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
                                            <div x-show="open" x-description="Background overlay, show/hide based on modal state."
                                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 transition-opacity">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>

                                            <div x-show="open" x-description="Modal panel, show/hide based on modal state."
                                                x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
                                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                <div class="sm:flex sm:items-start">
                                                    <div
                                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                                            Delete Roles
                                                        </h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm leading-5 text-gray-500">
                                                                Are you sure you want to delete tis role? This role data will be
                                                                permanently removed from our servers forever. This action cannot be undone.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                        <a href="{{ route('roles.destroy',$role->id) }}" type="button"
                                                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                            onclick="event.preventDefault(); document.getElementById('deleterole-form').submit();"
                                                        >
                                                            Delete!
                                                        </a>
                                                        <form id="deleterole-form" action="{{ route('roles.destroy',$role->id) }}" method="POST" class="hidden">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </span>
                                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                                        <button @click="open = false" type="button"
                                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                            Cancel
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end delete modal -->
                        
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

        @if(session('status'))
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

    function deleteRole(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',

            url: "{{ url('roles')}}" + '/' + id,
            data: {
                '_token': CSRF_TOKEN,
                '_method': 'DELETE'
            },
            success: function () {
                window.location = "{{ url('roles')}}";
            }
        });
    }

</script>
@endpush
