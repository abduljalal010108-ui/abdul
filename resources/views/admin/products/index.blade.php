@extends('layouts.app')
@section('content')
<div class="page-shell">
    <div class="page-header">
        <h1>Produk</h1>
        <div class="page-actions">
            <a class="btn" href="{{ route('admin.products.create') }}">+ Tambah Produk</a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="table">
                <tr><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
                @foreach($products as $p)
                    <tr><td><img src="{{ $p->image_url }}" style="width:60px;height:45px;object-fit:cover;border-radius:8px"></td><td>{{ $p->name }}</td><td>{{ $p->category?->name }}</td><td>Rp {{ number_format($p->price,0,',','.') }}</td><td>{{ $p->stock }}</td><td class="row"><a class="btn light" href="{{ route('admin.products.edit',$p) }}">Edit</a><form method="POST" action="{{ route('admin.products.destroy',$p) }}">@csrf @method('DELETE')<button class="btn danger" onclick="return confirm('Hapus produk?')">Hapus</button></form></td></tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="pagination">{{ $products->links() }}</div>
</div>
@endsection