@extends('layouts.app')
@section('content')
<div class="section-heading"><div><span class="eyebrow">LANGKAH TERAKHIR</span><h1>Konfirmasi pesanan</h1><p>Pastikan detail pesanan dan alamat pengantaran sudah benar.</p></div></div>
<div class="checkout-grid">
<div class="card cardbody"><h2>Data pengantaran</h2>
<form method="POST" action="{{ route('checkout.store') }}">@csrf
<div class="form-group"><label for="customer_name">Nama penerima</label><input class="input" id="customer_name" name="customer_name" value="{{ old('customer_name', $user->name) }}" autocomplete="name" required></div>
<div class="form-group"><label for="customer_phone">Nomor telepon</label><input class="input" id="customer_phone" name="customer_phone" type="tel" value="{{ old('customer_phone') }}" autocomplete="tel" placeholder="08xxxxxxxxxx" required></div>
<div class="form-group"><label for="customer_address">Alamat lengkap</label><textarea class="input" id="customer_address" name="customer_address" rows="4" autocomplete="street-address" placeholder="Nama jalan, nomor rumah, kecamatan..." required>{{ old('customer_address') }}</textarea></div>
<div class="form-group"><label for="payment_method">Metode pembayaran</label><select class="input" id="payment_method" name="payment_method" required>
<option value="transfer" @selected(old('payment_method') === 'transfer')>Transfer bank</option>
<option value="qris" @selected(old('payment_method') === 'qris')>QRIS (simulasi)</option>
<option value="cod" @selected(old('payment_method') === 'cod')>Bayar di tempat (COD)</option>
</select></div>
<div class="form-group"><label for="notes">Catatan untuk penjual <span class="small">(opsional)</span></label><textarea class="input" id="notes" name="notes" rows="3" placeholder="Contoh: tidak pedas">{{ old('notes') }}</textarea></div>
<button class="btn" type="submit">Buat pesanan · Rp {{ number_format($total,0,',','.') }}</button>
</form></div>
<aside class="card cardbody checkout-summary"><h2>Ringkasan pesanan</h2>
@foreach($cart as $item)<div class="between" style="padding:11px 0;border-bottom:1px solid #eee8df"><span>{{ $item['name'] }} <span class="small">× {{ $item['quantity'] }}</span></span><strong>Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</strong></div>@endforeach
<div class="between" style="padding-top:18px"><strong>Total</strong><strong class="price">Rp {{ number_format($total,0,',','.') }}</strong></div>
<p class="small">Pembayaran di website ini masih berupa simulasi. Total akan dikonfirmasi kembali sebelum pesanan diproses.</p>
<a class="btn light" href="{{ route('cart') }}">Kembali ke keranjang</a>
</aside>
</div>
@endsection