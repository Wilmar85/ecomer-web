<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-categories-edit__title">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>
    <div class="admin-categories-edit__section">
        <div class="admin-categories-edit__container">
            <div class="admin-categories-edit__card">
                <div class="admin-categories-edit__content">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="admin-categories-edit__label">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="admin-categories-edit__input" required />
                        </div>
                        <div class="mb-4">
                            <label class="admin-categories-edit__label">Descripción</label>
                            <textarea name="description" class="admin-categories-edit__input">{{ old('description', $category->description) }}</textarea>
                        </div>
                        <div class="admin-categories-edit__actions">
                            <a href="{{ route('admin.categories.index') }}" class="admin-categories-edit__button admin-categories-edit__button--secondary">Cancelar</a>
                            <button type="submit" class="admin-categories-edit__button admin-categories-edit__button--primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
