<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-orders-index__title">
            {{ __('Gestión de Pedidos') }}
        </h2>
    </x-slot>

    <div class="admin-orders-index__section">
        <div class="admin-orders-index__container">
            <div class="admin-orders-index__card">
                <div class="admin-orders-index__content">
                    @if (session('success'))
                        <div class="admin-orders-index__alert--success"
                            role="alert">
                            <span class="admin-orders-index__alert-text">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="admin-orders-index__table-scroll">
                        <table class="admin-orders-index__table">
                            <thead class="admin-orders-index__thead">
                                <tr>
                                    @php
    $sort = request('sort', 'id');
    $direction = request('direction', 'desc');
    function sort_link($label, $column, $sort, $direction) {
        $icon = '';
        if ($sort === $column) {
            $icon = $direction === 'asc' ? '↑' : '↓';
        }
        $newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
        $query = array_merge(request()->except(['page', 'sort', 'direction']), ['sort' => $column, 'direction' => $newDirection]);
        $url = request()->url() . '?' . http_build_query($query);
        return '<a href="' . $url . '" class="admin-orders-index__sort-link' . ($sort === $column ? ' admin-orders-index__sort-link--active' : '') . '">' . $label . ' ' . $icon . '</a>';
    }
@endphp
<th scope="col"
    class="admin-orders-index__th">
    {!! sort_link('Número de Pedido', 'id', $sort, $direction) !!}
</th>
<th scope="col"
    class="admin-orders-index__th">
    {!! sort_link('Cliente', 'name', $sort, $direction) !!}
</th>
<th scope="col"
    class="admin-orders-index__th">
    {!! sort_link('Total', 'total', $sort, $direction) !!}
</th>
<th scope="col"
    class="admin-orders-index__th">
    {!! sort_link('Estado', 'status', $sort, $direction) !!}
</th>
<th scope="col"
    class="admin-orders-index__th">
    {!! sort_link('Fecha', 'created_at', $sort, $direction) !!}
</th>
<th scope="col"
    class="admin-orders-index__th">
    Acciones
</th>
                                </tr>
                            </thead>
                            <tbody class="admin-orders-index__tbody">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="admin-orders-index__td">
                                            <div class="admin-orders-index__cell">
                                                #{{ $order->id }}
                                            </div>
                                        </td>
                                        <td class="admin-orders-index__td">
                                            <div class="admin-orders-index__cell">
                                                {{ $order->name }}
                                            </div>
                                            <div class="admin-orders-index__cell admin-orders-index__td--muted">
                                                {{ $order->email }}
                                            </div>
                                        </td>
                                        <td class="admin-orders-index__td">
                                            <div class="admin-orders-index__cell">
                                                ${{ number_format($order->total, 2) }}
                                            </div>
                                        </td>
                                        <td class="admin-orders-index__td">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-3">Ver detalles</a>
                                            <form action="{{ route('admin.orders.update-status', $order) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()"
                                                    class="text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <option value="pending"
                                                        {{ $order->status === 'pending' ? 'selected' : '' }}>Pendiente
                                                    </option>
                                                    <option value="processing"
                                                        {{ $order->status === 'processing' ? 'selected' : '' }}>En
                                                        proceso</option>
                                                    <option value="completed"
                                                        {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                        Completado</option>
                                                    <option value="cancelled"
                                                        {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                                        Cancelado</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
