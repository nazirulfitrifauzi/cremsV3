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
                        <a href="" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Calendar</a>
                    </nav>
                </div>
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Calendar
                        </h2>
                        <!-- legend -->
                        <div class="hidden sm:block ">
                            <div class="flex mx-auto">
                                <div class="mt-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-blue-900"></div>
                                    <p class="ml-2 text-s">Annual</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-teal-500"></div>
                                    <p class="ml-2 text-s">Half Day</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-green-500"></div>
                                    <p class="ml-2 text-s">Medical</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-orange-600"></div>
                                    <p class="ml-2 text-s">Emergency</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-red-600"></div>
                                    <p class="ml-2 text-s">Unpaid</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-purple-600"></div>
                                    <p class="ml-2 text-s">Compassionate</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-pink-600"></div>
                                    <p class="ml-2 text-s">Maternity/Paternity</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-gray-600"></div>
                                    <p class="ml-2 text-s">Unrecorded</p>
                                </div>
                                <div class="mt-4 ml-4 flex">
                                    <div class="h-4 w-4 rounded-lg bg-yellow-300"></div>
                                    <p class="ml-2 text-s">Pubic Holiday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div id='calendar'></div>
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
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },

            googleCalendarApiKey: 'AIzaSyADnip91wbBqE3zSJBGkTfL4sbuZYR-Slg',
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            eventRender: function (info) {
                $(info.el).tooltip({
                    title: info.event.title
                });
            },
            businessHours: {
                daysOfWeek: [1, 2, 3, 4, 5],
                startTime: '9:00',
                endTime: '18:00',
            },
            eventSources: [
                [
                    @foreach($leave as $leaves)
                    {
                        title : '{{ $leaves->user->name }} - {{ $leaves->reason }}',
                        description : '{{ $leaves->title }}',
                        @if ($leaves->type == 'HL')
                            start : '{{ $leaves->start }}',
                            end : '{{ $leaves->end }}',
                        @else
                            start : '{{ $leaves->start }}',
                            end : '{{ $leaves->end->addDays(1) }}',
                            allDay: true,
                        @endif

                        @if ($leaves->type == 'AL')
                            color: '#2a4365',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'HL')
                            color: '#38b2ac',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'MC')
                            color: '#48bb78',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'EL')
                            color: '#dd6b20',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'UP')
                            color: '#e53e3e',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'CL')
                            color: '#805ad5',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'M' || $leaves->type == 'P')
                            color: '#d53f8c',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'X')
                            color: '#718096',
                            textColor: '#ffffff',
                        @endif
                        
                        constraint: 'businessHours'
                    },
                    @endforeach
                ],
                {
                    googleCalendarId: 'en.malaysia#holiday@group.v.calendar.google.com',
                    color: '#faf089',
                    textColor: '#000000'
                }
            ]
        });

        calendar.render();
    });

</script>
@endpush
