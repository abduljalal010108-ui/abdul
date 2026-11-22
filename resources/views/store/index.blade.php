@extends('layouts.app')
@section('content')
<section class="hero {{ $promotion ? '' : 'hero-no-promo' }}">
    <div class="hero-content">
        <span class="eyebrow">Hangat, lezat, dari dapur kami</span>
        <h1>Rasa rumahan,<br>tinggal pesan.</h1>
        <p>Temukan menu favoritmu dan nikmati makanan enak tanpa ribet. Pilih, pesan, lalu kami siapantarkan dengan cepat.</p>
        <form class="hero-search" method="GET" action="{{ route('home') }}">
            <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari nasi goreng, ayam geprek..." aria-label="Cari makanan">
            <button class="btn" type="submit">Cari menu</button>
        </form>
        <div class="hero-stats">
            <div class="hero-stat">
                <strong>2.4k+</strong>
                <span>Pelanggan puas</span>
            </div>
            <div class="hero-stat">
                <strong>15 min</strong>
                <span>Pengiriman cepat</span>
            </div>
            <div class="hero-stat">
                <strong>4.9/5</strong>
                <span>Rating pelanggan</span>
            </div>
        </div>
    </div>
    @if($promotion)
    <div class="hero-visual">
        <div class="hero-card">
            <div class="hero-card-top">
                <span class="mini-badge">🔥 {{ $promotion->badge }}</span>
                <span class="small">Promo spesial</span>
            </div>
            <div class="hero-food">
                <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}">
            </div>
            <div class="food-meta">
                <div>
                    <strong>{{ $promotion->title }}</strong>
                    <span>{{ $promotion->description }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

<div class="feature-strip">
    <div class="feature-item">
        <div class="mini-icon">🥘</div>
        <h3>Menu autentik</h3>
        <p>Resep rumahan dengan rasa yang konsisten dan menggugah selera.</p>
    </div>
    <div class="feature-item">
        <div class="mini-icon">⚡</div>
        <h3>Pesan cepat</h3>
        <p>Proses checkout mudah, cepat, dan tanpa ribet untuk order harian.</p>
    </div>
    <div class="feature-item">
        <div class="mini-icon">📦</div>
        <h3>Delivery terjaga</h3>
        <p>Pengiriman tepat waktu dengan kualitas makanan tetap hangat.</p>
    </div>
</div>

<div class="section-heading">
    <div>
        <span class="eyebrow">Pilihan untukmu</span>
        <h2>Jelajahi menu</h2>
    </div>
</div>
<nav class="category-list" aria-label="Kategori makanan">
<a class="category-chip {{ request()->missing('category') ? 'active' : '' }}" href="{{ route('home', request()->only('q')) }}">Semua menu</a>
@foreach($categories as $category)<a class="category-chip {{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('home', array_merge(request()->only('q'), ['category'=>$category->slug])) }}">{{ $category->name }}</a>@endforeach
</nav>
<div class="grid">
@forelse($products as $product)
<article class="card product-card">
<img class="product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
<div class="cardbody">
<div class="small">{{ $product->category?->name ?? 'Menu RasaKita' }}</div><h3>{{ $product->name }}</h3><p>{{ Str::limit($product->description,70) }}</p>
<div class="between"><span class="price">Rp {{ number_format($product->price,0,',','.') }}</span><span class="small">{{ $product->stock > 0 ? 'Stok '.$product->stock : 'Habis' }}</span></div>
<div class="row" style="margin-top:14px">
<a class="btn light" href="{{ route('products.show',$product) }}">Detail</a>
<form method="POST" action="{{ route('cart.add',$product) }}">@csrf<button class="btn" type="submit" {{ $product->stock<1?'disabled':'' }}>+ Keranjang</button></form>
</div>
</div>
</article>
@empty<div class="card empty-state"><div class="empty-state-icon">🍽️</div><h3>Menu belum ditemukan</h3><p class="small">Coba kata kunci atau kategori lainnya.</p><a class="btn light" href="{{ route('home') }}">Lihat semua menu</a></div>@endforelse
</div>
<div class="pagination">{{ $products->links() }}</div>
@endsection