<x-app-layout>
    <x-slot name="header">
        <h2 class="products-create__header">
            {{ __('Crear Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="products-create">
        <div class="products-create__container">
            <div class="products-create__card">
                <div class="products-create__form-wrapper">
                    @if (session('success'))
                        <div class="products-create__msg">
                            <div class="products-create__alert products-create__alert--success" role="alert">
                                <strong class="font-bold">¡Éxito!</strong>
                                <span class="products-create__alert-text">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="products-create__msg">
                            <div class="products-create__alert products-create__alert--error" role="alert">
                                <strong class="font-bold">¡Error!</strong>
                                <span class="products-create__alert-text">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="products-create__msg">
                            <div class="products-create__alert products-create__alert--error"
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

                    <div id="image-upload-feedback" class="products-create__feedback products-create__feedback--hidden">
    <div class="products-create__alert products-create__alert--info" role="alert">
        <span class="products-create__alert-text" id="image-upload-message"></span>
    </div>
</div>
<div id="image-preview-container" class="products-create__image-preview"></div>

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                        class="products-create__form">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nombre del producto')" />
                            <x-text-input id="name" name="name" type="text" class="products-create__input"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="products-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Categoría')" />
                            <select id="category_id" name="category_id"
                                class="products-create__select">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="products-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Precio')" />
                            <x-text-input id="price" name="price" type="number" class="products-create__input"
                                :value="old('price')" step="0.01" required />
                            <x-input-error :messages="$errors->get('price')" class="products-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="products-create__input"
                                :value="old('stock')" required />
                            <x-input-error :messages="$errors->get('stock')" class="products-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description"
                                class="products-create__select"
                                rows="4">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="products-create__input-error" />
                        </div>

                        <div>
                            <label class="products-create__images-label">Imágenes del producto</label>
                            <div
                                class="products-create__upload-area">
                                <div class="products-create__upload-content">
                                    <svg class="products-create__upload-icon" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="products-create__upload-row">
                                        <label for="images"
                                            class="products-create__upload-label">
                                            <span>Subir archivos</span>
                                            <input id="images" name="images[]" type="file" class="sr-only"
                                                multiple accept="image/*" onchange="handleImageSelection(event)">
                                        </label>
                                        <p class="products-create__upload-separator">o arrastrar y soltar</p>
                                    </div>
                                    <p class="products-create__upload-hint">
                                        PNG, JPG, GIF hasta 2MB
                                    </p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('images')" class="products-create__input-error" />
                        </div>

                        <div class="products-create__actions">
                            <x-primary-button>{{ __('Crear Producto') }}</x-primary-button>
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
