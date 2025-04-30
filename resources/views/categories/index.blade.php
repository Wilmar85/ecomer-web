<x-app-layout>
    <x-slot name="header">
        <div class="categories-index__header">
            <h2 class="categories-index__title">
                {{ __('Categorías') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="categories-index__btn">
                {{ __('Nueva Categoría') }}
            </a>
        </div>
    </x-slot>

    <div class="categories-index__section">
        <div class="categories-index__container">
            @if (session('success'))
                <div class="categories-index__alert--success"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="categories-index__alert--error"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="categories-index__card">
                <div class="categories-index__content">
                    <table class="categories-index__table">
                        <thead class="categories-index__thead">
                            <tr>
                                <th scope="col"
                                    class="categories-index__th">
                                    {{ __('Nombre') }}
                                </th>
                                <th scope="col"
                                    class="categories-index__th">
                                    {{ __('Categoría Padre') }}
                                </th>
                                <th scope="col"
                                    class="categories-index__th">
                                    {{ __('Descripción') }}
                                </th>
                                <th scope="col"
                                    class="categories-index__th">
                                    {{ __('Acciones') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="categories-index__tbody">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="categories-index__td">
                                        <div class="categories-index__cell--main">
                                            {{ $category->name }}
                                        </div>
                                    </td>
                                    <td class="categories-index__td">
                                        <div class="categories-index__cell">
                                            {{ $category->parent ? $category->parent->name : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="categories-index__cell">
                                            {{ Str::limit($category->description, 100) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="categories-index__actions">
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="categories-index__edit">
                                                {{ __('Editar') }}
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                class="categories-index__form-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="categories-index__delete"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
