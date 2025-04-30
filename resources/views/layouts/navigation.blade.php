<nav class="menu__nav">
    <!-- Primary Navigation Menu -->
    <div class="menu__container">
        <div class="menu__row">
        
        
            <div class="menu__left">

                <!-- Logo -->
                <div class="menu__logo">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-white-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="menu__links-desktop">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                        {{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                    
                </div>
            </div>

            <!-- Settings Dropdown -->

            <!-- Cart and Settings Dropdown -->
            <div class="menu__actions-desktop">
                {{-- Usamos @auth para asegurarnos de que el usuario está logueado --}}
                @auth
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="url('/admin/dashboard')" :active="request()->is('admin*')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                    <!-- Cart Icon with Counter Component -->
                    <x-cart-counter :count="Auth::user()->cart ? Auth::user()->cart->items->count() : 0" />
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="menu__user-btn">
                                {{-- Ahora es seguro acceder a 'name' porque estamos dentro de @auth --}}
                                <div>{{ Auth::user()->name }}</div>

                                <div class="menu__user-arrow">
                                    <svg class="menu__user-arrow-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        {{-- Contenido del Dropdown --}}
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                {{-- Opcional: Mostrar enlaces de Login/Register si el usuario NO está logueado --}}
                @guest
                    <a href="{{ route('login') }}" class="menu__login-link">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="menu__register-link">Register</a>
                    @endif
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="menu__burger-container">
                <button class="menu__burger">
                    <svg class="menu__burger-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <!-- Responsive Navigation Menu -->
    <div class="menu__links-mobile">
        <div class="menu__links-mobile-list">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                {{ __('Shop') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            @auth
                <div class="menu__cart-mobile">
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="menu__cart-mobile-inner">
                        <span>{{ __('Carrito') }}</span>
                        <x-cart-counter :count="Auth::user()->cart ? Auth::user()->cart->items->count() : 0" class="menu__cart-mobile-count" />
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>

        {{-- Envolvemos las opciones de usuario responsivas con @auth --}}
        @auth
            <!-- Responsive Settings Options -->
            <div class="menu__user-mobile-section">
                <div class="menu__user-mobile-info">
                    {{-- Ahora es seguro acceder a name y email --}}
                    <div class="menu__user-mobile-name">{{ Auth::user()->name }}</div>
                    <div class="menu__user-mobile-email">{{ Auth::user()->email }}</div>
                </div>

                <div class="menu__user-mobile-links">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
        {{-- Fin del bloque @auth --}}

        {{-- Opcional: Puedes añadir aquí un @guest para mostrar enlaces de Login/Register en el menú responsivo si lo deseas --}}
        @guest
            <div class="menu__user-mobile-section">
                <div class="menu__user-mobile-links">
                     <x-responsive-nav-link :href="route('login')">
                         {{ __('Log in') }}
                     </x-responsive-nav-link>
                     @if (Route::has('register'))
                         <x-responsive-nav-link :href="route('register')">
                             {{ __('Register') }}
                         </x-responsive-nav-link>
                     @endif
                </div>
            </div>
        @endguest

    </div>
</nav>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/573203030595" target="_blank" id="whatsapp-float" title="¿Necesitas ayuda? Contáctanos por WhatsApp" style="position:fixed;bottom:28px;right:28px;z-index:9999;display:flex;align-items:center;justify-content:center;width:60px;height:60px;background:#25d366;border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,0.15);transition:box-shadow .2s, right 0.3s cubic-bezier(.4,0,.2,1);">
    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="34" height="34">
        <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.36 5.08L2 22l5.17-1.35A9.96 9.96 0 0 0 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.61 0-3.16-.39-4.51-1.14l-.32-.17-3.07.8.82-3-.21-.33A7.93 7.93 0 0 1 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8zm4.13-5.47c-.2-.1-1.18-.58-1.36-.65-.18-.07-.31-.1-.44.1-.13.2-.5.65-.61.78-.11.13-.23.15-.43.05-.2-.1-.84-.31-1.6-.98-.59-.53-.99-1.18-1.11-1.38-.11-.2-.01-.3.08-.4.08-.08.2-.23.3-.35.1-.12.13-.2.2-.33.07-.13.03-.25-.01-.35-.04-.1-.44-1.06-.6-1.46-.16-.39-.32-.34-.44-.35-.11-.01-.25-.01-.39-.01-.13 0-.35.05-.53.25-.18.2-.7.68-.7 1.65s.72 1.92.82 2.05c.1.13 1.41 2.14 3.42 2.92.48.17.85.27 1.14.34.48.1.92.09 1.27.06.39-.04 1.18-.48 1.35-.94.17-.46.17-.85.12-.94-.05-.09-.17-.13-.36-.23z"/>
    </svg>
</a>
<style>
#whatsapp-float:hover {
    box-shadow:0 6px 24px rgba(37,211,102,0.18),0 1.5px 4px rgba(0,0,0,0.10);
    background:#1ebe57;
}
@media (max-width: 640px) {
    #whatsapp-float { width:48px; height:48px; right:16px; bottom:16px; }
    #whatsapp-float svg { width:28px; height:28px; }
}
#whatsapp-float.move-left {
    right: 104px !important;
}
@media (max-width: 640px) {
    #whatsapp-float.move-left {
        right: 80px !important;
    }
}
</style>
<script>



    const btn = document.getElementById('whatsapp-float');


        btn.classList.add('move-left');
      } else {
        btn.classList.remove('move-left');
      }
    }
  });
});
</script>
