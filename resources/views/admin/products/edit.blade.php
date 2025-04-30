<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-products-edit__header">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="admin-products-edit__section">
        <div class="admin-products-edit__container">
            <div class="admin-products-edit__card">
                <div class="admin-products-edit__card-body">
                    @if ($errors->any())
                        <div class="admin-products-edit__alert"
                            role="alert">
                            <ul class="admin-products-edit__error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product) }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off" class="admin-products-edit__form">
                        @csrf
                        @method('PUT')

                        <div class="admin-products-edit__form-grid">
                            <div>
                                <label for="name" class="admin-products-edit__label">Nombre del
                                    producto</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $product->name) }}" required
                                    class="admin-products-edit__input">
                            </div>

                            <div>
                                <label for="brand_name" class="admin-products-edit__label">Marca</label>
                                <input type="text" name="brand_name" id="brand_name" list="brand-list" value="{{ old('brand_name', $product->brand->name ?? '') }}" required
                                    class="admin-products-edit__input"
                                    placeholder="Escribe o selecciona una marca">
                                <datalist id="brand-list">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}"></option>
                                    @endforeach
                                </datalist>
                                <small class="admin-products-edit__help">La marca se normalizará automáticamente (Ej: Samsung, Apple, etc.)</small>
                            </div>

                            <div>
                                <label for="category_id"
                                    class="admin-products-edit__label">Categoría</label>
                                <select name="category_id" id="category_id" required
                                    class="admin-products-edit__input">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="price" class="admin-products-edit__label">Precio</label>
                                <div class="admin-products-edit__input-group">
                                    <div class="admin-products-edit__input-absolute">
                                        <span class="admin-products-edit__input-left">$</span>
                                    </div>
                                    <input type="number" name="price" id="price"
                                        value="{{ old('price', $product->price) }}" step="0.01" required
                                        class="admin-products-edit__input admin-products-edit__input-padding-l">
                                </div>
                            </div>

                            <div>
                                <label for="stock" class="admin-products-edit__label">Stock</label>
                                <input type="number" name="stock" id="stock"
                                    value="{{ old('stock', isset($product) ? $product->stock : '') }}" required
                                    class="admin-products-edit__input">
                            </div>
                        </div>

                        <div>
                            <label for="description" class="admin-products-edit__label">Descripción</label>
                            <textarea name="description" id="description" rows="4" required
                                class="admin-products-edit__input">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div>
                            <label class="admin-products-edit__label admin-products-edit__input-block">Imágenes actuales</label>
                            <div class="admin-products-edit__images-grid">
                                @foreach ($product->images as $image)
                                    <div class="admin-products-edit__image-wrapper">
                                        <img src="{{ method_exists($image, 'getImageUrlAttribute') ? $image->image_url : asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="admin-products-edit__image admin-products-edit__image-fullwidth admin-products-edit__image-rounded">
                                        <div class="admin-products-edit__image-remove admin-products-edit__input-absolute">
                                            <button type="button" onclick="deleteImage({{ $image->id }})"
                                                class="admin-products-edit__image-remove-btn admin-products-edit__image-remove-bg admin-products-edit__image-remove-hover">
                                                <svg class="admin-products-edit__image-remove-svg" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <label class="admin-products-edit__label">Agregar nuevas imágenes</label>
                            <div class="admin-products-edit__input-group admin-products-edit__input-flex admin-products-edit__input-justify-center admin-products-edit__input-padding admin-products-edit__input-border admin-products-edit__input-rounded">
                                <div class="admin-products-edit__input-space-y-1 admin-products-edit__input-text-center">
                                    <svg class="admin-products-edit__input-svg" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="admin-products-edit__input-flex admin-products-edit__input-text-sm admin-products-edit__input-text-gray-600">
                                        <label for="images"
                                            class="admin-products-edit__input-relative admin-products-edit__input-cursor-pointer admin-products-edit__input-bg-white admin-products-edit__input-rounded-md admin-products-edit__input-font-medium admin-products-edit__input-text-blue-600 admin-products-edit__input-hover-text-blue-500 admin-products-edit__input-focus-within-outline-none admin-products-edit__input-focus-within-ring-2 admin-products-edit__input-focus-within-ring-offset-2 admin-products-edit__input-focus-within-ring-blue-500">
                                            <span>Subir archivos</span>
                                            <input id="images" name="images[]" type="file" class="sr-only"
                                                multiple accept="image/*">
                                        </label>
                                        <p class="admin-products-edit__input-padding-left">o arrastrar y soltar</p>
                                    </div>
                                    <p class="admin-products-edit__input-left admin-products-edit__input-xs admin-products-edit__input-text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="admin-products-edit__input-flex admin-products-edit__input-items-center">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" name="active" id="active"
                                class="admin-products-edit__checkbox"
                                value="1" {{ old('active', isset($product) ? $product->active : false) ? 'checked' : '' }}>
                            <label for="active" class="admin-products-edit__checkbox-label">Producto activo</label>
                        </div>

                        <div class="admin-products-edit__actions">
                            <a href="{{ route('admin.products.index') }}"
                                class="admin-products-edit__cancel-btn">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="admin-products-edit__submit-btn">
                                Actualizar Producto
                            </button>
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
                form.action = "{{ route('admin.admin.product-images.destroy', ['productImage' => '']) }}/" + imageId;
                form.submit();
            }
        }
    </script>
</x-app-layout>
