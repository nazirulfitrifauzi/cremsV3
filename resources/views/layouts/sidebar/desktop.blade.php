<nav class="flex-1 px-2 py-4 bg-gray-800">
    <a href="{{ route('home') }}"
        class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('home')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">

        <svg class="mr-3 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
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
                class="{{ (auth()->user()->roles->attendances == 1 || auth()->user()->roles->leaves == 1 || auth()->user()->roles->claims == 1) ? 'block' : 'hidden' }} mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
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
                    class="{{ (auth()->user()->roles->attendances == 1) ? 'block' : 'hidden' }} mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('hr/attendance')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">
                    <span class="ml-10">Attendances</span>
                </a>
                <a href="#"
                    class="{{ (auth()->user()->roles->leaves == 1) ? 'block' : 'hidden' }} mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                    <span class="ml-10">Leaves</span>
                </a>
                <a href="#"
                    class="{{ (auth()->user()->roles->claims == 1) ? 'block' : 'hidden' }} mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                    <span class="ml-10">Claims</span>
                </a>
            </div>
        </div>
    </div>

    <a href="{{ route('roles.index') }}"
        class="{{ (auth()->user()->roles->roles == 1) ? 'block' : 'hidden' }} mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150 {{ (\Request::is('roles') || \Request::is('roles/*')) ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white' }}">
        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
        </svg>
        Roles
    </a>
</nav>