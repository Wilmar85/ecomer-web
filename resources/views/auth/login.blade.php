<x-guest-layout>
    <div class="login">
        <div class="login__container">
            <div class="auth-login__center">
                <span class="auth-login__icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" class="auth-login__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <h2 class="login__title">Iniciar sesión</h2>
            </div>
            <x-auth-session-status class="login__status" :status="session('status')" />
            <form class="login__form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login__input-group">
                    <label for="email">Correo electrónico</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="auth-login__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm8 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z"/></svg>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="username" required autofocus class="login__input" value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="login__input-error" />
                </div>
                <div class="login__input-group">
                    <label for="password">Contraseña</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="auth-login__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0v2m0 4h.01"/></svg>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="login__input">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="login__input-error" />
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;">
                        <input id="remember_me" name="remember" type="checkbox" style="margin-right:0.5rem;">
                        <label for="remember_me">Recuérdame</label>
                    </div>
                    @if (Route::has('password.request'))
                        <div>
                            <a href="{{ route('password.request') }}" class="login__link">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif
                </div>
                <div>
                    <button type="submit" class="login__button">
                        <span style="position:absolute;left:0;inset-y:0;display:flex;align-items:center;padding-left:0.75rem;">
                            <svg class="auth-login__input-icon auth-login__input-icon--active" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

