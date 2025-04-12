<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Para la página de inicio, obtener los últimos productos sin paginación
        $products = Product::with('images')
            ->latest()
            ->take(8)
            ->get();
            
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();

        return view('home', compact('products', 'categories'));
    }
}