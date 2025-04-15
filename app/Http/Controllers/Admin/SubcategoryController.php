<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index() {
        $subcategories = Subcategory::with('category')->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }
    public function create() {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        Subcategory::create($request->only('name', 'category_id'));
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategoría creada correctamente.');
    }
    public function edit(Subcategory $subcategory) {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }
    public function update(Request $request, Subcategory $subcategory) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        $subcategory->update($request->only('name', 'category_id'));
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategoría actualizada correctamente.');
    }
    public function destroy(Subcategory $subcategory) {
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategoría eliminada correctamente.');
    }
}
