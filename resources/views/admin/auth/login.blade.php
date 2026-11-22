@extends('layouts.app')
@section('content')
<section class="auth-card">
    <span class="auth-icon" aria-hidden="true">🔐</span>
    <p class="eyebrow">AREA KHUSUS ADMIN</p>
    <h1>Masuk Admin</h1>
    <p class="auth-description">Halaman ini khusus untuk mengelola toko. Akun pelanggan tidak dapat digunakan di sini.</p>

    <div class="alert" style="margin-bottom:20px">
        <strong>Akun demo</strong><br>
        Email: admin@rasakita.test<br>
        Kata sandi: password
    </div>

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email admin</label>
            <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Kata sandi</label>
            <input class="input" id="password" name="password" type="password" autocomplete="current-password" required>
        </div>
        <label class="remember-option"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button class="btn auth-submit" type="submit">Masuk ke dashboard admin</button>
    </form>
</section>
@endsection