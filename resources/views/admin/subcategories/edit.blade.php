<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-subcategories__title">
            {{ __('Editar Subcategoría') }}
        </h2>
    </x-slot>

    <div class="admin-subcategories__section">
        <div class="admin-subcategories__container">
            <div class="admin-subcategories__card">
                <div class="admin-subcategories__card-body">
                    <form method="POST" action="{{ route('admin.subcategories.update', $subcategory) }}">
                        @csrf
                        @method('PUT')
                        <div class="admin-subcategories__form-group">
                            <label class="admin-subcategories__label">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $subcategory->name) }}" class="admin-subcategories__input" required />
                        </div>
                        <div class="admin-subcategories__form-group">
                            <label class="admin-subcategories__label">Categoría</label>
                            <select name="category_id" class="admin-subcategories__select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="admin-subcategories__actions">
                            <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
