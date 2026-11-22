@extends('layouts.app')
@section('content')
<h1>{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h1>
<form method="POST" enctype="multipart/form-data" action="{{ isset($product) ? route('admin.products.update',$product) : route('admin.products.store') }}" class="card cardbody">
@csrf @if(isset($product)) @method('PUT') @endif
<div class="form-group"><label>Nama</label><input class="input" name="name" value="{{ old('name',$product->name??'') }}" required></div>
<div class="form-group"><label>Kategori</label><select class="input" name="category_id" required>@foreach($categories as $c)<option value="{{ $c->id }}" @selected(old('category_id',$product->category_id??'')==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="form-group"><label>Deskripsi</label><textarea class="input" name="description" rows="4">{{ old('description',$product->description??'') }}</textarea></div>
<div class="row"><div style="flex:1"><label>Harga</label><input class="input" type="number" name="price" value="{{ old('price',$product->price??0) }}" min="0" required></div><div style="flex:1"><label>Stok</label><input class="input" type="number" name="stock" value="{{ old('stock',$product->stock??0) }}" min="0" required></div></div><br>
<div class="form-group"><label>Gambar (maks. 2MB)</label><input class="input" type="file" name="image" accept="image/*"></div>
@if(isset($product))<p><img src="{{ $product->image_url }}" style="width:120px;height:90px;object-fit:cover"></p>@endif
<label><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$product->is_active??true))> Aktif</label><br><br>
<button class="btn">Simpan</button> <a class="btn light" href="{{ route('admin.products.index') }}">Batal</a>
</form>
@endsection