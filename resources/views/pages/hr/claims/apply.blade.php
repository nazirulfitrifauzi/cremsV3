@extends('layouts.app')

@section('style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
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
                        <a href="{{ route('claim.index') }}"
                            class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Claim</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Apply Claim</a>
                    </nav>
                </div>
                <!-- title -->
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Apply Claim
                        </h2>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->
                <div class="py-4">
                    <form action="{{ route('claim.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <div class="text-lg leading-6 sm:grid sm:grid-cols-4 sm:gap-4">
                                    <label for="reason" class="flex items-center text-sm leading-5 font-medium text-gray-500">Claim Type</label>
                                    <div class="relative rounded-md font-medium text-gray-900">
                                        <div
                                            class="mt-1 text-sm leading-5 text-gray-900 grid grid-cols-2 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-32">
                                            <div class="max-w-xs rounded-md shadow-sm">
                                                <select id="type" name="type" class="block form-select transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                    <option value="medical" {{ old('type') == 'medical' ? 'selected':'' }}>Medical Claim</option>
                                                    <option value="other" {{ old('type') == 'other' ? 'selected':'' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-0">
                                <dl>
                                    <div class="sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6 sm:py-5">
                                        <dt class="flex items-center text-sm leading-5 font-medium text-gray-500">
                                            Amount
                                        </dt>
                                        <dd
                                            class="mt-1 text-sm leading-5 text-gray-900">
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="inset-y-0 pl-3">
                                                    <div class="absolute inset-y-0 flex items-center pointer-events-none">
                                                        <span class="{{ ($errors->get('amount') ? 'text-red-500' : 'text-gray-500') }} font-bold sm:text-sm sm:leading-5">
                                                            RM
                                                        </span>
                                                    </div>
                                                </div>
                                                <input id="amount" name="amount" placeholder="0.00" type="number" step="0.01" value="{{ old('amount') }}"
                                                    class="form-input block w-full pl-10 pr-12 sm:text-sm sm:leading-5 @error('amount') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" 
                                                />
                                                @error('amount')
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
                                            @error('amount')
                                                <p class="text-red-500 text-xs italic mt-4">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </dd>
                                    </div>
                                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-4 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Attachment
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900">
                                            <div id="attachment_div" class="mt-2 sm:mt-0 sm:col-span-2">
                                                <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 {{ ($errors->get('attachment') ? 'border-red-300 ' : 'border-gray-300 ') }} border-dashed rounded-md cursor-pointer">
                                                    <div class="text-center">
                                                        <input type="file" name="attachment" id="attachment" class="hidden" />
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            <span type="button" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition duration-150 ease-in-out">
                                                                Upload a file
                                                            </span>
                                                        </p>
                                                        <p class="mt-1 text-xs text-gray-500">
                                                            PNG, JPG & PDF up to 10MB
                                                        </p>
                                                    </div>
                                                </div>
                                                @error('attachment')
                                                    <p class="text-red-500 text-xs italic mt-4">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div id="attachment_uploaded_div"
                                                class="mt-2 flex flex-col sm:flex-row justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hidden">
                                                <div class="flex justify-center ">
                                                    <span class="inline-flex rounded-md shadow-sm">
                                                        <a id="attachment_buttonDel" type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150"
                                                            onclick="attachmentDelFile()">
                                                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd">
                                                            </svg>
                                                            Delete Attachment
                                                        </a>
                                                    </span>
                                                </div>
                                                <span id="Attachment_uploaded" class="flex items-center justify-center leading-4 text-gray-500 mt-2 text-center">Nothing uploaded yet.</span>
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
    $("#attachment_div").click(function (event) {
        if (!$(event.target).is('#attachment')) {
            $(this).find("#attachment").trigger('click');
        }
    });

    $("input[id='attachment']").on('change', function () {
        attachmentreadURL(this);
        attachmentcheckFiles();
    });

    var attachmentcheckFiles = function () {
        if (document.getElementById("attachment").files.length > 0) {
            $('#attachment_uploaded_div').css('display', 'block');
            $('#attachment_div').css('display', 'none');
        } else {
            $('#attachment_uploaded_div').css('display', 'none');
            $('#attachment_div').css('display', 'block');
        }
    }

    var attachmentreadURL = function (input) {
        var fullPath = document.getElementById('attachment').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            document.getElementById("Attachment_uploaded").textContent = filename;
        }
    }

    function attachmentDelFile() {
        $("#attachment").val('');
        $('#attachment_uploaded_div').css('display', 'none');
        $('#attachment_div').css('display', 'block');
    }

    function deleteKP(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: "{{ url('cbrm-deleteKP')}}" + '/' + id,
            data: {
                '_token': CSRF_TOKEN,
                '_method': 'DELETE'
            },
            success: function () {
                window.location = "{{ url('cbrm')}}";
            }
        });
    }

</script>
@endpush
