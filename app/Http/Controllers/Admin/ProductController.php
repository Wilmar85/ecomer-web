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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        if (empty($validated['sku'])) {
            $validated['sku'] = 'SKU-' . time() . '-' . mt_rand(1000, 9999);
        }
        $validated['active'] = $request->input('active', 0);
        $product = Product::create($validated);
        $files = $request->file('images');
        if ($files) {
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('products', 'public');
                    $product->images()->create(['image_path' => $path]);
                }
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }
    public function edit(Product $product) {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }
    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        if (empty($validated['sku'])) {
            $validated['sku'] = 'SKU-' . time() . '-' . mt_rand(1000, 9999);
        }
        $validated['active'] = $request->input('active', 0);
        $product->update($validated);
        if ($request->hasFile('images')) {
            // Elimina imágenes anteriores y sus archivos
            foreach ($product->images as $img) {
                \Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('products', 'public');
                    $product->images()->create(['image_path' => $path]);
                }
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
