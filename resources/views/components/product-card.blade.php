{{-- @props(['product'])


<div class="product-card">
    @if ($product->images->isNotEmpty())
        @php
            $imgUrl = method_exists($product->images->first(), 'getImageUrlAttribute') ? $product->images->first()->image_url : (property_exists($product->images->first(), 'image_path') ? asset('storage/' . $product->images->first()->image_path) : asset('storage/' . $product->images->first()->path));
        @endphp
        <a href="{{ route('products.show', $product) }}" class="product-card__img-link">
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-card__img" loading="lazy">
        </a>

        <button class="product-card__quickview-btn" onclick="window.location='/ruta-al-detalle-del-producto'">
            <svg xmlns="http://www.w3.org/2000/svg" class="product-card__quickview-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z" />
            </svg>
        </button>
        <div class="product-card__quickview-modal" style="display:none;">
            <div class="product-card__quickview-content">
                <h2 class="product-card__quickview-title">{{ $product->name }}</h2>
                <p class="product-card__quickview-desc">{{ $product->description }}</p>
                <button class="product-card__quickview-close">Cerrar</button>
            </div>
        </div>
    @endif
    <div class="product-card__body">
        <div>
            <a href="{{ route('products.show', $product) }}" class="product-card__name">{{ $product->name }}</a>
            <p class="product-card__desc">{{ Str::limit($product->description, 100) }}</p>
        </div>
        <div>
            <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
        </div>
        <div class="product-card__btns">
            <a href="{{ route('products.show', $product) }}" class="product-card__action" title="Ver detalles">
                <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z" />
                </svg>
            </a>
            @auth
                <form action="{{ route('cart.add') }}" method="POST" class="product-card__action">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="product-card__action product-card__action--add">
                        <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.28 4.56a2 2 0 001.74 2.94h10.28a2 2 0 001.74-2.94L21 13H7z" />
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="product-card__action product-card__action--add">
                    <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 007.48 19h8.94a2 2 0 001.83-1.23L21 13M7 13V6a1 1 0 011-1h9a1 1 0 011 1v7" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</div> --}}


<!-- Tarjeta de Producto -->
     {{-- <div class="product-card">
        <!-- Contenedor de la Imagen -->
        <div class="product-card__img-container">
            <a href="#" class="product-card__img-link">
                <img src="https://placehold.co/400x400/f3f4f6/333333?text=Producto&font=sans-serif" alt="Serrucho de Mano" class="product-card__img" loading="lazy">
            </a>
    
            <div class="product-card__sale-badge">SALE</div>
    
            <button class="product-card__quickview-btn" aria-label="Vista rápida">
                <svg xmlns="http://www.w3.org/2000/svg" class="product-card__quickview-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <!-- Modal de Vista Rápida -->
        <div class="product-card__quickview-modal" style="display:none;">
            <div class="product-card__quickview-content">
                <h2 class="product-card__quickview-title">Serrucho de Mano</h2>
                <p class="product-card__quickview-desc">Este serrucho de mano de alta calidad es perfecto para cortes precisos en madera. La hoja de acero templado garantiza durabilidad y un rendimiento de corte superior. El mango ergonómico proporciona un agarre cómodo y seguro para un control máximo.</p>
                <button class="product-card__quickview-close">Cerrar</button>
            </div>
        </div>

        <!-- Cuerpo de la Tarjeta -->
        <div class="product-card__body">
            <div>
                <a href="#" class="product-card__name">Serrucho de Mano</a>
                <div class="product-card__price-container">
                  <span class="product-card__price">$10.00</span>
                  <span class="product-card__price product-card__price--original">$12.00</span>
                </div>
            </div>
            
            <!-- Pie de la Tarjeta -->
            <div class="product-card__footer">
                <span></span> <!-- Elemento vacío para empujar los botones a la derecha -->
                <div class="product-card__btns">
                    <a href="#" class="product-card__action" title="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </a>
                    <form action="#" method="POST" style="margin:0;">
                        <button type="submit" class="product-card__action add-to-cart-btn" title="Añadir al carrito">
                            <!-- Ícono de Carrito Corregido -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.28 4.56a2 2 0 001.74 2.94h10.28a2 2 0 001.74-2.94L21 13H7z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona todos los botones de vista rápida y modales en la página
            const quickviewButtons = document.querySelectorAll('.product-card__quickview-btn');
            const modals = document.querySelectorAll('.product-card__quickview-modal');
            const closeButtons = document.querySelectorAll('.product-card__quickview-close');

            // Función para cerrar todos los modales
            const closeAllModals = () => {
                modals.forEach(modal => {
                    modal.classList.remove('is-visible');
                    // Espera a que la transición de opacidad termine para ocultar el div
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300); // Coincide con la duración de la transición
                });
                // Devuelve el scroll al body
                document.body.style.overflow = '';
            };

            // Añadir evento a cada botón de vista rápida
            quickviewButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Busca el modal asociado a esta tarjeta
                    const card = button.closest('.product-card');
                    const modal = card.querySelector('.product-card__quickview-modal');
                    if (modal) {
                        modal.style.display = 'flex';
                        // Usamos un pequeño timeout para que el navegador registre el 'display: flex'
                        // antes de añadir la clase que anima la opacidad.
                        setTimeout(() => {
                            modal.classList.add('is-visible');
                        }, 10);
                        // Evita que el fondo se desplace
                        document.body.style.overflow = 'hidden';
                    }
                });
            });

            // Añadir evento a cada botón de cierre
            closeButtons.forEach(button => {
                button.addEventListener('click', closeAllModals);
            });

            // Cerrar el modal al hacer clic en el fondo oscuro
            modals.forEach(modal => {
                modal.addEventListener('click', (e) => {
                    // Cierra solo si se hace clic en el fondo del modal, no en su contenido
                    if (e.target === modal) {
                        closeAllModals();
                    }
                });
            });

            // Cerrar el modal con la tecla Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const anyModalVisible = Array.from(modals).some(m => m.classList.contains('is-visible'));
                    if (anyModalVisible) {
                        closeAllModals();
                    }
                }
            });
        });
    </script> --}}



    <!--
    |--------------------------------------------------------------------------
    | INICIO DEL COMPONENTE BLADE
    |--------------------------------------------------------------------------
    | Copia y pega este código en tu archivo de componente de Blade.
    | Asegúrate de tener los estilos CSS en tu archivo principal y el
    | script JS al final de tu layout.
    |
    -->
    <div class="product-card">
        @if ($product->images->isNotEmpty())
            <!-- Contenedor de la Imagen -->
            <div class="product-card__img-container">
                @php
                    // Lógica para obtener la URL de la imagen
                    $firstImage = $product->images->first();
                    $imgUrl = $firstImage->image_url ?? asset('storage/' . ($firstImage->image_path ?? $firstImage->path));
                @endphp
                <a href="{{ route('products.show', $product) }}">
                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-card__img" loading="lazy">
                </a>
        
                @if ($product->on_sale) {{-- Asumiendo que tienes una propiedad 'on_sale' --}}
                    <div class="product-card__sale-badge">SALE</div>
                @endif
{{--         
                <button class="product-card__quickview-btn" onclick="window.location='/ruta-al-detalle-del-producto'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="product-card__quickview-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button> --}}
            </div>

            <!-- Modal de Vista Rápida -->
            {{-- <div class="product-card__quickview-modal" style="display:none;">
                <div class="product-card__quickview-content">
                    <h2 class="product-card__quickview-title">{{ $product->name }}</h2>
                    <p class="product-card__quickview-desc">{{ $product->description }}</p>
                    <button class="product-card__quickview-close">Cerrar</button>
                </div>
            </div> --}}
        @endif

        <!-- Cuerpo de la Tarjeta -->
        <div class="product-card__body">
            <!-- CAMBIO CLAVE: Contenido principal envuelto en un div que crece -->
            <div class="product-card__main-content">
                <a href="{{ route('products.show', $product) }}" class="product-card__name">{{ $product->name }}</a>
                <p class="product-card__short-desc">{{ Str::limit($product->description, 80) }}</p>
                <div class="product-card__price-container">
                  <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
                  @if(isset($product->original_price) && $product->original_price > $product->price)
                    <span class="product-card__price product-card__price--original">${{ number_format($product->original_price, 2) }}</span>
                  @endif
                </div>
            </div>
            
            <!-- Pie de la Tarjeta -->
            <div class="product-card__footer">
                <div class="product-card__btns">
                    @auth
                        <a href="{{ route('products.show', $product) }}" class="product-card__action" title="Ver detalles">
                            <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <form action="{{ route('cart.add') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="product-card__action add-to-cart-btn" title="Añadir al carrito">
                                <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.28 4.56a2 2 0 001.74 2.94h10.28a2 2 0 001.74-2.94L21 13H7z" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <!-- ===== INICIO DEL CAMBIO ===== -->
                        <a href="{{ route('products.show', $product) }}" class="product-card__action" title="Ver detalles">
                            <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="product-card__action add-to-cart-btn" title="Iniciar sesión para comprar">
                             <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.28 4.56a2 2 0 001.74 2.94h10.28a2 2 0 001.74-2.94L21 13H7z" />
                            </svg>
                        </a>
                        <!-- ===== FIN DEL CAMBIO ===== -->
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DEL COMPONENTE BLADE -->

    <script>
        // ESTE SCRIPT DEBE IR EN UN ARCHIVO JS GLOBAL (ej. app.js)
        // para que se aplique a todas las tarjetas de producto en la página.
        document.addEventListener('DOMContentLoaded', function () {
            const quickviewButtons = document.querySelectorAll('.product-card__quickview-btn');
            const closeButtons = document.querySelectorAll('.product-card__quickview-close');

            const closeAllModals = () => {
                document.querySelectorAll('.product-card__quickview-modal').forEach(modal => {
                    modal.classList.remove('is-visible');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300);
                });
                document.body.style.overflow = '';
            };

            quickviewButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const card = button.closest('.product-card');
                    const modal = card.querySelector('.product-card__quickview-modal');
                    if (modal) {
                        modal.style.display = 'flex';
                        setTimeout(() => {
                            modal.classList.add('is-visible');
                        }, 10);
                        document.body.style.overflow = 'hidden';
                    }
                });
            });

            closeButtons.forEach(button => {
                button.addEventListener('click', closeAllModals);
            });
            
            document.querySelectorAll('.product-card__quickview-modal').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeAllModals();
                    }
                });
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (document.querySelector('.product-card__quickview-modal.is-visible')) {
                        closeAllModals();
                    }
                }
            });
        });
    </script>