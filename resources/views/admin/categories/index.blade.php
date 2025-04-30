<x-app-layout>
    <x-slot name="header">
    <div class="admin-categories-index__header">
            <h2 class="admin-categories-index__title">
            {{ __('Gestión de Categorías') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="admin-categories-index__button admin-categories-index__button--primary">
                Crear Categoría
            </a>
        </div>
    </x-slot>

    <div class="admin-categories-index__section">
        <div class="admin-categories-index__container">
            <div class="admin-categories-index__card">
                <div class="admin-categories-index__content">
                    @if (session('success'))
                        <div class="admin-categories-index__alert admin-categories-index__alert--success"
                            role="alert">
                            <span class="admin-categories-index__alert-text">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="admin-categories-index__table-wrap">
                        <table class="admin-categories-index__table">
                            <thead class="admin-categories-index__thead">
                                <tr>
                                    <th scope="col"
                                        class="admin-categories-index__th">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="admin-categories-index__th">
                                        Descripción
                                    </th>
                                    <th scope="col"
                                        class="admin-categories-index__th">
                                        Productos
                                    </th>
                                    <th scope="col"
                                        class="admin-categories-index__th">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="admin-categories-index__tbody">
                                @foreach ($categories as $category)
                                    <tr class="admin-categories-index__tr">
                                        <td class="admin-categories-index__td">
                                            <div class="admin-categories-index__title-cell">
                                                {{ $category->name }}
                                            </div>
                                        </td>
                                        <td class="admin-categories-index__td">
                                            <div class="admin-categories-index__cell">
                                                {{ $category->description }}
                                            </div>
                                        </td>
                                        <td class="admin-categories-index__td">
                                            <div class="admin-categories-index__cell">
                                                {{ $category->products_count }}
                                            </div>
                                        </td>
                                        <td class="admin-categories-index__td">
                                            <div class="admin-categories-index__actions">
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="admin-categories-index__btn admin-categories-index__btn--warning">Editar</a>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="admin-categories-index__btn admin-categories-index__btn--danger">Eliminar</button>
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
    </div>

    <!-- Modal para crear/editar categoría -->
    <div id="categoryModal" class="admin-categories-index__modal">
        <div class="admin-categories-index__modal-content">
            <form id="categoryForm" method="POST" class="admin-categories-index__form">
                @csrf
                <div id="methodField"></div>

                <div class="admin-categories-index__form-group">
                    <label for="name" class="admin-categories-index__label">Nombre</label>
                    <input type="text" name="name" id="name" required
                        class="admin-categories-index__input">
                </div>

                <div class="admin-categories-index__form-group">
                    <label for="description" class="admin-categories-index__label">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                        class="admin-categories-index__textarea"></textarea>
                </div>

                <div class="categories__form-actions">
                    <button type="submit" class="categories__btn categories__btn--primary">
                        Guardar
                    </button>
                    <button type="button" onclick="closeModal()" class="categories__btn categories__btn--secondary">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryForm').action = '{{ route('admin.categories.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        function editCategory(id, name, description) {
            document.getElementById('categoryForm').action = `/admin/categories/${id}`;
            document.getElementById('methodField').innerHTML = '@method('PUT')';
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('categoryModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>
