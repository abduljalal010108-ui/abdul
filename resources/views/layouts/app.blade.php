<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'RasaKita' }}</title>
<meta name="theme-color" content="#fbf7f0">
<style>
:root{
    --bg:#fffaf6;
    --bg-soft:#fff1e4;
    --panel:#fffdfb;
    --panel-strong:#fff7ef;
    --card:#ffffff;
    --line:#f1e3d2;
    --text:#1f1c1a;
    --muted:#6f625a;
    --primary:#d75d2a;
    --primary-dark:#b7481e;
    --gold:#ffbf69;
    --success:#1d8d5f;
    --shadow:0 18px 50px rgba(69,34,17,0.12);
}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif;background:radial-gradient(circle at top,#fffaf4 0%,#fff3e6 38%,#fffaf7 100%);color:var(--text);line-height:1.55}a{text-decoration:none;color:inherit}button,input,select,textarea{font:inherit}
.nav{background:rgba(255,255,255,.86);backdrop-filter:blur(14px);border-bottom:1px solid rgba(218,183,151,.45);padding:14px max(4%,calc((100% - 1220px)/2));display:flex;justify-content:space-between;align-items:center;gap:22px;position:sticky;top:0;z-index:50;box-shadow:0 10px 30px rgba(65,35,17,.04)}
.brand{display:inline-flex;align-items:center;gap:10px;font-size:24px;font-weight:900;color:var(--primary);letter-spacing:-.8px;white-space:nowrap}.brand-mark{display:grid;place-items:center;width:38px;height:38px;border-radius:14px;background:linear-gradient(135deg,#ffbf74 0%,#f58a43 30%,#dd5429 100%);box-shadow:0 14px 26px rgba(221,84,41,.25);overflow:hidden;position:relative}.brand-mark::before,.brand-mark::after{content:"";position:absolute;border-radius:999px}.brand-mark::before{width:22px;height:14px;border:3px solid rgba(255,255,255,.9);border-bottom:0;top:10px;left:8px;transform:rotate(-10deg)}.brand-mark::after{width:18px;height:18px;border-radius:50%;border:3px solid rgba(255,255,255,.9);bottom:8px;right:7px;box-shadow:-10px -2px 0 -5px rgba(255,255,255,.7)}.brand-word{display:inline-block;line-height:1}.navlinks{display:flex;gap:14px;align-items:center;flex-wrap:wrap}.navlinks>a:not(.brand){font-size:14px;font-weight:700;color:#4e463f;padding:8px 10px;border-radius:10px;transition:.2s ease}.navlinks>a:not(.brand):hover{color:var(--primary);background:rgba(215,93,42,.06)}.nav-user{display:inline-flex;align-items:center;padding:8px 12px;border:1px solid var(--line);border-radius:999px;background:#fffaf5;color:#524a43;font-size:13px;font-weight:700}.nav .btn,.btn{display:inline-flex;justify-content:center;align-items:center;gap:8px;border:0;border-radius:12px;padding:11px 18px;background:linear-gradient(135deg,var(--primary),#ef7a3b);color:#fff;cursor:pointer;font-weight:800;transition:transform .15s ease,box-shadow .15s ease,filter .15s ease;box-shadow:0 10px 22px rgba(215,93,42,.22)}.btn:hover{transform:translateY(-1px);filter:brightness(1.02)}.btn:disabled{opacity:.55;cursor:not-allowed;transform:none;box-shadow:none}.btn.secondary{background:#2f2c2a}.btn.danger{background:linear-gradient(135deg,#e95454,#bb3a2d)}.btn.light{background:#f2eadf;color:#4d453f}.btn.light:hover{background:#e6ddcf}
.container{width:min(1220px,92%);margin:34px auto 60px;min-height:58vh}.hero{display:grid;grid-template-columns:1.2fr .8fr;gap:28px;background:linear-gradient(135deg,#fff5e9 0%,#fde7d1 40%,#f6d7b8 100%);border:1px solid rgba(224,178,131,.6);border-radius:30px;padding:clamp(26px,4vw,54px);margin-bottom:32px;position:relative;overflow:hidden;box-shadow:var(--shadow)}.hero-no-promo{grid-template-columns:1fr}.hero:before{content:"";position:absolute;inset:auto -80px -60px auto;width:260px;height:260px;border-radius:50%;background:rgba(255,255,255,.36)}.hero:after{content:"";position:absolute;left:-40px;top:-60px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,.12)}.hero-content,.hero-visual{position:relative;z-index:1}.hero-content{display:flex;flex-direction:column;justify-content:center}.eyebrow{font-size:12px;font-weight:800;letter-spacing:1.8px;color:var(--primary);text-transform:uppercase}.hero h1{font-family:Georgia,serif;font-size:clamp(36px,5vw,58px);line-height:.98;letter-spacing:-1.8px;margin:10px 0 14px;color:#341f15}.hero p{max-width:560px;color:#6e574d;font-size:17px;margin:0 0 22px}.hero-search{display:flex;gap:10px;max-width:580px}.hero-search .input{flex:1}.hero-visual{display:flex;align-items:center;justify-content:center}.hero-card{width:min(100%,350px);background:rgba(255,255,255,.55);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.55);border-radius:28px;padding:18px;box-shadow:0 20px 40px rgba(106,62,28,.12)}.hero-card-top{display:flex;align-items:center;justify-content:space-between;padding:2px 2px 16px}.mini-badge{display:inline-flex;align-items:center;gap:6px;padding:7px 10px;border-radius:999px;background:#fff;color:#5b4c42;font-size:12px;font-weight:800}.hero-food{border-radius:22px;overflow:hidden;position:relative;background:linear-gradient(135deg,#f7d9b2,#f2b35b 40%,#d9632a);padding:18px}.hero-food img{width:100%;height:220px;object-fit:cover;border-radius:18px;display:block;border:2px solid rgba(255,255,255,.55)}.food-meta{display:flex;align-items:center;justify-content:space-between;margin-top:16px}.food-meta strong{font-size:18px}.food-meta span{color:#614a3d;font-size:13px;font-weight:700}.hero-stats{display:flex;gap:12px;margin-top:18px}.hero-stat{flex:1;background:rgba(255,255,255,.36);border:1px solid rgba(255,255,255,.5);border-radius:16px;padding:12px 14px}.hero-stat strong{display:block;font-size:18px;color:#2c211a}.hero-stat span{font-size:12px;color:#695c52}
.feature-strip{display:grid;grid-template-columns:repeat(3, minmax(0, 1fr));gap:16px;margin:0 0 28px}.feature-item{background:#fffdfb;border:1px solid var(--line);border-radius:18px;padding:18px 18px 16px;box-shadow:0 10px 30px rgba(55,31,17,.03)}.feature-item .mini-icon{display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:12px;background:#fff1e3;color:var(--primary);font-size:22px;margin-bottom:12px}.feature-item h3{margin:0 0 6px;font-size:18px}.feature-item p{margin:0;color:var(--muted);font-size:14px}
.page-shell{display:block}.page-header{display:flex;justify-content:space-between;align-items:center;gap:18px;margin:0 0 22px}.page-header h1{font-family:Georgia,serif;font-size:clamp(30px,3vw,42px);letter-spacing:-1px;margin:0;color:#2c2019}.page-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}.panel{background:#fffdfb;border:1px solid var(--line);border-radius:20px;box-shadow:0 12px 30px rgba(68,43,24,.04)}.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin:0 0 24px}.stat-card{padding:20px 18px;background:linear-gradient(180deg,#fffdfb,#fff7f0);border:1px solid var(--line);border-radius:18px}.stat-card .small{display:block;margin-bottom:8px}.stat-card h2{margin:0;font-size:28px;letter-spacing:-.7px;color:#251b16}.table-card{padding:10px 12px;background:#fffdfb;border:1px solid var(--line);border-radius:18px;overflow:hidden}.table-card .table-wrap{border:0;border-radius:14px}.table-card .table th{background:linear-gradient(180deg,#fdf5ee,#f9efe7)}
.section-heading{display:flex;justify-content:space-between;align-items:end;gap:16px;margin:0 0 18px}.section-heading h2{font-family:Georgia,serif;font-size:30px;letter-spacing:-.5px;margin:0;color:#2f251e}.section-heading p{margin:4px 0 0;color:#81766c}.category-list{display:flex;gap:10px;overflow-x:auto;padding:2px 1px 18px;scrollbar-width:none}.category-list::-webkit-scrollbar{display:none}.category-chip{white-space:nowrap;border:1px solid var(--line);background:rgba(255,255,255,.7);padding:10px 16px;border-radius:999px;font-weight:700;font-size:14px;color:#5d514a;transition:.2s}.category-chip:hover,.category-chip.active{background:linear-gradient(135deg,var(--primary),#ef7c42);color:#fff;border-color:transparent;box-shadow:0 12px 24px rgba(215,93,42,.18)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(235px,1fr));gap:20px}.card{background:var(--card);border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 12px 32px rgba(42,25,14,.04);transition:transform .18s ease,box-shadow .18s ease}.product-card:hover{transform:translateY(-4px);box-shadow:0 18px 32px rgba(73,44,18,.08)}.product-image{width:100%;height:195px;object-fit:cover;background:#f2ece7}.cardbody{padding:18px}.product-card .cardbody{padding:17px}.product-card h3{font-size:20px;line-height:1.25;margin:6px 0 8px;color:#2d2019}.product-card p{color:#7d7269;font-size:14px;min-height:42px;margin:8px 0 13px}.price{font-weight:900;color:var(--primary);font-size:18px}.row{display:flex;gap:10px;align-items:center;flex-wrap:wrap}.between{display:flex;justify-content:space-between;gap:15px;align-items:center}.input{width:100%;padding:12px 14px;border:1px solid #e3d7ca;border-radius:12px;background:#fffdf9;color:var(--text);outline:none;transition:border-color .15s ease,box-shadow .15s ease}.input:focus{border-color:var(--primary);box-shadow:0 0 0 4px rgba(215,93,42,.1)}.form-group{margin-bottom:17px}.form-group label{display:block;margin:0 0 7px;font-size:14px;font-weight:800;color:#4b413a}.table-wrap{overflow-x:auto;border:1px solid var(--line);border-radius:16px;background:#fffdf9}.table{width:100%;border-collapse:collapse;background:#fffdf9}.table th,.table td{padding:14px;border-bottom:1px solid var(--line);text-align:left}.table th{font-size:12px;text-transform:uppercase;letter-spacing:.8px;color:#7a6c62;background:#faf1e5}.table tr:last-child td{border-bottom:0}.alert{padding:14px 16px;border-radius:12px;margin-bottom:18px;background:#e7f9f0;color:#1a6d4f}.error{background:#ffe8e4;color:#8c2c22}.pagination{margin-top:24px}.small{color:#81796e;font-size:13px}.adminnav{background:linear-gradient(135deg,#2a2b2f,#171a1d);color:#fff}.adminnav .brand{color:#ffb76d}.adminnav .navlinks>a{color:#f0ebe5}.adminnav .navlinks>a:hover{color:#ffb76d;background:rgba(255,183,109,.08)}.auth-card{max-width:520px;margin:20px auto;background:#fffdf9;border:1px solid var(--line);box-shadow:0 16px 40px rgba(69,34,17,.08);border-radius:26px;padding:clamp(24px,5vw,42px)}.auth-card h1{font-family:Georgia,serif;font-size:34px;letter-spacing:-.7px;margin:8px 0}.auth-description{color:#7a705f;margin:0 0 24px}.auth-icon{display:inline-flex;align-items:center;justify-content:center;width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#fff1dd,#ffd8a8);font-size:28px}.auth-submit{width:100%;margin-top:7px}.auth-switch{text-align:center;margin:21px 0 10px;color:#746c60}.auth-switch a,.back-link{color:var(--primary);font-weight:800}.back-link{display:block;text-align:center;font-size:14px}.remember-option{display:flex;gap:8px;align-items:center;margin:8px 0 15px;color:#655d55;font-size:14px}.empty-state{text-align:center;padding:52px 22px}.empty-state-icon{font-size:42px}.order-card{padding:20px;margin-bottom:14px}.checkout-grid{display:grid;grid-template-columns:1.15fr .85fr;gap:22px}.checkout-summary{align-self:start}.pagination nav{display:flex;justify-content:center;gap:8px;flex-wrap:wrap}.pagination a,.pagination span{padding:9px 12px;border-radius:10px;background:#fffdf9;border:1px solid var(--line);color:#4c453f}.pagination .current{background:var(--primary);border-color:var(--primary);color:#fff}
footer{padding:30px;text-align:center;color:#7b6d61;border-top:1px solid var(--line);background:rgba(255,255,255,.7)}
@media(max-width:680px){.nav{padding:13px 4%;align-items:flex-start;flex-direction:column;gap:10px}.navlinks{gap:10px}.container{margin-top:22px}.hero{grid-template-columns:1fr;border-radius:20px;padding:22px 20px}.hero-card{width:100%}.hero-search{flex-direction:column}.hero-search .input,.hero-search .btn{width:100%}.grid{grid-template-columns:repeat(auto-fill,minmax(165px,1fr));gap:12px}.product-image{height:145px}.product-card .cardbody{padding:13px}.product-card p{min-height:0}.checkout-grid{grid-template-columns:1fr}.product-detail{grid-template-columns:1fr!important}.product-detail>.product-image{height:240px!important;min-height:0!important}.table th,.table td{padding:10px}.auth-card{margin:0 auto}.section-heading{align-items:flex-start;flex-direction:column}}
</style>
</head>
<body>
<nav class="nav {{ request()->is('admin*') ? 'adminnav' : '' }}">
<a class="brand" href="{{ request()->is('admin*') ? route('admin.dashboard') : route('home') }}">
    <span class="brand-mark" aria-hidden="true"></span>
    <span class="brand-word">RasaKita</span>
</a>
<div class="navlinks">
@if(request()->is('admin*'))
@if(auth()->check() && auth()->user()->is_admin)
<a href="{{ route('admin.dashboard') }}">Dashboard</a><a href="{{ route('admin.products.index') }}">Produk</a><a href="{{ route('admin.categories.index') }}">Kategori</a><a href="{{ route('admin.orders.index') }}">Pesanan</a><a href="{{ route('admin.promotions.edit') }}">Promosi</a>
<form method="POST" action="{{ route('admin.logout') }}" style="display:inline">@csrf<button class="btn danger">Logout</button></form>
@endif
@else
<a href="{{ route('home') }}">Beranda</a>
<a href="{{ route('cart') }}">Keranjang</a>
@auth
@if(auth()->user()->is_admin)
<span class="nav-user">Pesanan Saya</span>
@else
<a href="{{ route('orders.index') }}">Pesanan Saya</a>
<span class="nav-user">Halo, {{ Str::limit(auth()->user()->name, 12) }}</span>
@endif
<form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn light" type="submit">Keluar</button></form>
@else
<a href="{{ route('login') }}">Masuk</a>
<a class="btn" href="{{ route('register') }}">Daftar</a>
@endauth
@endif
</div>
</nav>
<main class="container">
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</main>
<footer>RasaKita &copy; {{ date('Y') }} — Toko Makanan</footer>
</body></html>