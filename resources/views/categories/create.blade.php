<x-app-layout>
    <x-slot name="header">
        <h2 class="categories-create__header">
            {{ __('Crear Nueva Categoría') }}
        </h2>
    </x-slot>

    <div class="categories-create__section">
        <div class="categories-create__container">
            <div class="categories-create__card">
                <div class="categories-create__content">
                    <form method="POST" action="{{ route('categories.store') }}" class="categories-create__form">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="categories-create__input"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="categories-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description" class="categories-create__input"
                                rows="3">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="categories-create__input-error" />
                        </div>

                        <div>
                            <x-input-label for="parent_id" :value="__('Categoría Padre (Opcional)')" />
                            <select id="parent_id" name="parent_id" class="categories-create__input">
                                <option value="">{{ __('Ninguna') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" class="categories-create__input-error" />
                        </div>

                        <div class="categories-create__actions">
                            <x-primary-button>{{ __('Crear Categoría') }}</x-primary-button>
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
