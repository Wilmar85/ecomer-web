<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="orders-index__header">Mis Pedidos</h2>

                    @if($orders->isEmpty())
                        <div class="orders-index__empty">
                            <p class="orders-index__empty-text">No tienes pedidos realizados aún.</p>
                            <a href="{{ route('shop.index') }}" class="orders-index__btn">
                                Ir a la tienda
                            </a>
                        </div>
                    @else
                        <div class="orders-index__table-container">
                            <table class="orders-index__table">
                                <thead class="orders-index__thead">
                                    <tr>
                                        <th scope="col" class="orders-index__th">Número de Orden</th>
                                        <th scope="col" class="orders-index__th">Fecha</th>
                                        <th scope="col" class="orders-index__th">Total</th>
                                        <th scope="col" class="orders-index__th">Estado</th>
                                        <th scope="col" class="orders-index__th">Método de Pago</th>
                                        <th scope="col" class="orders-index__th">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="orders-index__tbody">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="orders-index__td orders-index__td--main">
                                                {{ $order->order_number }}
                                            </td>
                                            <td class="orders-index__td">
                                                {{ $order->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="orders-index__td">
                                                ${{ number_format($order->total, 2) }}
                                            </td>
                                            <td class="orders-index__td">
                                                <span class="orders-index__status orders-index__status--{{ $order->status }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="orders-index__td">
                                                {{ ucfirst($order->payment_method) }}
                                            </td>
                                            <td class="orders-index__td">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('orders.show', $order) }}" class="orders-index__details">Ver detalles</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="orders-index__pagination">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>