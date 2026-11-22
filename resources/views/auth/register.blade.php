@extends('layouts.app')
@section('content')
<section class="auth-card">
    <div class="auth-icon">🍽️</div>
    <p class="eyebrow">GABUNG BERSAMA RASAKITA</p>
    <h1>Buat akun pelanggan</h1>
    <p class="auth-description">Daftar gratis, pilih menu favorit, lalu pesan dengan mudah.</p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama lengkap</label>
            <input class="input" id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" placeholder="Nama kamu" required autofocus>
        </div>
        <div class="form-group">
            <label for="email">Alamat email</label>
            <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" placeholder="nama@email.com" required>
        </div>
        <div class="form-group">
            <label for="password">Kata sandi</label>
            <input class="input" id="password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 8 karakter" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Ulangi kata sandi</label>
            <input class="input" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ketik ulang kata sandi" required>
        </div>
        <button class="btn auth-submit" type="submit">Buat akun &amp; mulai belanja</button>
    </form>

    <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    <a class="back-link" href="{{ route('home') }}">← Kembali ke beranda</a>
</section>
@endsection
