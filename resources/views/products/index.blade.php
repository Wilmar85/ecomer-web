<x-app-layout>
    <x-slot name="header">
        <div class="products-index__header-bar">
            <h2 class="products-index__title">
                {{ __('Productos') }}
            </h2>
            @if (Auth::user()?->isAdmin())
                <a href="{{ route('products.create') }}" class="products-index__create-btn">
                    {{ __('Crear Producto') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="products-index">
        <div class="products-index__container">
            <div class="products-index__content">
                @if (session('success'))
                    <div class="products-index__alert products-index__alert--success" role="alert">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="products-index__list">
                    @foreach ($products as $product)
                        <div class="products-index__card">
                            @if ($product->images->isNotEmpty())
                                @php
                                    $imgUrl = method_exists($product->images->first(), 'getImageUrlAttribute') ? $product->images->first()->image_url : asset('storage/' . $product->images->first()->image_path);
                                @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="products-index__img">
                            @else
                                <div class="products-index__img--placeholder">
                                    <span>Sin imagen</span>
                                </div>
                            @endif

                            <div class="products-index__body">
                                <h3 class="products-index__name">{{ $product->name }}</h3>
                                <p class="products-index__desc">{{ Str::limit($product->description, 100) }}</p>
                                <p class="products-index__price">${{ number_format($product->price, 2) }}</p>
                                <p class="products-index__stock">Stock: {{ $product->stock }}</p>

                                <div class="products-index__actions">
                                    <a href="{{ route('products.show', $product) }}" class="products-index__action-link">
                                        Ver detalles
                                    </a>

                                    @if (Auth::user()?->isAdmin())
                                        <div class="products-index__action-group">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="products-index__edit-link">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="products-index__delete-form" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="products-index__delete-btn">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                    <div class="products-index__pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Botón flotante para subir al menú (solo home) -->
  <!-- Ajuste: scroll-to-top button y WhatsApp button no se solapan -->
  <div class="products-index__floating">
    <div style="display: none;" class="products-index__scroll-btn-container">
      <button data-scroll-to-top-btn class="products-index__scroll-btn">
          <!-- Icono de flecha hacia arriba -->
          <svg xmlns="http://www.w3.org/2000/svg" class="products-index__scroll-btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
          </svg>
      </button>
    </div>
    <script>



  






        }

    </script>
    <style>
      /* Ajuste para que el botón de WhatsApp y el de scroll no se solapen */
      #whatsapp-float {
        bottom: 28px !important;
        right: 24px !important;
        transition: right 0.3s cubic-bezier(.4,0,.2,1);
      }
      @media (max-width: 640px) {
        #whatsapp-float {
          bottom: 16px !important;
          right: 12px !important;
        }
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
      // Mover el botón de WhatsApp a la izquierda si el de subir está visible


          const btn = document.getElementById('whatsapp-float');
          if(btn) {

              btn.classList.add('move-left');
    
              btn.classList.remove('move-left');
            }
          }
  

    </script>
  </div>
</x-app-layout>
