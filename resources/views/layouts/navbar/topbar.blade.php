<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
    <button @click.stop="sidebarOpen = true"
        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden"
        aria-label="Open sidebar">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7">
            </path>
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-between">
        <div class="flex-1 flex items-center ">
            <div class="w-full flex md:ml-0">
                <h3 class="hidden sm:block text-xl font-semibold text-gray-600">
                    CSC Request and Error Management System
                </h3>
                <h3 class="block sm:hidden text-xl font-semibold text-gray-600">
                    CREMS
                </h3>
            </div>
        </div>
        <div class="ml-4 flex items-center md:ml-6">
            <h3 class="hidden sm:block text-base font-semibold text-gray-600">
                {{ ucwords(strtolower(implode(' ', array_slice(explode(' ', auth()->user()->name), 0, 2)))) }}
            </h3>
            <!-- Profile dropdown -->
            <div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
                <div>
                    <button @click="open = !open"
                        class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
                        id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open"
                        aria-expanded="false">
                        @if(auth()->user()->avatar == NULL)
                            <span class="h-8 w-8 rounded-full overflow-hidden bg-gray-500">
                                <svg class="h-full w-full text-gray-300" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                        @else
                            <img src="{{ asset('storage/Avatar/' . auth()->user()->avatar) }}" class="h-8 w-8 rounded-full">
                        @endif
                    </button>
                </div>
                <div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state."
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
                    style="display: none;">
                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                        aria-labelledby="user-menu">
                        <a href="{{ route('profile', auth()->user()->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                            role="menuitem">Your Profile</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                            role="menuitem">Settings</a>
                        <a href="{{ route('logout') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                            role="menuitem"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                            out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>