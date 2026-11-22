<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }
        $data['slug'] = Str::slug($data['name']).'-'.uniqid();
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            if ($product->image && !Str::startsWith($product->image, ['http://','https://'])) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products','public');
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && !Str::startsWith($product->image, ['http://','https://'])) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return back()->with('success','Produk berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
