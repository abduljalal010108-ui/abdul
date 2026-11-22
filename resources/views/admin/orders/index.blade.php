@extends('layouts.app')
@section('content')
<div class="page-shell">
    <div class="page-header">
        <h1>Pesanan</h1>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="table">
                <tr><th>#</th><th>Pelanggan</th><th>Total</th><th>Pembayaran</th><th>Status</th><th></th></tr>
                @foreach($orders as $o)
                    <tr><td>{{ $o->id }}</td><td>{{ $o->customer_name }}<br><span class="small">{{ $o->customer_phone }}</span></td><td>Rp {{ number_format($o->total_amount,0,',','.') }}</td><td>{{ $o->payment_method }} / {{ $o->payment_status }}</td><td>{{ $o->status }}</td><td><a class="btn light" href="{{ route('admin.orders.show',$o) }}">Kelola</a></td></tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="pagination">{{ $orders->links() }}</div>
</div>
@endsection