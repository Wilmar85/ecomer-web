<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-categories-create__title">
            {{ __('Crear Categoría') }}
        </h2>
    </x-slot>
    <div class="admin-categories-create__section">
        <div class="admin-categories-create__container">
            <div class="admin-categories-create__card">
                <div class="admin-categories-create__content">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="admin-categories-create__label">Nombre</label>
                            <input type="text" name="name" class="admin-categories-create__input" required />
                        </div>
                        <div class="mb-4">
                            <label class="admin-categories-create__label">Descripción</label>
                            <textarea name="description" class="admin-categories-create__input"></textarea>
                        </div>
                        <div class="admin-categories-create__actions">
                            <a href="{{ route('admin.categories.index') }}" class="admin-categories-create__button admin-categories-create__button--secondary">Cancelar</a>
                            <button type="submit" class="admin-categories-create__button admin-categories-create__button--primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
