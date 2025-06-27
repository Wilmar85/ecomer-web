<x-guest-layout>
  <!-- Botón para Regresar a la Página de Inicio -->
<a href="{{ route('home') }}" class="btn-regresar2">
    <i class="fas fa-arrow-left"></i> Regresar
</a>

<div class="container" id="container">
    <!-- Contenedor de Login -->
    <div class="form-container sign-in-container">
        <x-auth-session-status class="login__status" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{ asset('images/logo2.png') }}" alt="Logo de la Empresa" class="company-logo">
            <h1>Iniciar Sesión</h1>

            <!-- Campo de Email: Añadido name="email" -->
            <input id="email" name="email" type="email" placeholder="Correo Electrónico" required value="{{ old('email') }}" autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="login__input-error" />

            <!-- Campo de Contraseña: Añadido name="password" -->
            <input id="password" name="password" type="password" placeholder="Contraseña" required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="login__input-error" />

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif

            <button type="submit" class="login-button">Inicia Sesión</button>
            <a href="#" class="mobile-switch" id="mobileSignUpLink">¿No tienes cuenta? Regístrate</a>
        </form>
    </div>

    <!-- Contenedor de Registro -->
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <img src="{{ asset('images/logo2.png') }}" alt="Logo de la Empresa" class="company-logo">
            <h1>Crear Cuenta</h1>

            <!-- Campo de Nombre: Añadido name="name" -->
            <input id="name" name="name" type="text" placeholder="Nombre" required value="{{ old('name') }}" autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="login__input-error" />

            <!-- Campo de Email: Añadido name="email" y autocomplete="email" -->
            <input id="email-register" name="email" type="email" placeholder="Correo Electrónico" required value="{{ old('email') }}" autocomplete="email"/>
            <x-input-error :messages="$errors->get('email')" class="login__input-error" />

            <!-- Campo de Contraseña: Añadido name="password" y autocomplete="new-password" -->
            <input id="password-register" name="password" type="password" placeholder="Contraseña" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="login__input-error" />

            <!-- Campo de Confirmar Contraseña: Añadido name="password_confirmation" -->
            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar Contraseña" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="login__input-error" />

            <div class="terms-container">
                <!-- Campo de Términos: Añadido name="terms" -->
                <input type="checkbox" id="terms" name="terms" required value="1" {{ old('terms') ? 'checked' : '' }}>
                <label for="terms">Acepto los <a href="{{ url('/terminos') }}" target="_blank">Términos y Condiciones</a></label>
                <x-input-error :messages="$errors->get('terms')" class="login__input-error" />
            </div>
            
            <button type="submit" class="login-button">Registrarse</button>
            <a href="#" class="mobile-switch" id="mobileSignInLink">¿Ya tienes cuenta? Inicia Sesión</a>
        </form>
    </div>

    <!-- Panel deslizable (solo para Desktop) -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 class="overlay-panel__title">¡Bienvenido de Vuelta!</h1>
                <p class="overlay-panel__text">Para mantenerte conectado, por favor inicia sesión</p>
                <button class="overlay-panel__button" id="signIn">Inicia Sesión</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1 class="overlay-panel__title">¡Hola, Amigo!</h1>
                <p class="overlay-panel__text">Ingresa tus datos y comienza tu aventura</p>
                <button class="overlay-panel__button" id="signUp">Registrarse</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('container');

        // Elementos que activan el panel de registro
        const signUpTriggers = [document.getElementById('signUp'), document.getElementById('mobileSignUpLink')];

        // Elementos que activan el panel de inicio de sesión
        const signInTriggers = [document.getElementById('signIn'), document.getElementById('mobileSignInLink')];

        // Función para añadir la clase que muestra el panel de registro
        const showSignUpPanel = (event) => {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace '#'
            container.classList.add("right-panel-active");
        };

        // Función para quitar la clase y mostrar el panel de inicio de sesión
        const showSignInPanel = (event) => {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace '#'
            container.classList.remove("right-panel-active");
        };

        // Asignar los eventos a cada elemento correspondiente
        signUpTriggers.forEach(trigger => {
            if (trigger) {
                trigger.addEventListener('click', showSignUpPanel);
            }
        });

        signInTriggers.forEach(trigger => {
            if (trigger) {
                trigger.addEventListener('click', showSignInPanel);
            }
        });
    });
</script>




{{-- <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form class="register__form" method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Crear Cuenta</h1>
                <div class="social-container">
                    <a href="#" class="social-container__link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-container__link"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social-container__link"><i class="fab fa-linkedin-in"></i></a>
                </div>
                 <span class="register__form-alternative-text">or use your email for registration</span>
                <div class="infield">
                    <input id="name" name="name" type="text" autocomplete="name" required autofocus  value="{{ old('name') }}" placeholder="Nombre">
                <x-input-error :messages="$errors->get('name')" />
                    <label class = "infield__barra"></label>
                </div>
                <div class="infield">
                    <input id="email" name="email" type="email" autocomplete="username" required  value="{{ old('email') }}" placeholder="Correo Electronico" />
                    <x-input-error :messages="$errors->get('email')" />
                    <label class = "infield__barra"></label>
                </div>
                <div class="infield">
                     <input id="password" name="password" type="password" autocomplete="current-password" required  placeholder="Contraseña" />
                     <x-input-error :messages="$errors->get('password')" />
                    <label class = "infield__barra"></label>
                </div>
                 <div class="infield">
                     <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required  placeholder="Confirmar contraseña">
                    <x-input-error :messages="$errors->get('password_confirmation')"  />
                    <label class = "infield__barra"></label>
                </div>
                 <div class="term" >
                    <input id="terms" name="terms" type="checkbox" value="1"  {{ old('terms') ? 'checked' : '' }} required>
                   <p class="register__terms-text"> Acepto los <a href="{{ url('/terminos') }}" target="_blank" class="register__link">Términos y Condiciones</a>
                    </p>
                </div>
                <x-input-error :messages="$errors->get('terms')" />

                <button type="submit" class="overlay-panel__button">Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
         <x-auth-session-status class="login__status" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Iniciar Sesión</h1>
                <div class="social-container">
                    <a href="#" class="social-container__link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-container__link"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social-container__link"><i class="fab fa-linkedin-in"></i></a>
                </div>
                 <span class="login__form-alternative-text">or use your account</span>
                <div class="infield">
                    <input id="email" name="email" type="email" autocomplete="username" required autofocus  value="{{ old('email') }}" placeholder="Correo Electronico" />
                <x-input-error :messages="$errors->get('email')" />
                    <label class = "infield__barra"></label>
                </div>
                <div class="infield">
                     <input id="password" name="password" type="password" autocomplete="current-password" required class="login__input" placeholder="Contraseña" />
                <x-input-error :messages="$errors->get('password')" />
                    <label class = "infield__barra"></label>
                </div>
                 @if (Route::has('password.request'))
                        <div>
                            <a href="{{ route('password.request') }}" class="login__forgot-link">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif
                <button type="submit" class="overlay-panel__button">Inicia Sesión</button>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="overlay-panel__title">Bienvenido</h1>
                    <p class="overlay-panel__text">Mantenerte conectado con tu cuenta personal</p>
                    <button type="submit" class="overlay-panel__button">Inicia Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="overlay-panel__title">Hola, Amigo!</h1>
                    <p class="overlay-panel__text">Ingresa tu información personal para continuar</p>
                    <button class="overlay-panel__button">Registrarse</button>
                </div>
            </div>
            <button id="overlayBtn" class="overlay-panel__button"></button>
        </div>
    </div>

    <!-- js code -->
    <script>
        const container = document.getElementById('container');
        const overlayBtn = document.getElementById('overlayBtn');
        const overlayCon = document.getElementById('overlayCon');

        overlayBtn.addEventListener('click', () => {
            container.classList.toggle('right-panel-active');

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame(() => {
                overlayBtn.classList.add('btnScaled');
            });
        });

    </script> --}}



    {{-- <div class="login">
        <div class="login__container">
            <div class="auth-login__center">
                <span class="auth-login__icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" class="auth-login__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <h2 class="login__title">Iniciar sesión 2</h2>
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
                        <input id="email" name="email" type="email" autocomplete="username" required autofocus  value="{{ old('email') }}" class="login__input">
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
    </div> --}}

{{-- register --}}

         {{-- <div class="register__container">
            <div class="auth-register__center">
                <span class="auth-register__icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" class="auth-register__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <svg class="auth-register__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <input id="name" name="name" type="text" autocomplete="name" required autofocus class="register__input" value="{{ old('name') }}">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="email">Correo electrónico</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="auth-register__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm8 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z"/></svg>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="username" required class="register__input" value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="password">Contraseña</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="auth-register__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0v2m0 4h.01"/></svg>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="register__input">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="register__input-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:0;top:0;bottom:0;display:flex;align-items:center;padding-left:0.75rem;pointer-events:none;">
                            <svg class="auth-register__input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0v2m0 4h.01"/></svg>
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
                            <svg class="auth-register__input-icon auth-register__input-icon--active" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Crear cuenta
                    </button>
                </div>
            </form>
        </div> --}}


</x-guest-layout>
