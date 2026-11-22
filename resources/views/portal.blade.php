<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#261a14">
    <meta name="description" content="Selamat datang di RasaKita. Nikmati sajian makanan yang tampil hidup dengan visual 3D, lalu pesan dengan mudah.">
    <title>RasaKita — Sajian hangat, penuh rasa</title>
    <style>
        :root {
            color-scheme: dark;
            --cream: #fff7ed;
            --muted: #e4d5c9;
            --accent: #ffc27c;
        }
        * { box-sizing: border-box; }
        html { min-height: 100%; background: #261a14; }
        body {
            min-height: 100vh;
            margin: 0;
            color: var(--cream);
            background: #261a14;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
        }
        a { color: inherit; text-decoration: none; }
        .portal { position: relative; display: flex; min-height: 100svh; flex-direction: column; overflow: hidden; isolation: isolate; }
        .backdrop { position: absolute; z-index: -2; inset: 0; overflow: hidden; background: #261a14; }
        .backdrop::before {
            position: absolute;
            z-index: 1;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(24, 17, 13, .86) 0%, rgba(31, 20, 13, .70) 42%, rgba(35, 20, 12, .18) 100%),
                linear-gradient(0deg, rgba(24, 17, 13, .63) 0%, transparent 37%, rgba(24, 17, 13, .23) 100%);
            content: "";
        }
        .backdrop-image, .backdrop-video { position: absolute; width: 100%; height: 100%; inset: 0; object-fit: cover; }
        .backdrop-image { transform: scale(1.03); animation: backdrop-drift 24s ease-in-out infinite alternate; }
        .backdrop-video { animation: reveal 1.2s ease both; }
        .food-scene { position: absolute; z-index: 2; top: 50%; right: max(2.5%, calc((100% - 1280px) / 2)); width: min(40vw, 570px); aspect-ratio: 1; perspective: 1100px; transform: translateY(-45%); }
        .food-orbit { position: absolute; inset: 2%; border: 1px solid rgba(255, 221, 180, .35); border-radius: 50%; transform: rotateX(68deg) rotateZ(-20deg); box-shadow: 0 0 45px rgba(255, 194, 124, .12); animation: orbit-turn 22s linear infinite; }
        .food-orbit::before, .food-orbit::after { position: absolute; width: 13px; height: 13px; border: 2px solid rgba(255, 220, 174, .9); border-radius: 50%; background: #d46b32; box-shadow: 0 0 20px rgba(255, 194, 124, .7); content: ""; }
        .food-orbit::before { top: 14%; left: 17%; }
        .food-orbit::after { right: 12%; bottom: 17%; width: 8px; height: 8px; background: #f3bd67; }
        .food-plate { position: absolute; inset: 10%; overflow: hidden; border: 11px solid rgba(255, 250, 239, .92); border-radius: 50%; background: #f8eee0; box-shadow: 0 35px 90px rgba(8, 5, 3, .48), inset 0 0 0 2px rgba(105, 65, 36, .12), 0 0 0 1px rgba(255,255,255,.5); transform-style: preserve-3d; animation: food-float 7s ease-in-out infinite; }
        .food-plate::after { position: absolute; z-index: 1; inset: 0; border: 1px solid rgba(255,255,255,.35); border-radius: inherit; background: linear-gradient(145deg, rgba(255,255,255,.14), transparent 45%, rgba(36,16,5,.2)); content: ""; pointer-events: none; }
        .food-plate img { display: block; width: 100%; height: 100%; border-radius: inherit; object-fit: cover; object-position: 50% 50%; filter: saturate(1.12) contrast(1.04); transform: translateZ(24px) scale(1.08); }
        .food-tag { position: absolute; z-index: 3; top: 13%; right: 2%; padding: 10px 14px; border: 1px solid rgba(255,255,255,.32); border-radius: 999px; background: rgba(42, 27, 18, .62); color: #fff5e8; font-size: 10px; font-weight: 850; letter-spacing: .15em; backdrop-filter: blur(12px); box-shadow: 0 12px 32px rgba(0,0,0,.2); animation: tag-float 6s ease-in-out infinite; }
        .food-caption { position: absolute; z-index: 3; right: 4%; bottom: 13%; display: grid; gap: 2px; padding: 12px 16px; border: 1px solid rgba(255,255,255,.3); border-radius: 15px; background: rgba(42, 27, 18, .62); color: #fff5e8; backdrop-filter: blur(12px); box-shadow: 0 12px 32px rgba(0,0,0,.2); animation: tag-float 6s ease-in-out -2s infinite; }
        .food-caption strong { font-family: Georgia, "Times New Roman", serif; font-size: 17px; font-weight: 500; }
        .food-caption span { color: rgba(255,245,232,.75); font-size: 10px; letter-spacing: .08em; }
        @keyframes reveal { from { opacity: 0; } to { opacity: 1; } }
        @keyframes backdrop-drift { from { transform: scale(1.03) translate3d(-.4%, -.3%, 0); } to { transform: scale(1.1) translate3d(.4%, .3%, 0); } }
        @keyframes food-float { 0%, 100% { transform: rotateX(6deg) rotateY(-10deg) translate3d(0, 0, 0); } 50% { transform: rotateX(-3deg) rotateY(7deg) translate3d(0, -12px, 18px); } }
        @keyframes orbit-turn { from { transform: rotateX(68deg) rotateZ(-20deg); } to { transform: rotateX(68deg) rotateZ(340deg); } }
        @keyframes tag-float { 0%, 100% { transform: translate3d(0, 0, 24px); } 50% { transform: translate3d(0, -7px, 24px); } }
        .topbar, .hero, .footer { width: min(1280px, 88%); margin-inline: auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 29px 0; }
        .brand { display: inline-flex; align-items: center; gap: 11px; font-size: 24px; font-weight: 900; letter-spacing: -.8px; }
        .brand-mark { display: grid; width: 42px; height: 42px; place-items: center; border: 1px solid rgba(255,255,255,.38); border-radius: 15px; background: rgba(255,255,255,.13); color: var(--accent); font-family: Georgia, "Times New Roman", serif; font-size: 23px; backdrop-filter: blur(12px); }
        .topbar-actions { display: flex; align-items: center; gap: 11px; }
        .login { display: inline-flex; min-height: 42px; align-items: center; justify-content: center; gap: 8px; padding: 0 16px; border: 1px solid rgba(255,255,255,.28); border-radius: 999px; background: rgba(255,255,255,.09); color: var(--cream); font-size: 13px; font-weight: 750; backdrop-filter: blur(12px); }
        .login:hover { background: rgba(255,255,255,.17); }
        .hero { display: flex; flex: 1; align-items: center; padding: 55px 0 98px; }
        .copy { max-width: 650px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 11px; color: var(--accent); font-size: 11px; font-weight: 850; letter-spacing: 2.2px; text-transform: uppercase; }
        .eyebrow::before { width: 30px; height: 1px; background: var(--accent); content: ""; }
        h1 { margin: 22px 0 19px; font-family: Georgia, "Times New Roman", serif; font-size: clamp(54px, 7.4vw, 94px); font-weight: 500; line-height: .94; letter-spacing: -4.5px; text-wrap: balance; }
        h1 span { color: var(--accent); font-style: italic; }
        .intro { max-width: 510px; margin: 0; color: var(--muted); font-size: clamp(15px, 1.6vw, 18px); line-height: 1.8; }
        .actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px; margin-top: 31px; }
        .button { display: inline-flex; min-height: 53px; align-items: center; justify-content: center; gap: 12px; padding: 0 23px; border: 1px solid transparent; border-radius: 999px; font-size: 14px; font-weight: 850; transition: transform .18s ease, background-color .18s ease; }
        .button:hover { transform: translateY(-2px); }
        .button-primary { color: #321b11; background: var(--accent); box-shadow: 0 12px 30px rgba(255, 173, 91, .2); }
        .button-primary:hover { background: #ffd29e; }
        .button-secondary { border-color: rgba(255,255,255,.3); background: rgba(255,255,255,.08); color: var(--cream); backdrop-filter: blur(12px); }
        .button-secondary:hover { background: rgba(255,255,255,.16); }
        .button-arrow { font-size: 19px; line-height: 1; }
        .trust { display: flex; flex-wrap: wrap; gap: 10px 25px; margin-top: 35px; color: #f2e5d8; font-size: 12px; font-weight: 700; }
        .trust span { display: inline-flex; align-items: center; gap: 8px; }
        .trust-mark { color: var(--accent); font-size: 15px; }
        .footer { display: flex; justify-content: space-between; gap: 18px; padding: 0 0 22px; color: rgba(255,247,237,.68); font-size: 11px; }
        .footer-note { letter-spacing: .08em; text-transform: uppercase; }
        @media (max-width: 680px) {
            .backdrop::before { background: linear-gradient(90deg, rgba(24,17,13,.76), rgba(31,20,13,.42)), linear-gradient(0deg, rgba(24,17,13,.68), transparent 55%, rgba(24,17,13,.3)); }
            .topbar, .hero, .footer { width: 90%; }
            .topbar { padding: 19px 0; }
            .brand { gap: 9px; font-size: 21px; }
            .brand-mark { width: 38px; height: 38px; }
            .login { min-height: 39px; padding-inline: 13px; }
            .hero { padding: 66px 0 74px; }
            h1 { font-size: clamp(54px, 13vw, 82px); letter-spacing: -2.8px; }
            .trust { gap: 10px 17px; margin-top: 27px; }
            .footer { flex-wrap: wrap; }
            .food-scene { top: 54%; right: -22vw; width: 86vw; opacity: .58; }
            .food-plate { border-width: 7px; }
            .food-tag { top: 16%; right: 4%; padding: 8px 11px; font-size: 8px; }
            .food-caption { right: 7%; bottom: 17%; padding: 9px 12px; }
            .food-caption strong { font-size: 15px; }
        }
        @media (max-width: 390px) {
            .actions { align-items: stretch; flex-direction: column; }
            .button { width: 100%; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
            .backdrop-image, .food-scene * { animation: none !important; }
        }
    </style>
</head>
<body>
    <div class="portal">
        <div class="backdrop" aria-hidden="true">
            <img class="backdrop-image" src="{{ asset('images/products/nasi-goreng-spesial.jpg') }}" alt="">
            @if (file_exists(public_path('videos/rasakita-hero.mp4')))
                <video class="backdrop-video" id="portal-video" autoplay muted loop playsinline poster="{{ asset('images/products/nasi-goreng-spesial.jpg') }}">
                    <source src="{{ asset('videos/rasakita-hero.mp4') }}" type="video/mp4">
                </video>
            @endif
            <div class="food-scene">
                <div class="food-orbit"></div>
                <div class="food-plate">
                    <img src="{{ asset('images/products/ayam-geprek.jpg') }}" alt="">
                </div>
                <span class="food-tag">SAJIAN FAVORIT</span>
                <div class="food-caption">
                    <strong>Hangat, penuh rasa</strong>
                    <span>DIBUAT SEGAR SETIAP HARI</span>
                </div>
            </div>
        </div>

        <header class="topbar">
            <a class="brand" href="{{ route('portal') }}" aria-label="RasaKita, halaman depan">
                <span class="brand-mark" aria-hidden="true">R</span>
                <span>RasaKita</span>
            </a>
            <div class="topbar-actions">
                <a class="login" href="{{ route('login') }}">Masuk akun</a>
            </div>
        </header>

        <main class="hero">
            <section class="copy">
                <span class="eyebrow">Hangat, lezat, dari dapur kami</span>
                <h1>Sajian hangat,<br><span>penuh rasa.</span></h1>
                <p class="intro">Selamat datang di RasaKita. Temukan makanan rumahan favoritmu, pesan dengan mudah, dan nikmati tanpa ribet.</p>
                <div class="actions">
                    <a class="button button-primary" href="{{ route('home') }}">Jelajahi menu <span class="button-arrow" aria-hidden="true">→</span></a>
                    <a class="button button-secondary" href="{{ route('register') }}">Buat akun</a>
                </div>
                <div class="trust" aria-label="Keunggulan RasaKita">
                    <span><span class="trust-mark" aria-hidden="true">✦</span> Menu autentik</span>
                    <span><span class="trust-mark" aria-hidden="true">⚡</span> Pesan praktis</span>
                    <span><span class="trust-mark" aria-hidden="true">♡</span> Dibuat dengan cinta</span>
                </div>
            </section>
        </main>

        <footer class="footer">
            <span>RasaKita &copy; {{ date('Y') }}</span>
            <span class="footer-note">Sajian hangat untuk setiap hari</span>
        </footer>
    </div>
</body>
</html>
