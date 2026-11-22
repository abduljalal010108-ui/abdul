@extends('layouts.app')
@section('content')
<div class="section-heading"><div><span class="eyebrow">SIAP DINIKMATI</span><h1>Keranjang belanja</h1><p>Periksa menu pilihanmu sebelum melanjutkan ke checkout.</p></div></div>
@if(!$cart)<div class="card empty-state"><div class="empty-state-icon">🛒</div><h2>Keranjangmu masih kosong</h2><p class="small">Yuk, pilih menu favorit dan pesan sekarang.</p><a class="btn" href="{{ route('home') }}">Jelajahi menu</a></div>
@else
<form method="POST" action="{{ route('cart.update') }}">@csrf
<div class="table-wrap"><table class="table"><thead><tr><th>Menu</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr></thead><tbody>
@foreach($cart as $id=>$item)<tr><td><strong>{{ $item['name'] }}</strong></td><td>Rp {{ number_format($item['price'],0,',','.') }}</td><td><input class="input" style="width:86px" type="number" name="quantities[{{ $id }}]" value="{{ $item['quantity'] }}" min="0" max="99" aria-label="Jumlah {{ $item['name'] }}"></td><td>Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</td><td><button form="remove-{{ $id }}" type="submit" class="btn danger">Hapus</button></td></tr>@endforeach
</tbody></table></div>
<div class="between" style="margin-top:20px"><button class="btn light" type="submit">Perbarui jumlah</button><strong class="price">Total: Rp {{ number_format($total,0,',','.') }}</strong><a class="btn" href="{{ route('checkout') }}">Lanjut checkout</a></div>
</form>
@foreach($cart as $id=>$item)<form id="remove-{{ $id }}" method="POST" action="{{ route('cart.remove',$id) }}">@csrf @method('DELETE')</form>@endforeach
@endif
@endsection