@extends('layouts.app')
@section('content')
<div class="page-shell">
    <div class="page-header">
        <div>
            <h1>Promosi Harian</h1>
            <p class="small">Atur promo yang tampil di halaman utama toko.</p>
        </div>
    </div>

    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.promotions.update') }}" class="panel" style="padding:22px">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="badge">Label promo</label>
            <input class="input" id="badge" name="badge" value="{{ old('badge', $promotion->badge) }}" placeholder="Contoh: Promo hari ini" required>
        </div>

        <div class="form-group">
            <label for="title">Judul promo</label>
            <input class="input" id="title" name="title" value="{{ old('title', $promotion->title) }}" placeholder="Contoh: Gratis ongkir untuk semua pesanan" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="input" id="description" name="description" rows="3" placeholder="Tulis detail atau syarat promo">{{ old('description', $promotion->description) }}</textarea>
        </div>

        <div class="row">
            <div class="form-group" style="flex:1;min-width:220px">
                <label for="starts_on">Mulai ditampilkan</label>
                <input class="input" id="starts_on" type="date" name="starts_on" value="{{ old('starts_on', $promotion->starts_on?->format('Y-m-d')) }}">
            </div>
            <div class="form-group" style="flex:1;min-width:220px">
                <label for="ends_on">Terakhir ditampilkan</label>
                <input class="input" id="ends_on" type="date" name="ends_on" value="{{ old('ends_on', $promotion->ends_on?->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="image">Foto promosi (opsional, maks. 4MB)</label>
            <input class="input" id="image" type="file" name="image" accept="image/*">
        </div>
        @if($promotion->exists)
            <p><img src="{{ $promotion->image_url }}" alt="Foto promosi saat ini" style="width:min(100%,320px);height:190px;object-fit:cover;border-radius:14px"></p>
        @endif

        <label class="remember-option">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $promotion->is_active))>
            Tampilkan promosi di halaman utama
        </label>

        <button class="btn" type="submit">Simpan Promosi</button>
    </form>
</div>
@endsection
