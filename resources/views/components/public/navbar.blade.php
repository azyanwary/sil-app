<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-amber-700 font-outfit flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        BPK DIY
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-amber-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'border-amber-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        {{ __('Interactive Map') }}
                    </a>
                    <a href="{{ route('sites.index') }}" class="{{ request()->routeIs('sites.index') || request()->routeIs('sites.show') ? 'border-amber-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        {{ __('Site Catalog') }}
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                <x-public.language-switcher />
                
                @auth('applicant')
                    <a href="/applicant" class="text-sm font-medium text-gray-700 hover:text-amber-600">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="/applicant/login" class="text-sm font-medium text-gray-700 hover:text-amber-600">
                        {{ __('Login') }}
                    </a>
                    <a href="/applicant/register" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        {{ __('Register') }}
                    </a>
                @endauth
            </div>
            
            <div class="-mr-2 flex items-center sm:hidden" x-data="{ open: false }">
                <!-- Mobile menu button -->
                <button type="button" @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 hidden" :class="{'block': open, 'hidden': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-amber-50 border-amber-500 text-amber-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                {{ __('Home') }}
            </a>
            <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'bg-amber-50 border-amber-500 text-amber-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                {{ __('Interactive Map') }}
            </a>
            <a href="{{ route('sites.index') }}" class="{{ request()->routeIs('sites.index') || request()->routeIs('sites.show') ? 'bg-amber-50 border-amber-500 text-amber-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                {{ __('Site Catalog') }}
            </a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4 space-x-3">
                @auth('applicant')
                    <a href="/applicant" class="text-base font-medium text-gray-800 hover:text-amber-600">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="/applicant/login" class="text-base font-medium text-gray-800 hover:text-amber-600">
                        {{ __('Login') }}
                    </a>
                    <a href="/applicant/register" class="text-base font-medium text-amber-600 hover:text-amber-800">
                        {{ __('Register') }}
                    </a>
                @endauth
            </div>
            <div class="mt-3 px-4">
                <x-public.language-switcher />
            </div>
        </div>
    </div>
</nav>
