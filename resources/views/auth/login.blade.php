@extends('layouts.app')
@section('content')
<section class="auth-card">
    <div class="auth-icon">👋</div>
    <p class="eyebrow">SENANG MELIHATMU KEMBALI</p>
    <h1>Masuk ke akunmu</h1>
    <p class="auth-description">Masuk untuk melanjutkan pesanan dan menikmati makanan favoritmu.</p>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="form-group">
            <label for="email">Alamat email</label>
            <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" placeholder="nama@email.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Kata sandi</label>
            <input class="input" id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi" required>
        </div>
        <label class="remember-option"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button class="btn auth-submit" type="submit">Masuk ke akun</button>
    </form>

    <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    <a class="back-link" href="{{ route('home') }}">← Kembali ke beranda</a>
</section>
@endsection
