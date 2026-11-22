@extends('layouts.app')
@section('content')
<div class="card product-detail" style="display:grid;grid-template-columns:1fr 1fr;overflow:hidden">
<img class="product-image" src="{{ $product->image_url }}" style="height:100%;min-height:360px" alt="{{ $product->name }}">
<div class="cardbody" style="padding:clamp(22px,4vw,44px)"><div class="small">{{ $product->category?->name }}</div><h1 style="font-family:Georgia,serif;font-size:36px;line-height:1.15">{{ $product->name }}</h1><p style="color:#746c60">{{ $product->description }}</p><p class="price" style="font-size:25px">Rp {{ number_format($product->price,0,',','.') }}</p><p class="small">Stok tersedia: {{ $product->stock }}</p>
<form method="POST" action="{{ route('cart.add',$product) }}" class="row">@csrf<input class="input" style="width:100px" type="number" name="quantity" value="1" min="1" max="{{ max(1,min(99,$product->stock)) }}" aria-label="Jumlah pesanan"><button class="btn" type="submit" {{ $product->stock<1?'disabled':'' }}>Tambah ke keranjang</button></form></div>
</div>
@endsection