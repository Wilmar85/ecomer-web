<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images');

        // Filtro por nombre
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtro por precio mínimo
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Filtro por precio máximo
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Get paginated products for shop page
        if (!request()->routeIs('welcome')) {
            $products = $query->latest()->paginate(12);
            $categories = Category::withCount('products')
                ->having('products_count', '>', 0)
                ->get();
            return view('shop.index', compact('products', 'categories'));
        }

        // For welcome page, get latest products without pagination
        $products = $query->latest()->take(8)->get();
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();
        return view('welcome', compact('products', 'categories'));
    }
}