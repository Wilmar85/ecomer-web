<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('images')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();

        return view('welcome', compact('products', 'categories'));
    }
}