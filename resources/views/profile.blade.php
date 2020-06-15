@extends('layouts.app')

@section('content')
<main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">

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
                    Profile
                </h2>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <!-- Replace with your content -->
        <div class="py-4">
            <form class="bg-white shadow overflow-hidden px-8 py-4 sm:rounded-lg"
                action="{{ route('profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Profile Information
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            This is your login information.
                        </p>
                    </div>
                    <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 border-t border-gray-200 pt-4">
                        <div class="sm:col-span-2 sm:row-span-2">
                            <label for="photo" class="block text-sm leading-5 font-medium text-gray-700">
                                Photo
                            </label>
                            <div class="mt-2 flex items-center">
                                <input type="file" name="avatar" id="avatar" class="hidden" />
                                <span id="avatar_default"
                                    class="{{ (auth()->user()->avatar !== NULL) ? 'hidden' : '' }} h-12 2-12 sm:h-32 sm:w-32 rounded-full overflow-hidden bg-gray-500 {{ ($errors->get('avatar') ? 'border-4 border-red-300 ' : '') }}">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <img id="avatar_uploaded" src=" 
                                    @if(auth()->user()->avatar !== NULL) 
                                        {{ asset('storage/Avatar/' . auth()->user()->avatar) }}
                                    @else
                                    @endif
                                    "
                                    class="{{ (auth()->user()->avatar !== NULL) ? '' : 'hidden' }} h-12 2-12 sm:h-32 sm:w-32 rounded-full overflow-hidden">
                                <span class="ml-5 rounded-md shadow-sm">
                                    <button type="button" id="avatar_button"
                                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                        Change
                                    </button>
                                </span>
                            </div>
                            @error('avatar')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="sm:col-span-4">
                            <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                                Full name
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="name" name="name"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ ($errors->get('name') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ auth()->user()->name }}" />
                            </div>
                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" name="email" type="email"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ ($errors->get('email') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ auth()->user()->email }}" />
                            </div>
                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">
                                Phone number
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="phone" name="phone"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5  {{ ($errors->get('phone') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ auth()->user()->phone }}" />
                            </div>
                            @error('phone')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class=" mt-16">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Staff Information
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            This information will be use throughout this system. Please complete it accordingly.
                        </p>
                    </div>
                    <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 border-t border-gray-200 pt-4">

                        <div class="sm:col-span-3">
                            <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                IC number
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="ic_no" name="ic_no"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ ($errors->get('ic_no') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ (isset($profile->ic_no)) ? $profile->ic_no : '' }}" />
                            </div>
                            @error('ic_no')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="address1" class="block text-sm font-medium leading-5 text-gray-700">
                                Address
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="address1" name="address1"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5  {{ ($errors->get('address1') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ (isset($profile->address1)) ? $profile->address1 : '' }}" />
                                @error('address1')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                                <input id="address2" name="address2"
                                    class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    value="{{ (isset($profile->address2)) ? $profile->address2 : '' }}" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="postcode" class="block text-sm font-medium leading-5 text-gray-700">
                                Postcode
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="postcode" name="postcode"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5  {{ ($errors->get('postcode') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ (isset($profile->postcode)) ? $profile->postcode : '' }}" />
                            </div>
                            @error('postcode')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="city" class="block text-sm font-medium leading-5 text-gray-700">
                                City
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="city" name="city"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ ($errors->get('city') ? 'border-red-300 ' : 'border-gray-300 ') }}"
                                    value="{{ (isset($profile->city)) ? $profile->city : '' }}" />
                            </div>
                            @error('city')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="country" class="block text-sm font-medium leading-5 text-gray-700">
                                State
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <select id="state" name="state"
                                    class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ ($errors->get('state') ? 'border-red-300 ' : 'border-gray-300 ') }}">
                                    <option disabled {{ (isset($profile->state)) ? '' : 'selected' }}>- Choose State -
                                    </option>
                                    <option value="johor"
                                        {{ (!$profile) ? '': (($profile->state == 'johor') ? 'selected' : '') }}>Johor
                                    </option>
                                    <option value="kedah"
                                        {{ (!$profile) ? '': (($profile->state == 'kedah') ? 'selected' : '') }}>Kedah
                                    </option>
                                    <option value="kelantan"
                                        {{ (!$profile) ? '': (($profile->state == 'kelantan') ? 'selected' : '') }}>
                                        Kelantan</option>
                                    <option value="melaka"
                                        {{ (!$profile) ? '': (($profile->state == 'melaka') ? 'selected' : '') }}>Melaka
                                    </option>
                                    <option value="negeri sembilan"
                                        {{ (!$profile) ? '': (($profile->state == 'negeri sembilan') ? 'selected' : '') }}>
                                        Negeri Sembilan</option>
                                    <option value="pahang"
                                        {{ (!$profile) ? '': (($profile->state == 'pahang') ? 'selected' : '') }}>Pahang
                                    </option>
                                    <option value="perak"
                                        {{ (!$profile) ? '': (($profile->state == 'perak') ? 'selected' : '') }}>Perak
                                    </option>
                                    <option value="perlis"
                                        {{ (!$profile) ? '': (($profile->state == 'perlis') ? 'selected' : '') }}>Perlis
                                    </option>
                                    <option value="pulau pinang"
                                        {{ (!$profile) ? '': (($profile->state == 'pulau pinang') ? 'selected' : '') }}>
                                        Pulau Pinang</option>
                                    <option value="sabah"
                                        {{ (!$profile) ? '': (($profile->state == 'sabah') ? 'selected' : '') }}>Sabah
                                    </option>
                                    <option value="sarawak"
                                        {{ (!$profile) ? '': (($profile->state == 'sarawak') ? 'selected' : '') }}>
                                        Sarawak</option>
                                    <option value="selangor"
                                        {{ (!$profile) ? '': (($profile->state == 'selangor') ? 'selected' : '') }}>
                                        Selangor</option>
                                    <option value="terengganu"
                                        {{ (!$profile) ? '': (($profile->state == 'terengganu') ? 'selected' : '') }}>
                                        Terengganu</option>
                                    <option value="wp kuala lumpur"
                                        {{ (!$profile) ? '': (($profile->state == 'wp kuala lumpur') ? 'selected' : '') }}>
                                        WP Kuala Lumpur</option>
                                </select>
                            </div>
                            @error('state')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class=" mt-16">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Human Resources Information
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            This information is generated by the system.
                        </p>
                    </div>
                    <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 border-t border-gray-200 pt-4">
                        <div class="sm:col-span-3">
                            <label for="start_date" class="block text-sm font-medium leading-5 text-gray-700">
                                Start working date
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="start_date" name="start_date"
                                    class="form-input block w-full transition duration-150 bg-gray-300 ease-in-out sm:text-sm sm:leading-5"
                                    value="{{ (!$profile || !$profile->start_work) ? '' : $profile->start_work->format('d F Y') }}" readonly />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="service_period" class="block text-sm font-medium leading-5 text-gray-700">
                                Service Period
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="service_period" name="service_period"
                                    class="form-input block w-full transition duration-150 bg-gray-300 ease-in-out sm:text-sm sm:leading-5"
                                    value="{{ (!$profile || !$profile->start_work) ? '' : rtrim($profile->start_work->diffForHumans(['parts' => 4]), "ago") }}" readonly />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 row-gap-6 col-gap-4 sm:grid-cols-7 sm:col-span-6">
                            <div class="col-span-2 sm:col-span-7">
                                <label for="ic_no" class="block text-base font-semibold leading-5 text-gray-600">
                                    Leaves
                                </label>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no"
                                    class="block inline-flex text-sm font-medium leading-5 text-gray-700">
                                    Annual

                                    {{-- info --}}
                                    <div  class="ml-3 relative" x-data="{ open: false }">
                                        <div>
                                            <button
                                                class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
                                                id="user-menu" aria-label="User menu" aria-haspopup="true"
                                                x-bind:aria-expanded="open" aria-expanded="false">
                                                <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path @mouseover="open = !open" @mouseout.away="open = false" fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-show="open"
                                            x-description="Profile dropdown panel, show/hide based on dropdown state."
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg z-50"
                                            style="display: none;">
                                            <div class="py-1 rounded-md bg-white shadow-xs" role="menu"
                                                aria-orientation="vertical" aria-labelledby="user-menu">
                                                <p class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                                                    role="menuitem">
                                                    Annual leave basis:
                                                </p>
                                                <p class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 transition ease-in-out duration-150">
                                                    Less than 5 years service<br>- 14 working days
                                                </p>
                                                <p class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 transition ease-in-out duration-150">
                                                    5 years service and above<br>- 21 working days
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end info --}}
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->AL) . ' / ' . floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->leave) }}" 
                                        readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no"
                                    class="block inline-flex text-sm font-medium leading-5 text-gray-700">
                                    Medical

                                    {{-- info --}}
                                    <div  class="ml-3 relative" x-data="{ open: false }">
                                        <div>
                                            <button
                                                class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
                                                id="user-menu" aria-label="User menu" aria-haspopup="true"
                                                x-bind:aria-expanded="open" aria-expanded="false">
                                                <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path @mouseover="open = !open" @mouseout.away="open = false" fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-show="open"
                                            x-description="Profile dropdown panel, show/hide based on dropdown state."
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg z-50"
                                            style="display: none;">
                                            <div class="py-1 rounded-md bg-white shadow-xs" role="menu"
                                                aria-orientation="vertical" aria-labelledby="user-menu">
                                                <p class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                                                    role="menuitem">
                                                    Medical leave basis:
                                                </p>
                                                <p class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 transition ease-in-out duration-150">
                                                    No hospitalizations<br>- 28 days
                                                </p>
                                                <p class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 transition ease-in-out duration-150">
                                                    Include hospitalizations<br>- 60 days
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end info --}}
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->MC) . ' / 28 @ 60' }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Emergency
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->EL) }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Unpaid
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->UP) }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Compassionate
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->CL) }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Maternity / Paternity
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->MP) }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Unrecorded
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input id="price"
                                        class="form-input block w-full pr-12 bg-gray-300 sm:text-sm sm:leading-5" placeholder="0"
                                        value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : floatval($profile->staff_leave->where('year',now()->format('Y'))[0]->X) }}" readonly />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 row-gap-6 col-gap-4 sm:grid-cols-2 sm:col-span-6">
                            <div class="col-span-2 sm:col-span-2">
                                <label for="ic_no" class="block text-base font-semibold leading-5 text-gray-600">
                                    Claims
                                </label>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Medical
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            RM
                                        </span>
                                    </div>
                                    <input id="price"
                                        class="form-input block w-full pl-12 pr-12 bg-gray-300 sm:text-sm sm:leading-5"
                                        placeholder="0.00" value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : number_format($profile->staff_claim->where('year',now()->format('Y'))[0]->CLM,2) }}" readonly />
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label for="ic_no" class="block text-sm font-medium leading-5 text-gray-700">
                                    Others
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                                            RM
                                        </span>
                                    </div>
                                    <input id="price"
                                        class="form-input block w-full pl-12 pr-12 bg-gray-300 sm:text-sm sm:leading-5"
                                        placeholder="0.00" value="{{ (!$profile || $profile->staff_leave->isEmpty()) ? '' : number_format($profile->staff_claim->where('year',now()->format('Y'))[0]->CLO,2) }}" readonly />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-5">
                    <div class="flex justify-end">
                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Save
                            </button>
                        </span>
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
<script>
    $("#avatar_button").click(function () {
        $("input[id='avatar']").click();
    });

    $("input[id='avatar']").on('change', function () {
        readURL(this);
        checkFiles();
    });

    var checkFiles = function () {
        if (document.getElementById("avatar").files.length > 0) {
            document.getElementById('avatar_default').classList.add('hidden');
            document.getElementById('avatar_uploaded').classList.remove('hidden');
        } else {
            document.getElementById('avatar_default').classList.remove('hidden');
            document.getElementById('avatar_uploaded').classList.add('hidden');
        }
    }

    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar_uploaded').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endpush
