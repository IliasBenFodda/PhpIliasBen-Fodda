<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center min-w-0 flex-1">
                <div class="shrink-0 flex items-center pe-6 border-e border-gray-200 me-6">
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-800 whitespace-nowrap">
                        {{ config('app.name', 'Nieuws Project') }}
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:gap-6">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth

                    <x-nav-link :href="route('nieuws.index')" :active="request()->routeIs('nieuws.*')">
                        Nieuws
                    </x-nav-link>

                    <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                        FAQ
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        Contact
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.*')">
                            Forum
                        </x-nav-link>

                        @if(auth()->user()->isAdmin())
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md
                                        {{ request()->routeIs('admin.*') ? 'text-gray-900 border-b-2 border-indigo-400' : 'text-gray-500' }}
                                        bg-white hover:text-gray-700 focus:outline-none transition">
                                        <span>Admin</span>
                                        <svg class="ms-1 fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.nieuws.index')"
                                                     class="{{ request()->routeIs('admin.nieuws.*') ? 'bg-gray-100' : '' }}">
                                        📰 Nieuws beheer
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.faq.create')"
                                                     class="{{ request()->routeIs('admin.faq.*') && !request()->routeIs('admin.faq.suggestions.*') ? 'bg-gray-100' : '' }}">
                                        ❓ FAQ beheer
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.faq.suggestions.index')"
                                                     class="{{ request()->routeIs('admin.faq.suggestions.*') ? 'bg-gray-100' : '' }}">
                                        💡 FAQ-voorstellen
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.users.index')"
                                                     class="{{ request()->routeIs('admin.users.*') ? 'bg-gray-100' : '' }}">
                                        👥 Gebruikers
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.contact.index')"
                                                     class="{{ request()->routeIs('admin.contact.*') ? 'bg-gray-100' : '' }}">
                                        📬 Contactberichten
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    @endauth
                </div>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6 shrink-0">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.show', Auth::user())">Publiek profiel
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6 shrink-0 gap-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Inloggen</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Registreren</a>
                </div>
            @endguest

            <div class="-me-2 flex items-center sm:hidden shrink-0">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobiel menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('nieuws.index')" :active="request()->routeIs('nieuws.*')">Nieuws
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">FAQ
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.*')">Forum
                </x-responsive-nav-link>
                @if(auth()->user()->isAdmin())
                    <div class="px-4 pt-2 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin</div>
                    <x-responsive-nav-link :href="route('admin.nieuws.index')"
                                           :active="request()->routeIs('admin.nieuws.*')">📰 Nieuws beheer
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.faq.create')"
                                           :active="request()->routeIs('admin.faq.*') && !request()->routeIs('admin.faq.suggestions.*')">
                        ❓ FAQ beheer
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.faq.suggestions.index')"
                                           :active="request()->routeIs('admin.faq.suggestions.*')">💡 FAQ-voorstellen
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')"
                                           :active="request()->routeIs('admin.users.*')">👥 Gebruikers
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.contact.index')"
                                           :active="request()->routeIs('admin.contact.*')">📬 Contactberichten
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.show', Auth::user())">Publiek profiel
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-600">Inloggen</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-600">Registreren</a>
            </div>
        @endguest
    </div>
</nav>
