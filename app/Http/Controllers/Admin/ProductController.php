<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with(['category', 'subcategory'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    public function create() {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.products.create', compact('categories', 'subcategories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        Product::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }
    public function edit(Product $product) {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }
    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
