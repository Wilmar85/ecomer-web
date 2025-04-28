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
                            <span class="block sm:inline">{{ session('success') }}</span>
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
                                        class="categories__table-th">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="categories__table-body">
                                @foreach ($categories as $category)
                                    <tr class="categories__table-row">
                                        <td class="categories__table-td">
                                            <div class="categories__title">
                                                {{ $category->name }}
                                            </div>
                                        </td>
                                        <td class="categories__table-td">
                                            <div class="categories__table-cell">
                                                {{ $category->description }}
                                            </div>
                                        </td>
                                        <td class="categories__table-td">
                                            <div class="categories__table-cell">
                                                {{ $category->products_count }}
                                            </div>
                                        </td>
                                        <td class="categories__table-td">
                                            <div class="categories__actions">
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="categories__btn categories__btn--warning">Editar</a>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="categories__btn categories__btn--danger">Eliminar</button>
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
    <div id="categoryModal" class="categories__modal">
        <div class="categories__modal-content">
            <form id="categoryForm" method="POST" class="categories__form">
                @csrf
                <div id="methodField"></div>

                <div class="categories__form-group">
                    <label for="name" class="categories__label">Nombre</label>
                    <input type="text" name="name" id="name" required
                        class="categories__input">
                </div>

                <div class="categories__form-group">
                    <label for="description" class="categories__label">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                        class="categories__textarea"></textarea>
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
