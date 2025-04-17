<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pedidos activos: status = processing o shipped
        $activeOrders = \App\Models\Order::whereIn('status', [
            \App\Models\Order::STATUS_PROCESSING,
            \App\Models\Order::STATUS_SHIPPED
        ])->count();

        // Pedidos pendientes: status = pending
        $pendingOrders = \App\Models\Order::where('status', \App\Models\Order::STATUS_PENDING)->count();

        // Ventas del mes (total pagado este mes)
        $monthlySales = \App\Models\Order::where('payment_status', \App\Models\Order::PAYMENT_STATUS_PAID)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Productos sin stock
        $outOfStockProducts = \App\Models\Product::where('stock', '<=', 0)->count();

        return view('admin.dashboard', compact('activeOrders', 'pendingOrders', 'monthlySales', 'outOfStockProducts'));
    }
}
