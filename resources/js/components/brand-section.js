document.addEventListener('DOMContentLoaded', function() {
            const brands = [
                'MERCURY', 'TITANIUM', 'ZAFIRO', 'ILUMAX', 'ECOLITE', 'EXCELITE',
                'INTERLED', 'DEXON', 'BRIOLIGH', 'ROYAL', 'LUMEK', 'TITANIUM',
                'DIXTON', 'BAYTER', 'SPARKLED', 'KARLUX', 'FELGOLUX', 'NEW LIGHT',
                'DIGITAL LIGHT', 'SICOLUX', 'ACRILED', 'MARWA'
            ];

            // Usar el ID para seleccionar el contenedor específico
            const sliderContainer = document.getElementById('brandSlider');
            if (!sliderContainer) {
                console.error("Slider container #brandSlider not found!");
                return; // Salir si el contenedor no existe
            }

            const sliderWrapper = sliderContainer.querySelector('.slider-wrapper');
            const prevButton = sliderContainer.querySelector('.prev-button');
            const nextButton = sliderContainer.querySelector('.next-button');

            let currentIndex = 0; // Índice del slide "real" que se muestra al inicio
            let slideWidth = 0; // Ancho de un slide + margen
            let visibleSlides = 1; // Número de slides visibles (se calcula)
            let totalSlides = brands.length; // Número de slides originales
            let itemsToClone = 0; // Número de items a clonar (se calcula)
            let isTransitioning = false; // Flag para evitar clics múltiples durante la transición
            let intervalId = null; // ID para el intervalo de autoplay
            const autoplayDelay = 3000; // Milisegundos para el cambio automático (3 segundos)

            // Verificar si las clases CSS existen antes de agregarlas
            function safeAddClass(element, className) {
                if (className && typeof className === 'string') {
                    element.classList.add(className);
                }
            }

            // Función para generar los slides y los clones para el bucle infinito
            function setupSlider() {
                if (totalSlides === 0) return; // No hacer nada si no hay marcas

                sliderWrapper.innerHTML = ''; // Limpiar slides existentes

                // Calcular cuántos slides son visibles y cuántos clonar
                calculateDimensions();
                itemsToClone = Math.max(1, Math.ceil(visibleSlides)); // Clonar al menos 1 o los visibles

                // 1. Crear los slides originales
                brands.forEach(brand => {
                    createSlideElement(brand, sliderWrapper);
                });

                // 2. Clonar los últimos 'itemsToClone' slides y añadirlos al principio
                for (let i = 0; i < itemsToClone; i++) {
                    const indexToClone = (totalSlides - itemsToClone + i) % totalSlides;
                    createSlideElement(brands[indexToClone], sliderWrapper, true); // true indica que es un clon inicial
                }

                // 3. Clonar los primeros 'itemsToClone' slides y añadirlos al final
                for (let i = 0; i < itemsToClone; i++) {
                    createSlideElement(brands[i], sliderWrapper);
                }

                // 4. Posicionar el slider inicialmente para mostrar los primeros slides *reales*
                // El índice inicial ahora debe considerar los clones al principio
                currentIndex = itemsToClone;
                updateSliderPosition(false); // false para no usar transición al inicio

                // Iniciar autoplay
                startAutoplay();

                // Pausar en hover
                // IMPORTANTE: Asegurarse que el hover en el slide no interfiera con el hover del contenedor
                // Si el slide se hace muy grande, podría salir del contenedor y detener el autoplay
                // La lógica actual (hover en el contenedor) debería funcionar bien.
                sliderContainer.addEventListener('mouseenter', stopAutoplay);
                sliderContainer.addEventListener('mouseleave', startAutoplay);
            }

            // Función auxiliar para crear un elemento slide
            function createSlideElement(brand, wrapper, prepend = false) {
                const slide = document.createElement('div');
                safeAddClass(slide, 'slide');

                // Puedes personalizar el enlace según la marca
                const link = document.createElement('a');
                link.href = `/marcas/${encodeURIComponent(brand.toLowerCase().replace(/\s+/g, '-'))}`;
                link.target = '_blank'; // Abre en nueva pestaña (opcional)
                link.rel = 'noopener noreferrer';

                const img = document.createElement('img');
                img.src = `https://placehold.co/200x100/e2e8f0/374151?text=${encodeURIComponent(brand)}`;
                img.alt = `Logo ${brand}`;
                img.onerror = function() { this.src='https://placehold.co/200x100/cccccc/ffffff?text=Imagen+no+disponible'; };

                // Pausar autoplay al pasar el mouse sobre la imagen
                img.addEventListener('mouseenter', stopAutoplay);
                img.addEventListener('mouseleave', startAutoplay);

                link.appendChild(img);

                const p = document.createElement('p');
                p.textContent = brand;

                slide.appendChild(link);
                slide.appendChild(p);

                if (prepend) {
                    wrapper.insertBefore(slide, wrapper.firstChild); // Añadir al principio
                } else {
                    wrapper.appendChild(slide); // Añadir al final
                }
            }

            // Función para calcular dimensiones (ancho slide, slides visibles)
            function calculateDimensions() {
                 // Usar un slide temporal para medir si el wrapper está vacío inicialmente
                const tempSlide = document.createElement('div');
                safeAddClass(tempSlide, 'slide');
                tempSlide.style.visibility = 'hidden'; // Oculto para la medición
                // Añadir margen para que la medición sea precisa
                tempSlide.style.marginRight = '1rem';
                sliderWrapper.appendChild(tempSlide);

                const slideStyle = window.getComputedStyle(tempSlide);
                const slideMarginRight = parseFloat(slideStyle.marginRight);
                // Usar getBoundingClientRect para una medición más precisa del ancho renderizado
                slideWidth = tempSlide.getBoundingClientRect().width + slideMarginRight;

                sliderWrapper.removeChild(tempSlide); // Eliminar el slide temporal

                if (slideWidth > 0) {
                     // Ajustar el cálculo de visibles por si el contenedor tiene padding
                    const containerWidth = sliderContainer.clientWidth; // Usar clientWidth que excluye padding vertical y bordes
                    visibleSlides = Math.max(1, Math.floor(containerWidth / slideWidth));
                } else {
                    visibleSlides = 1; // Fallback si el ancho es 0
                }
            }

            // Función para actualizar la posición del slider (translateX)
            function updateSliderPosition(useTransition = true) {
                const offset = -currentIndex * slideWidth;
                if (useTransition) {
                    sliderWrapper.classList.remove('no-transition');
                    sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
                } else {
                    safeAddClass(sliderWrapper, 'no-transition');
                    sliderWrapper.style.transition = 'none';
                }
                sliderWrapper.style.transform = `translateX(${offset}px)`;

                 if (!useTransition) {
                    // Pequeño timeout para asegurar que la transición se deshabilita antes de volver a habilitarla
                    setTimeout(() => {
                        sliderWrapper.classList.remove('no-transition');
                        sliderWrapper.style.transition = ''; // Restaurar transición por defecto
                    }, 50);
                 }
            }

            // Función para mover el slider (siguiente/anterior)
            function moveSlider(direction) {
                if (isTransitioning) return;
                isTransitioning = true;

                currentIndex += (direction === 'next' ? 1 : -1);
                updateSliderPosition(true);
            }

            // Manejador para el final de la transición CSS
            sliderWrapper.addEventListener('transitionend', () => {
                isTransitioning = false; // Permitir el siguiente movimiento

                // Lógica del bucle infinito:
                if (currentIndex >= totalSlides + itemsToClone) {
                    currentIndex = itemsToClone;
                    updateSliderPosition(false);
                }
                else if (currentIndex < itemsToClone) {
                    // Ajuste: el índice correcto al saltar desde el principio es itemsToClone + totalSlides - 1
                    // No, debe ser el índice del último slide real *antes* de los clones finales.
                    // Si tenemos N slides y C clones al inicio, los índices van de 0 a C-1 (clones), C a C+N-1 (reales), C+N a C+N+C-1 (clones).
                    // El índice del último slide real es C + N - 1.
                    // El índice justo antes del primer clon inicial (índice C-1) debe saltar al índice C + N-1.
                    // El código original `totalSlides + itemsToClone - 1` parece correcto para el índice *visual* del último real en la secuencia clonada.
                    // Vamos a mantenerlo, pero verificar su lógica. Si saltamos de index C-1, vamos a index C+N-1.
                    currentIndex = totalSlides + itemsToClone -1; // Saltar al índice del último slide real (considerando clones)
                    updateSliderPosition(false);
                }
            });


            // Iniciar autoplay
            function startAutoplay() {
                stopAutoplay(); // Limpiar intervalo existente si lo hay
                if (totalSlides > visibleSlides) { // Solo si hay más slides que los visibles
                    intervalId = setInterval(() => {
                        moveSlider('next');
                    }, autoplayDelay);
                }
            }

            // Detener autoplay
            function stopAutoplay() {
                clearInterval(intervalId);
                intervalId = null; // Marcar que no hay intervalo activo
            }

            // Event Listeners para los botones
            nextButton.addEventListener('click', () => {
                 if (!isTransitioning) {
                    stopAutoplay();
                    moveSlider('next');
                    // Reiniciar autoplay solo si el mouse no está sobre el contenedor
                    if (!sliderContainer.matches(':hover')) {
                        startAutoplay();
                    }
                 }
            });

            prevButton.addEventListener('click', () => {
                 if (!isTransitioning) {
                    stopAutoplay();
                    moveSlider('prev');
                     // Reiniciar autoplay solo si el mouse no está sobre el contenedor
                    if (!sliderContainer.matches(':hover')) {
                        startAutoplay();
                    }
                 }
            });

            // Actualizar dimensiones y reiniciar slider en resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    stopAutoplay();
                    setupSlider(); // Re-inicializar completamente
                }, 250);
            });

            // Inicializar el slider
            setupSlider();

        });