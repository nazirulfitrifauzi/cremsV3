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
        <div class="py-4" x-data="{ tab: 'all', ...approve_modal(), ...reject_modal() }">

            @if(auth()->user()->ual == '2')
                {{-- tab --}}
                <div class=" mb-8">
                    <div class="sm:hidden">
                        <select aria-label="Selected tab" class="form-select block w-full" @change="tab = $event.target.value">
                            <option x-bind:value = "'personal'">Personal</option>
                            <option x-bind:value = "'all'" selected>All Staff</option>
                        </select>
                    </div>
                    <div class="hidden sm:block">
                        <div class="border-b border-gray-200">
                            <nav class="flex -mb-px">
                                <button @click.prevent="tab = 'personal'"
                                    class="group inline-flex items-center py-4 px-1 border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                    :class="{ 'border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700' : tab === 'personal'}"
                                    :class="{ 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300' : tab !== 'personal'}"
                                >
                                    <svg 
                                        class="-ml-0.5 mr-2 h-5 w-5"
                                        :class="{ 'text-indigo-500 group-focus:text-indigo-600' : tab === 'personal' }"
                                        :class="{ 'text-gray-400 group-hover:text-gray-500 group-focus:text-gray-600' : tab !== 'personal' }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Personal</span>
                                </button>
                                <button @click.prevent="tab = 'all'"
                                    class="ml-8 group inline-flex items-center py-4 px-1 border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                    :class="{ 'border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700' : tab === 'all'}"
                                    :class="{ 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300' : tab !== 'all'}"
                                >
                                    <svg 
                                        class="-ml-0.5 mr-2 h-5 w-5"
                                        :class="{ 'text-indigo-500 group-focus:text-indigo-600' : tab === 'all' }"
                                        :class="{ 'text-gray-400 group-hover:text-gray-500 group-focus:text-gray-600' : tab !== 'all' }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    <span>All Staff</span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
                {{-- end tab --}}

                {{-- personal tab --}}
                <div
                    class="flex flex-col"
                    x-show="tab === 'personal'"
                >
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('type','Type')
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('reason','Reason')
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('start','Start')
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('end','End')
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('days','Days')
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                            @sortablelink('status','Status')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse ($personal as $personals)
                                    <tr class="hover:bg-blue-100 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            @if($personals->type == 'AL')
                                            Annual Leave
                                            @elseif($personals->type == 'HL')
                                            Half Day
                                            @elseif($personals->type == 'MC')
                                            Medical Leave
                                            @elseif($personals->type == 'EL')
                                            Emergency Leave
                                            @elseif($personals->type == 'UP')
                                            Unpaid Leave
                                            @elseif($personals->type == 'CL')
                                            Compassionate Leave
                                            @elseif($personals->type == 'M')
                                            Maternity Leave
                                            @elseif($personals->type == 'P')
                                            Paternity Leave
                                            @elseif($personals->type == 'X')
                                            Unrecorded Leave
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-normal border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            {{ $personals->reason }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            @if($personals->type == 'HL')
                                            {{ date('d/m/Y, g:ia', strtotime($personals->start) )  }}
                                            @else
                                            {{ date('d/m/Y', strtotime($personals->start) )  }}
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            @if($personals->type == 'HL')
                                            {{ date('d/m/Y, g:ia', strtotime($personals->end) ) }}
                                            @else
                                            {{ date('d/m/Y', strtotime($personals->end) ) }}
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            {{ floatval($personals->days) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                            @if($personals->status == 0)
                                            <span
                                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-orange-200 text-orange-800">
                                                Under Review
                                            </span>
                                            @elseif($personals->status == 1)
                                            <span
                                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-200 text-green-800">
                                                Approved
                                            </span>
                                            @else
                                            <span
                                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-200 text-red-800">
                                                Rejected
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-600 text-center">
                                            No Data Found!
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-4">{{ $personal->links() }}</div>
                    </div>
                </div>
                {{-- end personal tab --}}
            @endif
            {{-- all tab --}}
            <div 
                class="flex flex-col"
                x-show="tab === 'all'"
            >
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    @if (auth()->user()->ual == '1' || auth()->user()->ual == '2')
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('user.name','Name')
                                    </th>
                                    @endif
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('type','Type')
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('reason','Reason')
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('start','Start')
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('end','End')
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('days','Days')
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                        @sortablelink('status','Status')
                                    </th>
                                    @if (auth()->user()->ual == '1' || auth()->user()->ual == '2')
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider text-center">
                                        Action
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($leave as $leaves)
                                <tr class="hover:bg-blue-100 transition duration-150 ease-in-out">
                                    @if (auth()->user()->ual == '1' || auth()->user()->ual == '2')
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        {{ $leaves->user->name }}
                                    </td>
                                    @endif
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        @if($leaves->type == 'AL')
                                        Annual Leave
                                        @elseif($leaves->type == 'HL')
                                        Half Day
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
                                    <td
                                        class="px-6 py-4 whitespace-normal border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        {{ $leaves->reason }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        @if($leaves->type == 'HL')
                                        {{ date('d/m/Y, g:ia', strtotime($leaves->start) )  }}
                                        @else
                                        {{ date('d/m/Y', strtotime($leaves->start) )  }}
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        @if($leaves->type == 'HL')
                                        {{ date('d/m/Y, g:ia', strtotime($leaves->end) ) }}
                                        @else
                                        {{ date('d/m/Y', strtotime($leaves->end) ) }}
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        {{ floatval($leaves->days) }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        @if($leaves->status == 0)
                                        <span
                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-orange-200 text-orange-800">
                                            Under Review
                                        </span>
                                        @elseif($leaves->status == 1)
                                        <span
                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-200 text-green-800">
                                            Approved
                                        </span>
                                        @else
                                        <span
                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-200 text-red-800">
                                            Rejected
                                        </span>
                                        @endif
                                    </td>
                                    @if (auth()->user()->ual == '1' || auth()->user()->ual == '2')
                                    @if($leaves->status == 0)
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        @if($leaves->user_id != auth()->user()->id)
                                            <div class="flex justify-center">
                                                <span class="inline-flex rounded-md shadow-sm mx-1">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150"
                                                        @click="approve_open('{{ $leaves->id }}', '{{ $leaves->user->name }}', '{{ $leaves->days }}', '{{ $leaves->start }}', '{{ $leaves->end }}')">
                                                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Approve
                                                    </button>
                                                </span>
                                                <span class="inline-flex rounded-md shadow-sm mx-1">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150"
                                                        @click="reject_open('{{ $leaves->id }}', '{{ $leaves->user->name }}', '{{ $leaves->days }}', '{{ $leaves->start }}', '{{ $leaves->end }}')">
                                                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Reject
                                                    </button>
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    @else
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                        {{-- dummy content for border --}}
                                    </td>
                                    @endif
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8"
                                        class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-600 text-center">
                                        No Data Found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- approve modal -->
                        <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center"
                            x-show="approve_isOpen()" x-cloak>
                            <div class="fixed inset-0 transition-opacity" x-show="approve_isOpen()"
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline"
                                x-show="approve_isOpen()" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <div>
                                    <div
                                        class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                        <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            Approve Leave Application?
                                        </h3>
                                        <div class="mt-2">
                                            <p id="app_desc" class="text-sm leading-5 text-gray-500"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                    <span class="flex w-full rounded-md shadow-sm sm:col-start-1">
                                        <button id="app_button" type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Approve
                                        </button>
                                    </span>
                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-2">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                            @click="approve_close()">
                                            Cancel
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div> <!-- end approve modal-->

                        <!-- reject modal -->
                        <div class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center"
                            x-show="reject_isOpen()" x-cloak>
                            <div class="fixed inset-0 transition-opacity" x-show="reject_isOpen()"
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline"
                                x-show="reject_isOpen()" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            Reject Leave Application!
                                        </h3>
                                        <div class="mt-2">
                                            <p id="rej_desc" class="text-sm leading-5 text-gray-500"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                        <button id="rej_button" type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Reject
                                        </button>
                                    </span>
                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                            @click="reject_close()">
                                            Cancel
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div> <!-- end reject modal -->

                    </div>
                    <div class="mt-4">{{ $leave->links() }}</div>
                </div>
            </div>
            {{-- end all tab --}}
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

    function approve_modal() {
        return {
            app_show: false,
            approve_open(id, name, days, start, end) {
                this.app_show = true;
                document.getElementById("app_desc").innerHTML = "" + name + " apply leave for " + parseFloat(days)
                    .toPrecision() + " days, start from " + moment(start).format('DD/MM/YYYY') + " until " + moment(end)
                    .format('DD/MM/YYYY');
                document.getElementById("app_button").onclick = function () {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "leave/approve/" + id,
                        data: {
                            '_token': CSRF_TOKEN,
                            '_method': 'PATCH'
                        },
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                window.location = "{{ route('leave.index')}}";
                                setTimeout(function () {
                                    $('.notification').animate({
                                        opacity: '1'
                                    });
                                }, 500);

                                setTimeout(function () {
                                    $('.notification').fadeOut('fast');
                                }, 7000);
                            }
                        }
                    });
                }
            },
            approve_close(id) {
                this.app_show = false
            },
            approve_isOpen(id) {
                return this.app_show === true
            },
        }
    }

    function reject_modal() {
        return {
            rej_show: false,
            reject_open(id, name, days, start, end) {
                this.rej_show = true;
                document.getElementById("rej_desc").innerHTML = "" + name + " apply leave for " + parseFloat(days)
                    .toPrecision() + " days, start from " + moment(start).format('DD/MM/YYYY') + " until " + moment(end)
                    .format('DD/MM/YYYY');
                document.getElementById("rej_button").onclick = function () {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "leave/reject/" + id,
                        data: {
                            '_token': CSRF_TOKEN,
                            '_method': 'PATCH'
                        },
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                window.location = "{{ route('leave.index')}}";
                                setTimeout(function () {
                                    $('.notification').animate({
                                        opacity: '1'
                                    });
                                }, 500);

                                setTimeout(function () {
                                    $('.notification').fadeOut('fast');
                                }, 7000);
                            }
                        }
                    });
                }
            },
            reject_close(id) {
                this.rej_show = false
            },
            reject_isOpen(id) {
                return this.rej_show === true
            },
        }
    }

</script>
@endpush
