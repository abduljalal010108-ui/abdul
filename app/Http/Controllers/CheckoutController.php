<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);
        if (!$cart) return redirect()->route('cart')->with('error', 'Keranjang masih kosong.');

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        foreach ($cart as $id => &$item) {
            $product = $products->get($id);
            if (!$product || !$product->is_active) {
                return redirect()->route('cart')->with('error', "Menu {$item['name']} sudah tidak tersedia. Hapus dari keranjang untuk melanjutkan.");
            }
            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart')->with('error', "Stok {$product->name} tidak mencukupi. Perbarui jumlah di keranjang.");
            }
            $item['name'] = $product->name;
            $item['price'] = (float)$product->price;
            $item['image'] = $product->image_url;
        }
        unset($item);
        session(['cart' => $cart]);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('store.checkout', [
            'cart' => $cart,
            'total' => $total,
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
            'payment_method' => 'required|in:transfer,qris,cod',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);
        if (!$cart) return redirect()->route('cart')->with('error', 'Keranjang kosong.');

        $order = DB::transaction(function () use ($validated, $cart) {
            $total = 0;
            $products = [];
            foreach ($cart as $id => $item) {
                $product = Product::lockForUpdate()->find($id);
                if (!$product || !$product->is_active || $product->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok {$item['name']} tidak mencukupi. Perbarui keranjang sebelum memesan.",
                    ]);
                }
                $products[$id] = $product;
                $total += $product->price * $item['quantity'];
            }

            $order = Order::create([
                ...$validated,
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $item) {
                $product = $products[$id];
                $qty = $item['quantity'];
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty,
                    'subtotal' => $product->price * $qty,
                ]);
                $product->decrement('stock', $qty);
            }

            return $order;
        });

        session()->forget('cart');
        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat.');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);

        return view('store.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('items');
        return view('store.order', compact('order'));
    }
}
