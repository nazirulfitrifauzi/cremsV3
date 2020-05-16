@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <!-- Notification -->
    @if (session('status'))
        <div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end opacity-0 notification">
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
                                    New link sent!
                                </p>
                                <p class="mt-1 text-sm leading-5 text-gray-500">
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- content -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-12 w-auto" src="{{ asset('img/logo/csc_blue.png') }}" alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            Reset Password
        </h2>
        <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
            Or
            <a href="{{ route('login') }}"
                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                try to login again
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm text-center font-medium leading-5 text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" />
                        
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="submit"
                            class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150"
                            onclick="document.getElementById('app').classList.add('cursor-wait');">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
                                    clip-rule="evenodd" />
                            </svg>
                            Send Password Reset Link
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

            @if (session('status'))
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
