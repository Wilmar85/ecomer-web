@php
    $metaTitle = 'Contacto | InterEleticosf&A';
    $metaDescription = '¿Tienes preguntas o necesitas ayuda? Contáctanos en InterEleticosf&A y recibe atención personalizada para tus compras online.';
    $metaKeywords = 'contacto, atención al cliente, ayuda, soporte, ecommerce, InterEleticosfA';
@endphp

<x-app-layout>
    {{-- =============================================== --}}
    {{-- ============ INICIO DEL NUEVO BANNER ============ --}}
    {{-- =============================================== --}}
    <div class="contact-banner">
        {{-- Capa semitransparente para mejorar legibilidad del texto --}}
        <div class="contact-banner__overlay"></div>
        
    </div>
    {{-- =============================================== --}}
    {{-- ============== FIN DEL NUEVO BANNER ============= --}}
    {{-- =============================================== --}}

    <div class="contact-page">
        <div class="contact-card">
            {{-- Columna Izquierda: Información de Contacto --}}
            <div class="contact-card__info-panel">
                <div class="contact-card__info-overlay"></div>
                <div class="contact-card__info-content">
                    <h1 class="contact-card__title">Ponte en Contacto</h1>
                    <p class="contact-card__subtitle">
                        Rellena el formulario o contáctanos a través de nuestros canales directos.
                    </p>
                    <div class="contact-card__details">
                        <div class="contact-card__detail-item">
                            <svg class="contact-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            <a href="mailto:info@ecomer.com">info@ecomer.com</a>
                        </div>
                        <div class="contact-card__detail-item">
                           <svg class="contact-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.211-.998-.58-1.35l-3.952-3.952a2.25 2.25 0 00-3.182 0l-1.172 1.172a2.25 2.25 0 01-3.182 0l-6.182-6.182a2.25 2.25 0 010-3.182L6.75 4.25a2.25 2.25 0 000-3.182l-3.952-3.952A2.25 2.25 0 00.58 2.628v1.372c0 .516.211.998.58 1.35L2.25 6.75z" /></svg>
                            <a href="tel:+1234567890">+1 234 567 890</a>
                        </div>
                        <div class="contact-card__detail-item">
                             <svg class="contact-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            <span>123 Calle Principal, Ciudad</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Columna Derecha: Formulario --}}
            <div class="contact-card__form-panel">
                <h2 class="form-panel__title">Envíanos un mensaje</h2>
                @if(session('success'))
                    <div class="alert alert--success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert--error">{{ session('error') }}</div>
                @endif
                <form action="{{ route('contact') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-group__label">Nombre Completo</label>
                        <input type="text" name="name" id="name" required class="form-group__input">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-group__label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" required class="form-group__input">
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-group__label">Mensaje</label>
                        <textarea name="message" id="message" rows="5" required class="form-group__textarea"></textarea>
                    </div>

                    {{-- Área de acción con la línea decorativa sobre el botón --}}
                    <div class="contact-form__action-area">
                        <button type="submit" class="contact-form__button">
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>