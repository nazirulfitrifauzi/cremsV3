<div class="mt-5 flex-1 h-0 overflow-y-auto">
    <nav class="px-2">
        <a href="{{ route('home') }}"
            class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('home')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">
            <svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
                stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                </path>
            </svg>
            Dashboard
        </a>

        <div x-data="{}" x-cloak>
            <div 
                @if(\Request::is('hr/*'))
                    x-data="{ open: true }" 
                @else
                    x-data="{ open: false }" 
                @endif
            >
                <a href="#" @click.prevent="open = !open"
                    class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                    <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
                        stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Human Resources
                    <svg x-show="!open" 
                        class="ml-auto mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" 
                        fill="currentColor" viewBox="0 0 20 20"> <!-- chevron right -->
                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <svg x-show="open" 
                        class="ml-auto mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </a>

                <div x-show="open">
                    <a href="{{ route('attendances.index') }}"
                        class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('hr/attendance')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">
                        <span class="ml-10">Attendances</span>
                    </a>
                    <a href="{{ route('leave.index') }}"
                        class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('hr/leave*')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">
                        <span class="ml-10">Leaves</span>
                    </a>
                    <a href="#"
                        class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <span class="ml-10">Claims</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="flex-shrink-0 flex bg-gray-700 p-4">
    <div class="{{ (auth()->user()->roles->roles == 1) ? 'block' : 'hidden' }} my-2 flex-1">
        <h3 class="group flex items-center px-3 text-xs leading-4 font-semibold text-gray-400 uppercase tracking-wider" id="projects-headline">
            <svg class="mr-3 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
                fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            SYSTEM SETTING
        </h3>
        <div class="mt-1" role="group" aria-labelledby="projects-headline">
            <a href="{{ route('roles.index') }}"
                class="mt-1 group flex items-center px-3 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('roles') || \Request::is('roles/*')) ? 'text-white bg-gray-900' : 'text-gray-600 hover:text-white hover:bg-gray-800 focus:text-white' }}">
                Roles
            </a>
            <a href="{{ route('request.index') }}"
                class="mt-1 group flex items-center px-3 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('new-request') || \Request::is('new-request/*')) ? 'text-white bg-gray-900' : 'text-gray-600 hover:text-white hover:bg-gray-800 focus:text-white' }}">
                New Request
                <span class="ml-auto inline-flex items-center px-2 py-1 rounded-md text-sm font-medium leading-5 bg-red-100 text-red-800">
                    {{ $newRequest }}
                </span>
            </a>
        </div>
    </div>
</div>