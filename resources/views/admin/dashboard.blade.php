@extends('layouts.app')
@section('content')
<div class="page-shell">
    <div class="page-header">
        <h1>Dashboard Admin</h1>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><div class="small">Produk</div><h2>{{ $stats['products'] }}</h2></div>
        <div class="stat-card"><div class="small">Kategori</div><h2>{{ $stats['categories'] }}</h2></div>
        <div class="stat-card"><div class="small">Pesanan</div><h2>{{ $stats['orders'] }}</h2></div>
        <div class="stat-card"><div class="small">Pendapatan Dibayar</div><h2>Rp {{ number_format($stats['revenue'],0,',','.') }}</h2></div>
    </div>

    <div class="section-heading" style="margin-top:8px; margin-bottom:12px;">
        <div>
            <span class="eyebrow">Aktivitas</span>
            <h2>Pesanan Terbaru</h2>
        </div>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="table">
                <tr><th>#</th><th>Pelanggan</th><th>Total</th><th>Status</th><th></th></tr>
                @foreach($latestOrders as $o)
                    <tr><td>{{ $o->id }}</td><td>{{ $o->customer_name }}</td><td>Rp {{ number_format($o->total_amount,0,',','.') }}</td><td>{{ $o->status }}</td><td><a class="btn light" href="{{ route('admin.orders.show',$o) }}">Detail</a></td></tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection