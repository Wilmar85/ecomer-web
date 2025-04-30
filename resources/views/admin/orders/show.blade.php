<x-app-layout>
    <x-slot name="header">
        <div class="admin-orders-show__header">
            <h2 class="admin-orders-show__title">
                {{ __('Detalles del Pedido #') . $order->id }}
            </h2>
            <a href="{{ route('admin.orders.index') }}"
                class="admin-orders-show__back-btn">
                Volver a Pedidos
            </a>
        </div>
    </x-slot>

    <div class="admin-orders-show__section">
        <div class="admin-orders-show__container">
            <div class="admin-orders-show__card">
                <div class="admin-orders-show__content">
                    <div class="admin-orders-show__grid">
                        <!-- Comprobante de Pago -->
                        @if($order->payment_proof)
                        <div class="admin-orders-show__subcard">
                            <h3 class="admin-orders-show__subtitle">Comprobante de Pago</h3>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Comprobante de pago" class="admin-orders-show__img">
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="admin-orders-show__img-link">Ver tamaño completo</a>
                        </div>
                        @endif
                        <!-- Información del Cliente -->
                        <div class="admin-orders-show__subcard">
                            <h3 class="admin-orders-show__subtitle">Información del Cliente</h3>
                            <dl class="admin-orders-show__dl">
                                <div>
                                    <dt class="admin-orders-show__dt">Nombre</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->name }}</dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Email</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->email }}</dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Teléfono</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->phone }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Información de Envío -->
                        <div class="admin-orders-show__subcard">
                            <h3 class="admin-orders-show__subtitle">Información de Envío</h3>
                            <dl class="admin-orders-show__dl">
                                <div>
                                    <dt class="admin-orders-show__dt">Dirección</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->address }}</dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Ciudad</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->city }}</dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Código Postal</dt>
                                    <dd class="admin-orders-show__dd">{{ $order->postal_code }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Estado del Pedido -->
                        <div class="admin-orders-show__subcard">
                            <h3 class="admin-orders-show__subtitle">Estado del Pedido</h3>
                            <dl class="admin-orders-show__dl">
                                <div>
                                    <dt class="admin-orders-show__dt">Estado Actual</dt>
                                    <dd class="admin-orders-show__dd">
                                        <span
                                            class="admin-orders-show__status admin-orders-show__status--{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Método de Pago</dt>
                                    <dd class="admin-orders-show__dd">{{ ucfirst($order->payment_method) }}</dd>
                                </div>
                                <div>
                                    <dt class="admin-orders-show__dt">Fecha del Pedido</dt>
                                    <dd class="admin-orders-show__dd">
                                        {{ $order->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Actualizar Estado -->
                        <div class="admin-orders-show__subcard">
                            <h3 class="admin-orders-show__subtitle">Actualizar Estado</h3>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST"
                                class="admin-orders-show__form">
                                @csrf
                                
                                <div>
                                    <label for="status" class="admin-orders-show__label">Nuevo
                                        Estado</label>
                                    <select name="status" id="status"
                                        class="admin-orders-show__input">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                            Pendiente</option>
                                        <option value="processing"
                                            {{ $order->status === 'processing' ? 'selected' : '' }}>En proceso</option>
                                        <option value="completed"
                                            {{ $order->status === 'completed' ? 'selected' : '' }}>Completado</option>
                                        <option value="cancelled"
                                            {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                </div>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Actualizar Estado
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Productos del Pedido -->
                    <div class="admin-orders-show__products-section">
                        <h3 class="admin-orders-show__subtitle">Productos del Pedido</h3>
                        <div class="admin-orders-show__table-scroll">
                            <table class="admin-orders-show__table">
                                <thead class="admin-orders-show__thead">
                                    <tr>
                                        <th scope="col"
                                            class="admin-orders-show__th">
                                            Producto</th>
                                        <th scope="col"
                                            class="admin-orders-show__th">
                                            Cantidad</th>
                                        <th scope="col"
                                            class="admin-orders-show__th">
                                            Precio Unitario</th>
                                        <th scope="col"
                                            class="admin-orders-show__th">
                                            Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="admin-orders-show__tbody">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="admin-orders-show__td">
                                                <div class="admin-orders-show__product-row">
                                                    @if ($item->product->images->isNotEmpty())
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->path) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="admin-orders-show__product-img">
                                                    @endif
                                                    <div class="admin-orders-show__cell">
                                                        {{ $item->product->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="admin-orders-show__td admin-orders-show__td--muted">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="admin-orders-show__td admin-orders-show__td--muted">
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="admin-orders-show__td admin-orders-show__td--muted">
                                                ${{ number_format($item->subtotal, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="admin-orders-show__tfoot">
                                    <tr>
                                        <td colspan="3" class="admin-orders-show__td">Total:</td>
                                        <td class="admin-orders-show__td">${{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
