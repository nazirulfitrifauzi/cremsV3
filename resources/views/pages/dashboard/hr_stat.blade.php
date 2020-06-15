<div>
    <h3 class="text-lg leading-6 font-medium text-gray-600">
        Human Resources
    </h3>
    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Attendances {{ now()->format('F Y') }}
                            </dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl leading-8 font-semibold text-gray-900">
                                    {{ $attend }} / {{ $period }} days
                                </div>
                                @php
                                    $attend_percent = ($attend/$period) * 100;
                                @endphp
                                <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold @if($attend_percent <= 30) text-red-600 @elseif($attend_percent >= 31 && $attend_percent <= 60) text-yellow-600 @else text-green-600 @endif">
                                    {{ number_format($attend_percent,2) }} %
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm leading-5">
                    <a href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                        View all
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Leaves {{ now()->format('Y') }}
                            </dt>
                            <dd class="flex items-baseline">
                                @php
                                    if(auth()->user()->role == 1 || auth()->user()->role == 3) { // admin or client
                                        $current_leave = 0;
                                        $all_leave = 0;
                                        $leave_percent = 0;
                                    } else { // staff
                                        if($leave->isEmpty()) {
                                            $current_leave = 0;
                                            $all_leave = 0;
                                        } else {
                                            $current_leave = $leave[0]->AL + $leave[0]->MC + $leave[0]->EL;
                                            $all_leave = $leave[0]->leave;
                                        }

                                        if(is_null($all_leave) || $all_leave == 0) {
                                            $leave_percent = 0;
                                        } else {
                                            $leave_percent = ($current_leave / $all_leave) * 100;
                                        }
                                    }
                                @endphp
                                <div class="text-2xl leading-8 font-semibold text-gray-900">
                                    {{ floatval($current_leave) }} / {{ floatval($all_leave) }} Days
                                </div>
                                <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold @if($leave_percent <= 50) text-green-600 @elseif($leave_percent >= 51 && $leave_percent <= 80) text-yellow-600 @else text-red-600 @endif">
                                    {{ number_format($leave_percent, 2) }} %
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm leading-5">
                    <a href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                        View all
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                Claims {{ now()->format('Y') }}
                            </dt>
                            <dd class="flex items-baseline">
                                @php
                                    if(auth()->user()->role == 1 || auth()->user()->role == 3) { // admin or client
                                        $current_claim = 0;
                                    } else { // staff
                                        if($claim->isEmpty()) {
                                            $current_claim = 0;
                                        } else {
                                            $current_claim = $claim[0]->CLM + $claim[0]->CLO;
                                        }
                                    }
                                @endphp
                                <div class="text-2xl leading-8 font-semibold text-gray-900">
                                    RM {{ number_format($current_claim,2) }}
                                </div>
                                {{-- <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-red-600">
                                    <svg class="self-center flex-shrink-0 h-5 w-5 text-red-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">
                                        Decreased by
                                    </span>
                                    3.2%
                                </div> --}}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm leading-5">
                    <a href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                        View all
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
