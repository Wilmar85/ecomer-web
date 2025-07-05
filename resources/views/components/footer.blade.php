    {{-- <div class="footer__container">
        <div class="footer__grid">
            <!-- Información de la Empresa -->
            <div class="footer__section">
                <h3 class="footer__title">Acerca de Nosotros</h3>
                <p class="footer__desc">
                    Somos una empresa dedicada a ofrecer soluciones integrales en iluminación y productos eléctricos, comprometidos con la calidad, la innovación y el servicio al cliente. Nuestro equipo está orientado a brindar una experiencia de compra confiable y satisfactoria, guiados por los valores de ética, responsabilidad y mejora continua.
                </p>
                <ul class="footer__list">
                    <li><a href="#" class="footer__link">Términos y Condiciones</a></li>
                    <li><a href="#" class="footer__link">Políticas de Privacidad</a></li>
                    <li><a href="#" class="footer__link">Información de Envío: Domicilio a la ciudad o puesto en transportadora</a></li>
                    <li><a href="#" class="footer__link">Métodos de Pago: Transferencia, PSE, Tarjeta</a></li>
                </ul>
            </div>

            <!-- Servicio al Cliente -->
            <div class="footer__section">
                <h3 class="footer__title">Servicio al Cliente</h3>
                <ul class="footer__list">
                    <li><a href="#" class="footer__link">Preguntas Frecuentes (FAQ)</a></li>
                    <li><a href="#" class="footer__link">Contacto: WhatsApp ventas 320 303 0595, 320 303 0596</a></li>
                    <li><a href="#" class="footer__link">Devoluciones y Garantías</a>
                        <div class="footer__text-xs">
                            "Las devoluciones y garantías se rigen por la normatividad vigente y las condiciones establecidas en la leyenda de la factura. Para más información, consulte el archivo adjunto o comuníquese con nuestro equipo de atención."
                        </div>
                    </li>
                </ul>
            </div>

            

            <!-- Métodos de Pago -->
            <div class="footer__section">
                <h3 class="footer__title">Métodos de Pago</h3>
                <div class="footer__flex">
                    <img src="{{ asset('images/payments/visa.png') }}" alt="Visa" class="footer__h-8">
                    <img src="{{ asset('images/payments/mastercard.png') }}" alt="Mastercard" class="footer__h-8">
                    <img src="{{ asset('images/payments/amex.png') }}" alt="Amex" class="footer__h-8">
                    <img src="{{ asset('images/payments/pse.png') }}" alt="PSE" class="footer__h-8">
                    <img src="{{ asset('images/payments/bank.png') }}" alt="Transferencia" class="footer__h-8">
                </div>
            </div>

            <!-- Enlaces -->
            <div class="footer__section">
                <h3 class="footer__title">Enlaces</h3>
                <ul class="footer__list">
                    <li><a href="{{ route('about') }}" class="footer__link">Sobre nosotros</a></li>
                    <li><a href="{{ route('contact') }}" class="footer__link">Contacto</a></li>
                </ul>
            </div>

            <!-- Categorías -->
            <div class="footer__section">
                <h3 class="footer__title">Categorías</h3>
                <ul class="footer__list">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="footer__link">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contacto -->
            <div class="footer__section">
                <h3 class="footer__title">Contacto</h3>
                <ul class="footer__list">
                    <li>Email: {{ config('contact.email', 'info@ecomer.com') }}</li>
                    <li>Teléfono: {{ config('contact.phone', '(123) 456-7890') }}</li>
                    <li>Dirección: {{ config('contact.address', 'Calle Principal #123') }}</li>
                </ul>
            </div>
        </div>

        <!-- Redes Sociales: Síguenos -->
        <div class="footer__social-section">
            <h3 class="footer__title">Síguenos</h3>
            <div class="footer__social-links">
                <a href="#" class="footer__link" title="Facebook">
                    <svg class="footer__icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" class="footer__link" title="Instagram">
                    <svg class="footer__icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                </a>
                <a href="#" class="footer__link" title="Twitter">
                    <svg class="footer__icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                </a>
            </div>
            <div class="footer__copyright">
                <p>&copy; {{ date('Y') }} Ecomer. Todos los derechos reservados.</p>
            </div>
        </div>
    </div> --}}

  <footer class="site-footer">
        <div class="footer-container">
            <!-- Columna 1: Acerca de la empresa -->
            <div class="footer-column footer-about">
                <h3 class="footer-logo">
                    <!-- Logo de la empresa -->
                     <img src="{{ asset('images/logo.png') }}" alt="Logo de la Empresa" class="company-logo">
                </h3>
                <p>
                    Duis ultricies libero sit amet aliquam fermentum. Nunc tincidunt mollis dui in tempor. Maecenas ut leo vitae purus condimentum dignissim.
                </p>
                <div class="app-buttons">

                    <a href="#" class="footer__link" title="Facebook">
                    <svg class="footer__icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="footer__link" title="Instagram">
                    <svg class="footer__icon" width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                </a>
                  
                   
                </div>
            </div>

            <!-- Columna 2: Información (Acordeón) -->
            <div class="footer-column footer-info-accordion accordion">
                <div class="accordion-header">
                    <h4>Information</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </div>
                <div class="accordion-content">
                    <ul>
                        <li><a href="#">Request Service</a></li>
                        <li><a href="#">Commercial Plumbing</a></li>
                        <li><a href="#">Our Work</a></li>
                        <li><a href="#">What We Do</a></li>
                        <li><a href="#">Our Process</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Columna 3: Soporte (Acordeón) -->
            <div class="footer-column footer-support-accordion accordion">
                 <div class="accordion-header">
                    <h4>Support</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </div>
                <div class="accordion-content">
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms Of Use</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Columna 4: Contacto y Newsletter -->
            <div class="footer-column footer-contact">
                <h4>Quick Contact</h4>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i><span>No: 58 A, East Madison Street, Baltimore, MD, USA 4508</span></li>
                    <li><i class="fas fa-phone-alt"></i><span>+000 123 456 789</span></li>
                    <li><i class="fas fa-envelope"></i><span>info@example.com</span></li>
                </ul>
                <div class="social-links">
                    Follow Us - <a href="#">YT</a> / <a href="#">FB</a> / <a href="#">TW</a>
                </div>

                {{-- <div class="newsletter-section">
                    <h4>Newsletter</h4>
                     <p>Sonc tincidunt mollis dui in tempor. Duis ultricies libero sit amet.</p>
                    <form action="#" method="POST" class="newsletter-form" onsubmit="event.preventDefault(); document.getElementById('newsletter-msg').style.display = 'block';">
                        <input type="email" name="email" placeholder="Enter Your email id" required>
                        <button type="submit" aria-label="Subscribe">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                    <small class="spam-notice">We don't spam. Unsubscription any time.</small>
                    <div id="newsletter-msg" style="display:none; color: var(--primary); margin-top: 10px;">¡Gracias por suscribirte!</div>
                </div> --}}
            </div>
        </div>

        <!-- Barra inferior del footer -->
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <div class="copyright">
                    © Wedesign.Tech. All Rights Reserved.
                </div>
                <div class="policy-links">
                    <a href="#">Privacy Policy</a> - <a href="#">Terms & Condition</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript para controlar el acordeón
        document.addEventListener('DOMContentLoaded', function () {
            const accordions = document.querySelectorAll('.accordion');
            accordions.forEach(accordion => {
                const header = accordion.querySelector('.accordion-header');
                header.addEventListener('click', () => {
                    // Solo alterna si no estamos en la vista de escritorio
                    if (window.innerWidth < 1024) {
                        accordion.classList.toggle('active');
                    }
                });
            });
        });
    </script>