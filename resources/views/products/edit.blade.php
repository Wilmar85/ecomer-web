<x-app-layout>
    <x-slot name="header">
        <div class="products-edit__header-bar">
            <h2 class="products-edit__header">
                {{ __('Editar Producto') }}
            </h2>
            @can('delete', $product)
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="products-edit__delete-btn">Eliminar</button>
                </form>
            @endcan
        </div>
    </x-slot>

    <div class="products-edit">
        <div class="products-edit__container">
            <div class="products-edit__card">
                <div class="products-edit__form-wrapper">
                    @if ($errors->any())
                        <div class="products-edit__msg">
                            <div class="products-edit__alert products-edit__alert--error"
                                role="alert">
                                <strong class="font-bold">¡Error!</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
                        class="products-edit__form">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nombre del producto')" />
                            <x-text-input id="name" name="name" type="text" class="products-edit__input"
                                :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="products-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Categoría')" />
                            <select id="category_id" name="category_id"
                                class="products-edit__select">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="products-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Precio')" />
                            <x-text-input id="price" name="price" type="number" class="products-edit__input"
                                :value="old('price', $product->price)" step="0.01" required />
                            <x-input-error :messages="$errors->get('price')" class="products-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="products-edit__input"
                                :value="old('stock', $product->stock)" required />
                            <x-input-error :messages="$errors->get('stock')" class="products-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description"
                                class="products-edit__select"
                                rows="4">{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="products-edit__input-error" />
                        </div>

                        <!-- Imágenes actuales -->
                        @if ($product->images->isNotEmpty())
                            <div>
                                <h3 class="products-edit__images-title">Imágenes actuales</h3>
                                <div class="products-edit__images-grid">
                                    @foreach ($product->images as $image)
                                        <div class="products-edit__image-wrapper">
                                            <img src="{{ method_exists($image, 'getImageUrlAttribute') ? $image->image_url : asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}"
                                                class="products-edit__image">
                                            <div
                                                class="products-edit__image-overlay">
                                                <button type="button" onclick="deleteImage({{ $image->id }})"
                                                    class="products-edit__image-delete-btn">
                                                    <svg class="products-edit__image-delete-icon" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Subir nuevas imágenes -->
                        <div>
                            <label class="products-edit__images-label">Agregar nuevas imágenes</label>
                            <div
                                class="products-edit__upload-area">
                                <div class="products-edit__upload-content">
                                    <svg class="products-edit__upload-icon" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="products-edit__upload-row">
                                        <label for="images"
                                            class="products-edit__upload-label">
                                            <span>Subir archivos</span>
                                            <input id="images" name="images[]" type="file" class="sr-only"
                                                multiple accept="image/*" onchange="handleImageSelection(event)">
                                        </label>
                                        <p class="products-edit__upload-separator">o arrastrar y soltar</p>
                                    </div>
                                    <p class="products-edit__upload-hint">
                                        PNG, JPG, GIF hasta 2MB
                                    </p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('images')" class="products-edit__input-error" />
<div id="image-upload-feedback" class="products-edit__feedback products-edit__feedback--hidden">
    <div class="products-edit__alert products-edit__alert--info" role="alert">
        <span class="products-edit__alert-text" id="image-upload-message"></span>
    </div>
</div>
<div id="image-preview-container" class="mb-4 flex flex-wrap gap-4"></div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Actualizar Producto') }}</x-primary-button>
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>

                    <form id="delete-image-form" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteImage(imageId) {
            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                const form = document.getElementById('delete-image-form');
                form.action = `/product-images/${imageId}`;
                form.submit();
            }
        }
    </script>
<script>
    function handleImageSelection(event) {
        const files = event.target.files;
        const feedback = document.getElementById('image-upload-feedback');
        const message = document.getElementById('image-upload-message');
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';
        if (files.length > 0) {
            let fileNames = Array.from(files).map(f => f.name).join(', ');
            message.innerText = `Imágenes seleccionadas: ${fileNames}`;
            feedback.classList.remove('hidden');
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.className = 'h-24 w-24 object-cover rounded border border-gray-300';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            message.innerText = '';
            feedback.classList.add('hidden');
        }
    }
</script>
</x-app-layout>
