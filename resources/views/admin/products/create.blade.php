<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-products-create__header">
            {{ __('Crear Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="admin-products-create__section">
        <div class="admin-products-create__container">
            <div class="admin-products-create__card">
                <div class="admin-products-create__content">
                    @if ($errors->any())
                        <div class="admin-products-create__alert--error"
                            role="alert">
                            <ul class="admin-products-create__error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                        class="admin-products-create__form">
                        @csrf

                        <div class="admin-products-create__form-grid">
                            <div>
                                <label for="name" class="admin-products-create__label">Nombre del
                                    producto</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="admin-products-create__input-group admin-products-create__input">
                            </div>

                            <div>
                                <label for="category_id"
                                    class="admin-products-create__label">Categoría</label>
                                <select name="category_id" id="category_id" required
                                    class="admin-products-create__input-group admin-products-create__input">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
    <label for="brand_name" class="admin-products-create__label">Marca</label>
    <input type="text" name="brand_name" id="brand_name" list="brand-list" value="{{ old('brand_name') }}" required
        class="admin-products-create__input-group admin-products-create__input"
        placeholder="Escribe o selecciona una marca">
    <datalist id="brand-list">
        @foreach ($brands as $brand)
            <option value="{{ $brand->name }}"></option>
        @endforeach
    </datalist>
    <small class="text-gray-500">La marca se normalizará automáticamente (Ej: Samsung, Apple, etc.)</small>
</div>
                            <div>
                                <label for="price" class="admin-products-create__label">Precio</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                                        step="0.01" required
                                        class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="stock" class="admin-products-create__label">Stock</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', isset($product) ? $product->stock : '') }}" required
                                    class="admin-products-create__input-group admin-products-create__input">
                            </div>
                        </div>

                        <div>
                            <label for="description" class="admin-products-create__label">Descripción</label>
                            <textarea name="description" id="description" rows="4" required
                                class="admin-products-create__input-group admin-products-create__input">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="admin-products-create__label">Imágenes del producto</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Subir archivos</span>
                                            <input id="images" name="images[]" type="file" class="sr-only"
                                                multiple accept="image/*">
                                        </label>
                                        <p class="pl-1">o arrastrar y soltar</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
    <input type="hidden" name="active" value="0">
    <input type="checkbox" name="active" id="active"
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
        value="1" {{ old('active', isset($product) ? $product->active : false) ? 'checked' : '' }}>
    <label for="active" class="ml-2 block text-sm text-gray-900">Producto activo</label>
</div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.products.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
