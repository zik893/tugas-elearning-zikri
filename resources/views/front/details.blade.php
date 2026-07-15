<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} — Details</title>
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
            --line-dark: rgba(15,22,38,.12);
            --text: #0b1220;
            --text-soft: #6B7280;
            --gold: #F59E0B;
            --gold-soft: rgba(245,158,11,.12);
            --gold-deep: #B45309;
            --emerald: #0EA5A4;
            --emerald-soft: #E6FAF9;
            --radius-l: 22px;
            --radius-m: 14px;
            --radius-s: 8px;
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
        
        .container { max-width: 1200px; margin: 40px auto; padding: 0 24px; display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
        .course-header { background: linear-gradient(135deg, var(--ink), var(--ink-2)); padding: 48px; border-radius: var(--radius-l); color: #fff; margin-bottom: 30px; grid-column: span 2; }
        .difficulty-badge { display: inline-block; padding: 6px 16px; border-radius: 100px; font-family: var(--mono); font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 20px; background: var(--gold-soft); color: var(--gold); }
        .course-title { font-family: var(--serif); font-size: 36px; font-weight: 600; margin-bottom: 16px; }
        .meta-info { display: flex; gap: 24px; font-size: 14px; color: rgba(255,255,255,0.7); }
        
        .card { background: #fff; border: 1px solid var(--line); border-radius: var(--radius-l); padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .card-title { font-family: var(--serif); font-size: 22px; font-weight: 600; margin-bottom: 20px; border-bottom: 1px dashed var(--line); padding-bottom: 12px; }
        .about-text { line-height: 1.75; color: var(--text-soft); font-size: 15px; margin-bottom: 30px; }
        
        .curriculum-list { display: flex; flex-col; gap: 16px; list-style: none; }
        .curriculum-item { display: flex; justify-content: space-between; align-items: center; padding: 16px; background: var(--paper-2); border-radius: var(--radius-s); margin-bottom: 12px; }
        .curriculum-title { font-weight: 500; font-size: 14.5px; }
        .curriculum-duration { font-family: var(--mono); font-size: 12px; color: var(--text-soft); }
        
        .sidebar { display: flex; flex-direction: column; gap: 30px; }
        .pricing-box { text-align: center; }
        .price-tag { font-family: var(--serif); font-size: 32px; font-weight: 700; color: var(--ink); margin-bottom: 20px; }
        .teacher-box { display: flex; align-items: center; gap: 16px; }
        .teacher-avatar { width: 50px; height: 50px; border-radius: 50%; background: var(--gold-soft); display: flex; align-items: center; justify-content: center; font-size: 24px; }
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
    <div class="course-header">
        <span class="difficulty-badge">{{ ucfirst($course->difficulty) }}</span>
        <h1 class="course-title">{{ $course->name }}</h1>
        <div class="meta-info">
            <span>Kategori: <strong>{{ $course->category->name }}</strong></span>
            <span>Instruktur: <strong>{{ $course->teacher->user->name }}</strong></span>
            <span>Jumlah Video: <strong>{{ $course->videos->count() }}</strong></span>
        </div>
    </div>

    <div>
        <div class="card mb-6" style="margin-bottom: 30px;">
            <h2 class="card-title">Tentang Kelas</h2>
            <p class="about-text">{{ $course->about }}</p>
        </div>

        <div class="card">
            <h2 class="card-title">Kurikulum Pembelajaran</h2>
            <div class="curriculum-list">
                @forelse($course->videos as $index => $video)
                    <div class="curriculum-item">
                        <div class="curriculum-title">
                            {{ $index + 1 }}. {{ $video->name }}
                        </div>
                        <div class="curriculum-duration">
                            Video Tutorial
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 italic">Belum ada video pembelajaran untuk kelas ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="sidebar">
        <div class="card pricing-box">
            <h2 class="card-title">Akses Kelas</h2>
            <div class="price-tag">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
            
            @auth
                @if(auth()->user()->hasActiveSubscription())
                    @if($course->videos->count() > 0)
                        <a href="{{ route('front.learning', [$course, $course->videos->first()]) }}" class="btn btn-gold" style="width: 100%;">
                            Mulai Belajar
                        </a>
                    @else
                        <button class="btn btn-outline" style="width: 100%; color: #6B7280; border-color: #E6E9EE;" disabled>Video Belum Tersedia</button>
                    @endif
                @else
                    <a href="{{ route('front.checkout', $course) }}" class="btn btn-gold" style="width: 100%;">
                        Langganan Sekarang
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-gold" style="width: 100%;">
                    Login untuk Belajar
                </a>
            @endauth
        </div>

        <div class="card teacher-box">
            <div class="teacher-avatar">👨‍🏫</div>
            <div>
                <p style="font-size: 12px; color: var(--text-soft); font-family: var(--mono); text-transform: uppercase;">Instruktur</p>
                <h3 style="font-family: var(--serif); font-size: 18px; font-weight: 600;">{{ $course->teacher->user->name }}</h3>
                <p style="font-size: 13px; color: var(--text-soft);">{{ $course->teacher->user->occupation ?? 'Teacher' }}</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
