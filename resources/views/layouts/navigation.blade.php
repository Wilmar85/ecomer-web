<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-logo"><img src="{{ asset('images/logo.png') }}" loading="lazy" alt="INTERELECTRICOS" srcset=""></a>
        <!-- Navigation Links -->
        <ul class="navbar-menu" id="navbar-menu">
        
            <li><img class="menu__login--logo" src="{{ asset('images/home.svg') }}"><x-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-nav-link></li>
            <li> <img class="menu__login--logo" src="{{ asset('images/shop.svg') }}"><x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">{{ __('Shop') }}</x-nav-link></li>
            <li> <img class="menu__login--logo" src="{{ asset('images/about.svg') }}"> <x-nav-link :href="route('about')" :active="request()->routeIs('about')">{{ __('About') }}</x-nav-link></li>
            <li> <img class="menu__login--logo" src="{{ asset('images/contact.svg') }}" alt="">  <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Contact') }}</x-nav-link></li>
        <!-- Cart and Settings Dropdown -->
                @auth
                @if (Auth::user()->isAdmin())
                   <li> <x-nav-link :href="url('/admin/dashboard')" :active="request()->is('admin*')">{{ __('Dashboard') }}</x-nav-link></li>
                @endif

                <!-- Cart Icon with Counter Component -->
               <li> <x-cart-counter :count="Auth::user()->cart ? Auth::user()->cart->items->count() : 0" /> </li>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-nav-link>
                            <div>{{ Auth::user()->name }}</div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path
                                    d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                                </path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                            </svg>
                        </x-nav-link>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            @endauth

        </ul>

            @guest
                <a href="{{ route('login') }}" class="menu__login-link">
                    <svg class="menu__login--logo" aria-hidden="true" focusable="false" role="presentation"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 26" fill="none">
                        <path
                            d="M11.3336 14.4447C14.7538 14.4447 17.5264 11.6417 17.5264 8.18392C17.5264 4.72616 14.7538 1.9231 11.3336 1.9231C7.91347 1.9231 5.14087 4.72616 5.14087 8.18392C5.14087 11.6417 7.91347 14.4447 11.3336 14.4447Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M20.9678 24.0769C19.5098 20.0278 15.7026 17.3329 11.4404 17.3329C7.17822 17.3329 3.37107 20.0278 1.91309 24.0769"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span> Ingresar </span>
                </a>
            @endguest


    </div>
        <!-- Hamburger -->
        <button class="navbar-toggle" id="navbar-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
</nav>
