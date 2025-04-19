<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ingresos totales
        $totalRevenue = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)->sum('total');

        // Ventas por producto (top 10)
        $salesByProduct = \App\Models\OrderItem::selectRaw('product_id, SUM(quantity) as total')
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Ventas por región/país (usando shipping_state como región y shipping_country si existe)
        $salesByRegion = \App\Models\Order::selectRaw('shipping_state as region, COUNT(*) as total')
            ->where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)
            ->groupBy('shipping_state')
            ->orderByDesc('total')
            ->get();
        // Si tienes shipping_country, puedes agrupar también por ese campo

        // Valor promedio del pedido (AOV)
        $averageOrderValue = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)->avg('total');

        // Tasa de conversión = pedidos pagados / carritos únicos (usuarios o sesiones)
        $paidOrdersCount = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)->count();
        $uniqueCartsCount = \App\Models\Cart::distinct('session_id')->count('session_id');
        $conversionRate = $uniqueCartsCount > 0 ? round($paidOrdersCount / $uniqueCartsCount * 100, 2) : null;

        // Tasa de abandono del carrito = (carritos con al menos un ítem y sin pedido pagado) / carritos con al menos un ítem
        $cartsWithItems = \App\Models\Cart::has('items')->count();
        $cartsWithOrder = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)
            ->distinct('user_id')->count('user_id');
        $cartAbandonmentRate = $cartsWithItems > 0 ? round((($cartsWithItems - $cartsWithOrder) / $cartsWithItems) * 100, 2) : null;

        // Número total de clientes
        $totalCustomers = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)->count();

        // Nuevos clientes (últimos 30 días)
        $newCustomers = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        // Clientes recurrentes: han realizado más de un pedido pagado
        $recurrentCustomers = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->whereHas('orders', function($q) {
                $q->where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID);
            }, '>', 1)
            ->count();

        // Datos demográficos (por ciudad y estado, top 5)
        $demographicsByCity = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->selectRaw('city, COUNT(*) as total')
            ->groupBy('city')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        $demographicsByState = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->selectRaw('state, COUNT(*) as total')
            ->groupBy('state')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // CLTV (Customer Lifetime Value): promedio de ingresos por cliente
        $cltv = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)
            ->selectRaw('AVG(total) as avg_order, COUNT(DISTINCT user_id) as user_count, SUM(total) as total_revenue')
            ->first();
        $customerLifetimeValue = ($cltv->user_count ?? 0) > 0 ? round($cltv->total_revenue / $cltv->user_count, 2) : 0;

        // Tasa de retención: clientes con más de un pedido pagado / total clientes con al menos un pedido pagado
        $customersWithOrders = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->whereHas('orders', function($q) {
                $q->where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID);
            })
            ->count();
        $retainedCustomers = \App\Models\User::where('role', \App\Models\User::ROLE_CUSTOMER)
            ->whereHas('orders', function($q) {
                $q->where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID);
            }, '>', 1)
            ->count();
        $retentionRate = $customersWithOrders > 0 ? round($retainedCustomers / $customersWithOrders * 100, 2) : null;

        // Tasa de adquisición: nuevos clientes / total clientes (últimos 30 días)
        $acquisitionRate = $totalCustomers > 0 ? round($newCustomers / $totalCustomers * 100, 2) : null;

        return view('admin.dashboard', compact(
            'totalRevenue',
            'salesByProduct',
            'salesByRegion',
            'averageOrderValue',
            'conversionRate',
            'cartAbandonmentRate',
            'totalCustomers',
            'newCustomers',
            'recurrentCustomers',
            'demographicsByCity',
            'demographicsByState',
            'customerLifetimeValue',
            'retentionRate',
            'acquisitionRate'
        ));
    }
}
