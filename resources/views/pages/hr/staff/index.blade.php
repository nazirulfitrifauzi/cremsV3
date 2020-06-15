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
                            Staff List
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                @sortablelink('name','Name')
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                @sortablelink('staff_info.ic_no','IC Number')
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                @sortablelink('phone','Phone Number')
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                                @sortablelink('active','Status')
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($staff as $staffs)
                                            <tr class="hover:bg-blue-100 transition duration-150 ease-in-out">
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    {{ $staffs->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    {{ (!$staffs->staff_info) ? '' : $staffs->staff_info->ic_no }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-normal border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    {{ $staffs->phone }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($staffs->active == 1)
                                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-200 text-green-800">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-200 text-red-800">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                                                    @if($staffs->id !== auth()->user()->id)
                                                        <div class="flex justify-center">
                                                            <span class="inline-flex rounded-md shadow-sm mx-1">
                                                                <a href="{{ route('staff.show', $staffs->id) }}" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-in-out duration-150">
                                                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Manage
                                                                </a>
                                                            </span>
                                                        </div>
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
                            <div class="mt-4">{{ $staff->links() }}</div>
                        </div>
                    </div>
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
