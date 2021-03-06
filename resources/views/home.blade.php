@extends('layouts.app')

@section('content')
<main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">

    <!-- attendance modal -->
    @if(auth()->user()->role == 2 || auth()->user()->role == 3)
    <!-- check staff -->
    @if($check == false)
    <div
        class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center notification">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>


        <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <h2 class="text-center text-xl leading-6 font-medium text-gray-900 mb-4">
                Attendances
            </h2>

            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="name" type="text" readonly
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="{{ ucwords(strtolower(auth()->user()->name)) }}" />
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="status" class="block text-sm font-medium leading-5 text-gray-700">
                        Status
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="status" name="status" required
                            class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="1">Start</option>
                            <option value="0">End</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="location" class="block text-sm font-medium leading-5 text-gray-700">
                        Location
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="location" name="location" required
                            class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="Office">Office</option>
                            <option value="Client Site">Client Site</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="remarks" class="block text-sm font-medium leading-5 text-gray-700">
                        Remarks
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="remarks" name="remarks" type="text"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Update Attendances
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endif

    <!-- Notification -->
    @if (session('status'))
    <div
        class="fixed mt-12 inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end notification">
        <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <!-- title -->
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <!-- Replace with your content -->
        <div class="py-4">
            @include('pages.dashboard.hr_stat')
            @include('pages.dashboard.project_stat')
        </div>
        <!-- /End replace -->
    </div>
</main>
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
