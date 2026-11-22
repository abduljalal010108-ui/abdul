@extends('layouts.app')
@section('content')
<div class="section-heading"><div><span class="eyebrow">AKUN PELANGGAN</span><h1>Pesanan saya</h1><p>Lihat kembali pesanan yang pernah kamu buat.</p></div><a class="btn" href="{{ route('home') }}">Pesan makanan</a></div>
@forelse($orders as $order)
<article class="card order-card">
    <div class="between">
        <div>
            <span class="small">Pesanan #{{ $order->id }} · {{ $order->created_at->format('d M Y, H:i') }}</span>
            <h3 style="margin:5px 0">{{ $order->items->pluck('product_name')->join(', ') }}</h3>
        </div>
        <span class="category-chip">{{ ucfirst($order->status) }}</span>
    </div>
    <div class="between" style="margin-top:14px">
        <strong class="price">Rp {{ number_format($order->total_amount,0,',','.') }}</strong>
        <a class="btn light" href="{{ route('orders.show', $order) }}">Lihat detail</a>
    </div>
</article>
@empty
<div class="card empty-state"><div class="empty-state-icon">📋</div><h2>Belum ada pesanan</h2><p class="small">Menu favoritmu sudah menunggu untuk dicoba.</p><a class="btn" href="{{ route('home') }}">Mulai pesan</a></div>
@endforelse
<div class="pagination">{{ $orders->links() }}</div>
@endsection
