<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('store.cart', compact('cart','total'));
    }

    public function add(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);
        $qty = (int)($validated['quantity'] ?? 1);
        $cart = session('cart', []);
        $cartQuantity = ($cart[$product->id]['quantity'] ?? 0) + $qty;

        if ($cartQuantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => (float)$product->price,
            'quantity' => $cartQuantity,
            'image' => $product->image_url,
        ];

        session(['cart' => $cart]);
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer', 'min:0', 'max:99'],
        ]);
        $cart = session('cart', []);
        foreach ($validated['quantities'] as $id => $qty) {
            if (isset($cart[$id])) {
                if ($qty <= 0) unset($cart[$id]);
                else {
                    $product = Product::whereKey($id)->where('is_active', true)->first();
                    if (!$product || $qty > $product->stock) {
                        return back()->with('error', "Jumlah {$cart[$id]['name']} melebihi stok yang tersedia.");
                    }
                    $cart[$id]['quantity'] = $qty;
                    $cart[$id]['price'] = (float)$product->price;
                }
            }
        }
        session(['cart' => $cart]);
        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
