@extends('layouts.app')

@section('style')
<style>
    .popper,
    .tooltip {
        position: absolute;
        z-index: 9999;
        background: #FFC107;
        color: black;
        width: 150px;
        border-radius: 3px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
        padding: 10px;
        text-align: center;
    }

    .style5 .tooltip {
        background: #1E252B;
        color: #FFFFFF;
        max-width: 200px;
        width: auto;
        font-size: .8rem;
        padding: .5em 1em;
    }

    .popper .popper__arrow,
    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
    }

    .tooltip .tooltip-arrow,
    .popper .popper__arrow {
        border-color: #FFC107;
    }

    .style5 .tooltip .tooltip-arrow {
        border-color: #1E252B;
    }

    .popper[x-placement^="top"],
    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }

    .popper[x-placement^="top"] .popper__arrow,
    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .popper[x-placement^="bottom"],
    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }

    .tooltip[x-placement^="bottom"] .tooltip-arrow,
    .popper[x-placement^="bottom"] .popper__arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent;
        border-right-color: transparent;
        border-top-color: transparent;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="right"],
    .popper[x-placement^="right"] {
        margin-left: 5px;
    }

    .popper[x-placement^="right"] .popper__arrow,
    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent;
        border-top-color: transparent;
        border-bottom-color: transparent;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .popper[x-placement^="left"],
    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }

    .popper[x-placement^="left"] .popper__arrow,
    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    /* basic positioning */
    .legend {
        list-style: none;
    }

    .legend li {
        float: left;
        margin-right: 10px;
    }

    .legend span {
        border: 1px solid #ccc;
        float: left;
        width: 12px;
        height: 12px;
        margin: 2px;
    }

    /* your colors */
    .legend .Annual {
        background-color: #083561;
    }

    .legend .Halfday {
        background-color: #23a699;
    }

    .legend .Medical {
        background-color: #228f2a;
    }

    .legend .Emergency {
        background-color: #f56e25;
    }

    .legend .Unpaid {
        background-color: #d41111;
    }

    .legend .Compassionate {
        background-color: #70196f;
    }

    .legend .Maternity {
        background-color: #e6397b;
    }

    .legend .Unrecorded {
        background-color: #52575c;
    }

    .legend .Public {
        background-color: #fffa70;
    }

</style>
@endsection

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
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Leave
                        </h2>
                    </div>
                    <span class="mt-2 sm:mt-0 inline-flex rounded-md shadow-sm">
                        <a href="{{ route('leave.create') }}" type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Apply Leave
                        </a>
                    </span>
                    <span class="ml-3 mt-2 sm:mt-0 inline-flex rounded-md shadow-sm">
                        <a href="{{ route('leave.calendar') }}" type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            Calendar
                        </a>
                    </span>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div
                                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                Type
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                Reason
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                Start
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                End
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                Days
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($leave as $leaves)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($leaves->type == 'AL')
                                                        @if($leaves->halfDay == '0')
                                                            Annual Leave
                                                        @elseif($leaves->halfDay == '1')
                                                            Half Day
                                                        @endif
                                                    @elseif($leaves->type == 'MC')
                                                        Medical Leave
                                                    @elseif($leaves->type == 'EL')
                                                        Emergency Leave
                                                    @elseif($leaves->type == 'UP')
                                                        Unpaid Leave
                                                    @elseif($leaves->type == 'CL')
                                                        Compassionate Leave
                                                    @elseif($leaves->type == 'M')
                                                        Maternity Leave
                                                    @elseif($leaves->type == 'P')
                                                        Paternity Leave
                                                    @elseif($leaves->type == 'X')
                                                        Unrecorded Leave
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    {{ $leaves->reason }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($leaves->type == 'AL' && $leaves->halfDay == '1') 
                                                        {{ date('d/m/Y, g:ia', strtotime($leaves->start) )  }}
                                                    @else
                                                        {{ date('d/m/Y', strtotime($leaves->start) )  }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($leaves->type == 'AL' && $leaves->halfDay == '1')
                                                        {{ date('d/m/Y, g:ia', strtotime($leaves->end) ) }}
                                                    @else
                                                        {{ date('d/m/Y', strtotime($leaves->end) ) }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    {{ str_pad($leaves->days, 3, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($leaves->status == 0)
                                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-orange-200 text-orange-800">
                                                            Under Review
                                                        </span>
                                                    @elseif($leaves->status == 1)
                                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-200 text-green-800">
                                                            Approved
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-200 text-red-800">
                                                            Rejected
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-600 text-center">
                                                    No Data Found!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">{{ $leave->links() }}</div>
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
