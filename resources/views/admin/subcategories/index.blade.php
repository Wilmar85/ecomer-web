<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-subcategories__title">
            {{ __('Gestión de Subcategorías') }}
        </h2>
    </x-slot>

    <div class="admin-subcategories__section">
        <div class="admin-subcategories__container">
            <div class="admin-subcategories__card">
                <div class="admin-subcategories__card-body">
                    @if (session('success'))
                        <div class="admin-subcategories__alert" role="alert">
                            <span class="admin-subcategories__alert-text">{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="admin-subcategories__actions">
                        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">Crear Subcategoría</a>
                    </div>
                    <div class="admin-subcategories__table-wrapper">
                        <table class="admin-subcategories__table">
                            <thead class="admin-subcategories__thead">
                                <tr>
                                    <th class="admin-subcategories__th">ID</th>
                                    <th class="admin-subcategories__th">Nombre</th>
                                    <th class="admin-subcategories__th">Categoría</th>
                                    <th class="admin-subcategories__th">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="admin-subcategories__tbody">
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td class="admin-subcategories__td">{{ $subcategory->id }}</td>
                                        <td class="admin-subcategories__td">{{ $subcategory->name }}</td>
                                        <td class="admin-subcategories__td">{{ $subcategory->category->name ?? '-' }}</td>
                                        <td class="admin-subcategories__td admin-subcategories__td--actions">
                                            <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta subcategoría?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $subcategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
