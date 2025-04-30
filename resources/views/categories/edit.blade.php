<x-app-layout>
    <x-slot name="header">
        <h2 class="categories-edit__header">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <div class="categories-edit__section">
        <div class="categories-edit__container">
            <div class="categories-edit__card">
                <div class="categories-edit__content">
                    <form method="POST" action="{{ route('categories.update', $category) }}" class="categories-edit__form">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="categories-edit__input"
                                :value="old('name', $category->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="categories-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description" class="categories-edit__input"
                                rows="3">{{ old('description', $category->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="categories-edit__input-error" />
                        </div>

                        <div>
                            <x-input-label for="parent_id" :value="__('Categoría Padre (Opcional)')" />
                            <select id="parent_id" name="parent_id" class="categories-edit__input">
                                <option value="">{{ __('Ninguna') }}</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}"
                                        {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" class="categories-edit__input-error" />
                        </div>

                        <div class="categories-edit__actions">
                            <x-primary-button>{{ __('Actualizar Categoría') }}</x-primary-button>
                            <a href="{{ route('categories.index') }}"
                                class="secondary-btn">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
