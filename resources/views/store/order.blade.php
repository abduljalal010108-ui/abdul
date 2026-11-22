@extends('layouts.app')
@section('content')
<div class="section-heading"><div><span class="eyebrow">TERIMA KASIH SUDAH MEMESAN</span><h1>Pesanan #{{ $order->id }}</h1><p>Pesananmu sudah tercatat. Simpan nomor ini untuk referensi.</p></div><a class="btn light" href="{{ route('orders.index') }}">Riwayat pesanan</a></div>
<div class="card cardbody">
<div class="between"><h2>Status pesanan</h2><span class="category-chip active">{{ ucfirst($order->status) }}</span></div>
<p class="small">Pembayaran: <strong>{{ strtoupper($order->payment_status) }}</strong> · {{ strtoupper($order->payment_method) }}</p>
<hr style="border:0;border-top:1px solid #eee8df;margin:22px 0">
<h3>Rincian menu</h3>
@foreach($order->items as $item)<div class="between" style="padding:11px 0;border-bottom:1px solid #eee8df"><span>{{ $item->product_name }} × {{ $item->quantity }}</span><strong>Rp {{ number_format($item->subtotal,0,',','.') }}</strong></div>@endforeach
<div class="between" style="padding-top:18px"><strong>Total pesanan</strong><strong class="price">Rp {{ number_format($order->total_amount,0,',','.') }}</strong></div>
<p class="small">Dikirim ke: {{ $order->customer_address }} · {{ $order->customer_phone }}</p>
</div>
@endsection