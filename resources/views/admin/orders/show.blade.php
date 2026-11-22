@extends('layouts.app')
@section('content')
<h1>Pesanan #{{ $order->id }}</h1>
<div class="card cardbody"><p><b>{{ $order->customer_name }}</b> — {{ $order->customer_phone }}</p><p>{{ $order->customer_address }}</p><h3>Item</h3>@foreach($order->items as $item)<p>{{ $item->product_name }} × {{ $item->quantity }} = Rp {{ number_format($item->subtotal,0,',','.') }}</p>@endforeach<h2 class="price">Total Rp {{ number_format($order->total_amount,0,',','.') }}</h2>
<form method="POST" action="{{ route('admin.orders.update',$order) }}" class="row">@csrf @method('PATCH')
<select class="input" style="max-width:220px" name="payment_status">@foreach(['pending','paid','failed'] as $s)<option value="{{ $s }}" @selected($order->payment_status==$s)>{{ ucfirst($s) }}</option>@endforeach</select>
<select class="input" style="max-width:220px" name="status">@foreach(['pending','processing','shipped','completed','cancelled'] as $s)<option value="{{ $s }}" @selected($order->status==$s)>{{ ucfirst($s) }}</option>@endforeach</select><button class="btn">Simpan Status</button>
<p class="small" style="flex-basis:100%;margin:0">Jika status pesanan diubah menjadi Completed, pembayaran otomatis ditandai Paid dan dihitung sebagai pendapatan.</p>
</form>
</div>
@endsection