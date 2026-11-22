@extends('layouts.app')
@section('content')
<div class="page-shell">
    <div class="page-header">
        <h1>Kategori</h1>
    </div>

    <div class="panel" style="padding:18px; margin-bottom:18px;">
        <div class="section-heading" style="margin-bottom:12px;">
            <div>
                <span class="eyebrow">Kelola</span>
                <h2>Tambah Kategori</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="row">@csrf<input class="input" name="name" placeholder="Nama kategori" required><input class="input" name="description" placeholder="Deskripsi"><button class="btn">Tambah</button></form>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="table">
                <tr><th>Nama</th><th>Produk</th><th>Aksi</th></tr>
                @foreach($categories as $c)
                    <tr><td>{{ $c->name }}</td><td>{{ $c->products_count }}</td><td class="row"><details><summary>Edit</summary><form method="POST" action="{{ route('admin.categories.update',$c) }}">@csrf @method('PUT')<input class="input" name="name" value="{{ $c->name }}"><input class="input" name="description" value="{{ $c->description }}"><button class="btn">Simpan</button></form></details><form method="POST" action="{{ route('admin.categories.destroy',$c) }}">@csrf @method('DELETE')<button class="btn danger">Hapus</button></form></td></tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection