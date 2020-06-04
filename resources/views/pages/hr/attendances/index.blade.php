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
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Attendances
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-4 lg:-mx-3 xl:-mx-3">
                        @php
                            foreach ($staff as $staffs) {
                                $today = Carbon\Carbon::now()->toDateString();
                                $check = App\Models\Attendance::where('user_id',$staffs->id)->whereDate('login_at',$today)->exists();
                        @endphp
                                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-4 md:px-4 md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                                    <div class="border {{ ($check == true) ? 'border-green-300 bg-green-200' : 'border-red-300 bg-red-200' }} md:flex bg-white rounded-lg p-6">
                                        <img class="h-16 w-16 md:h-20 md:w-20 rounded-full mx-auto md:mx-0" src="{{ asset('img/avatar/').'/'.auth()->user()->avatar }}">
                                        <div class="md:ml-6 text-center md:text-left">
                                            <h2 class="text-lg">{{ $staffs->name }}</h2>
                                            <div class="mt-1 text-gray-600 text-sm">Location: {{ $staffs->attendances()->whereDate('login_at',$today)->value('location') }}</div>
                                            <div class="mt-1 text-gray-600 text-sm">
                                                Login at: 
                                                @if ($check == true)
                                                    {{ $staffs->attendances()->whereDate('login_at',$today)->value('login_at')->format('d M Y h:i A') }}
                                                @endif
                                            </div>
                                            <div class="mt-1 text-gray-600 text-sm">Remarks: {{ $staffs->attendances()->whereDate('login_at',$today)->value('remarks') }}</div>
                                        </div>
                                    </div>
                                </div>
                        @php
                            }
                        @endphp
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
@endsection

@push('js')
<script>
    $(document).ready(function () {

        @if(session('status') || session('notAttend'))
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
