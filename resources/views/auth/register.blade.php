<x-guest-layout>
    <div class="register">
        <div class="register__container">
            <div class="text-center">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white shadow-lg mb-4 animate-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <h2 class="register__title">Crear cuenta</h2>
            </div>
            <form class="register__form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="register__input-group">
                    <label for="name">Nombre</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <input id="name" name="name" type="text" autocomplete="name" required autofocus class="register__input" value="{{ old('name') }}">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="email">Correo electrónico</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm8 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z"/></svg>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="username" required class="register__input" value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="password">Contraseña</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0v2m0 4h.01"/></svg>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="register__input">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0v2m0 4h.01"/></svg>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="register__input">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div style="display:flex;align-items:center;margin-bottom:1rem;">
                    <input id="terms" name="terms" type="checkbox" value="1" style="margin-right:0.5rem;" {{ old('terms') ? 'checked' : '' }} required>
                    <label for="terms">
                        Acepto los <a href="{{ url('/terminos') }}" target="_blank" class="register__link">Términos y Condiciones</a>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('terms')" class="mb-2" />
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <a href="{{ route('login') }}" class="register__link">¿Ya tienes cuenta?</a>
                    <button type="submit" class="register__button">
                        <span style="position:absolute;left:0;inset-y:0;display:flex;align-items:center;padding-left:0.75rem;">
                            <svg class="h-5 w-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Crear cuenta
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

