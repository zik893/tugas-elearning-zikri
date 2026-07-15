<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plan — LearnZikri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,800;1,9..144,500;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --ink: #071226;
            --ink-2: #0f1a35;
            --ink-3: #16223a;
            --paper: #FBFBFD;
            --paper-2: #F3F6F9;
            --line: #E6E9EE;
            --text: #0b1220;
            --text-soft: #6B7280;
            --gold: #F59E0B;
            --gold-soft: rgba(245,158,11,.12);
            --gold-deep: #B45309;
            --radius-l: 22px;
            --radius-m: 14px;
            --serif: 'Fraunces', serif;
            --sans: 'Inter', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--sans); background: var(--paper); color: var(--text); }
        a { text-decoration: none; color: inherit; }
        
        .navbar { background: var(--ink); padding: 20px 48px; display: flex; justify-content: space-between; align-items: center; }
        .navbar-logo { font-family: var(--serif); font-weight: 700; font-size: 22px; color: #fff; }
        .navbar-logo span { color: var(--gold); font-style: italic; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 13.5px; font-weight: 600; border-radius: 100px; padding: 12px 26px; border: 1px solid transparent; cursor: pointer; transition: all .25s ease; }
        .btn-gold { background: var(--gold); color: var(--ink); }
        .btn-outline { border: 1px solid rgba(255,255,255,.24); color: #fff; background: transparent; }

        .container { max-width: 800px; margin: 80px auto; padding: 0 24px; text-align: center; }
        .title { font-family: var(--serif); font-size: 42px; font-weight: 600; margin-bottom: 16px; }
        .desc { font-size: 16px; color: var(--text-soft); max-width: 600px; margin: 0 auto 50px; }
        
        .pricing-card { background: #fff; border: 2px solid var(--gold); border-radius: var(--radius-l); padding: 48px; box-shadow: 0 20px 45px -10px rgba(2,6,23,.08); max-width: 500px; margin: 0 auto; position: relative; }
        .badge { position: absolute; top: -16px; left: 50%; transform: translateX(-50%); background: var(--gold); color: var(--ink); padding: 6px 18px; border-radius: 100px; font-family: var(--mono); font-size: 11px; text-transform: uppercase; font-weight: bold; }
        .plan-name { font-family: var(--serif); font-size: 26px; font-weight: 600; margin-bottom: 8px; }
        .price { font-family: var(--serif); font-size: 48px; font-weight: 700; color: var(--ink); margin-bottom: 24px; }
        .price span { font-size: 16px; color: var(--text-soft); font-family: var(--sans); font-weight: 400; }
        
        .features-list { list-style: none; text-align: left; max-width: 320px; margin: 0 auto 40px; display: flex; flex-direction: column; gap: 16px; }
        .features-item { display: flex; align-items: center; gap: 12px; font-size: 14.5px; color: var(--ink-2); }
        .check-icon { color: var(--gold-deep); font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('front.index') }}" class="navbar-logo">Learn<span>Zikri</span></a>
    @auth
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-gold">Login</a>
    @endauth
</nav>

<div class="container">
    <h1 class="title">Investasi Terbaik untuk Masa Depanmu</h1>
    <p class="desc">Dapatkan akses penuh ke seluruh perpustakaan materi kelas berkualitas tinggi dengan rencana harga berlangganan kami yang sederhana.</p>

    <div class="pricing-card">
        <span class="badge">Terpopuler</span>
        <h2 class="plan-name">Akses Premium Langganan</h2>
        <div class="price">Rp 250.000 <span>/ bulan</span></div>
        
        <ul class="features-list">
            <li class="features-item"><span class="check-icon">✓</span> Akses semua materi kelas premium</li>
            <li class="features-item"><span class="check-icon">✓</span> Video pembelajaran berkualitas HD</li>
            <li class="features-item"><span class="check-icon">✓</span> Bimbingan langsung instruktur</li>
            <li class="features-item"><span class="check-icon">✓</span> Sertifikat Kelulusan resmi</li>
        </ul>

        @if($courses->count() > 0)
            <a href="{{ route('front.checkout', $courses->first()) }}" class="btn btn-gold" style="width: 100%;">
                Mulai Berlangganan Sekarang
            </a>
        @else
            <button class="btn btn-outline" style="width: 100%; color: #6B7280; border-color: #E6E9EE;" disabled>Mulai Berlangganan Sekarang</button>
        @endif
    </div>
</div>

</body>
</html>
