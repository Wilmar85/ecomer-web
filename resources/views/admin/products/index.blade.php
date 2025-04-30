<x-app-layout>
    <x-slot name="header">
        <div class="admin-products__header">
            <h2 class="admin-products__title">
                {{ __('Gestión de Productos') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="admin-products__create-btn">
                Crear Producto
            </a>
        </div>
    </x-slot>

    <div class="admin-products__section">
        <div class="admin-products__container">
            <div class="admin-products__card">
                <div class="admin-products__card-body">
                    @if (session('success'))
                        <div class="admin-products__alert"
                            role="alert">
                            <span class="admin-products__alert-text">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="admin-products__table-wrapper">
                        <table class="admin-products__table">
                            <thead class="admin-products__thead">
                                <tr>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Imagen
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Categoría
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Precio
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Stock
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Estado
                                    </th>
                                    <th scope="col"
                                        class="admin-products__th">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="admin-products__tbody">
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="admin-products__td">
                                            @if ($product->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                                    alt="{{ $product->name }}"
                                                    class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">Sin imagen</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="admin-products__td">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $product->name }}
                                            </div>
                                        </td>
                                        <td class="admin-products__td">
                                            <div class="text-sm text-gray-900">
                                                {{ $product->category->name }}
                                            </div>
                                        </td>
                                        <td class="admin-products__td">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        </td>
                                        <td class="admin-products__td">
                                            <div class="text-sm text-gray-900">
                                                {{ $product->stock }}
                                            </div>
                                        </td>
                                        <td class="admin-products__td">
                                            @if($product->active)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">Activo</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
