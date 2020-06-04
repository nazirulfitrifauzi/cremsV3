@extends('layouts.app')

@section('content')
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
                        <a href="" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Add
                            Role</a>
                    </nav>
                </div>
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Add Role
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <div class="text-lg leading-6 ">
                                    <label for="title" class="sr-only">Title</label>
                                    <div class="relative rounded-md shadow-sm font-medium text-gray-900">
                                        <input id="title" name="title"
                                            class="form-input block w-full sm:text-sm sm:leading-5 @error('title') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                                            placeholder="Role Title" />
                                        @error('title')
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
                                    @error('title')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-1 text-lg leading-6 ">
                                    <label for="description" class="sr-only">Description</label>
                                    <div class="relative rounded-md shadow-sm font-medium text-gray-900">
                                        <input id="description" name="description"
                                            class="form-input block w-full sm:text-sm sm:leading-5 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                                            placeholder="Role Description" />
                                        @error('description')
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
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="attendances"
                                                        class="font-medium text-gray-700">Attendances</label>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="leaves" name="leaves" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                </div>
                                                <div class="pl-8 text-sm leading-5">
                                                    <label for="leaves" class="font-medium text-gray-700">Leaves</label>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="absolute flex items-center h-5">
                                                    <input id="claims" name="claims" type="checkbox" value="1"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
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
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
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

</script>
@endpush
