<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnZikri — Platform Belajar Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,800;1,9..144,500;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            /* Refined palette: deep navy + warm amber accent + teal supporting color */
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
            --rust: #9C4A2E;
            --rust-soft: #F6E9E4;
            --radius-l: 22px;
            --radius-m: 14px;
            --radius-s: 8px;
            --serif: 'Fraunces', serif;
            --sans: 'Inter', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--sans); background: var(--paper); color: var(--text); overflow-x: hidden; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; }
        img { display: block; max-width: 100%; }
        :focus-visible { outline: 2px solid var(--gold); outline-offset: 3px; }
        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; scroll-behavior: auto !important; }
        }

        .mono-tag { font-family: var(--mono); font-size: 11px; letter-spacing: .12em; text-transform: uppercase; }

        /* NAV */
        .navbar { background: var(--ink); padding: 20px 48px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; border-bottom: 1px solid var(--line-dark); }
        .navbar-logo { font-family: var(--serif); font-weight: 700; font-size: 22px; color: #fff; letter-spacing: -0.3px; }
        .navbar-logo span { color: var(--gold); font-style: italic; }
        .navbar-links { display: flex; align-items: center; gap: 40px; }
        .navbar-links a { color: rgba(255,255,255,.62); font-size: 13px; font-weight: 500; letter-spacing: .02em; transition: color .2s; position: relative; padding-bottom: 3px; }
        .navbar-links a::after { content:''; position:absolute; left:0; right:100%; bottom:-1px; height:1px; background:var(--gold); transition: right .25s ease; }
        .navbar-links a:hover { color: #fff; }
        .navbar-links a:hover::after { right: 0; }
        .navbar-actions { display: flex; gap: 10px; align-items: center; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 13.5px; font-weight: 600; border-radius: 100px; padding: 12px 26px; border: 1px solid transparent; cursor: pointer; transition: all .25s ease; letter-spacing: .01em; }
        .btn-gold { background: var(--gold); color: var(--ink); }
        .btn-gold:hover { background: #fff; transform: translateY(-1px); }
        .btn-outline { border: 1px solid rgba(255,255,255,.24); color: #fff; background: transparent; }
        .btn-outline:hover { border-color: var(--gold); color: var(--gold); }

        /* HERO */
        .hero { background:
                radial-gradient(circle at 82% 8%, var(--gold-soft), transparent 42%),
                radial-gradient(circle at 8% 92%, var(--emerald-soft), transparent 40%),
                linear-gradient(160deg, var(--ink) 0%, var(--ink-2) 55%, var(--ink-3) 100%);
            min-height: 88vh; display: flex; align-items: center; position: relative; overflow: hidden; padding: 96px 48px; }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 64px 64px; pointer-events: none; mask-image: linear-gradient(to bottom, black, transparent 70%);
        }
        .hero-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1.05fr .95fr; gap: 88px; align-items: center; width: 100%; position: relative; z-index: 2; }
        .hero-badge { display: inline-flex; align-items: center; gap: 9px; background: var(--gold-soft); border: 1px solid rgba(214,160,60,.35); border-radius: 100px; padding: 8px 18px 8px 14px; font-family: var(--mono); font-size: 11px; letter-spacing: .08em; text-transform: uppercase; color: var(--gold); margin-bottom: 28px; }
        .hero-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); animation: pulse 2.4s infinite; flex-shrink:0; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .35; } }
        .hero-title { font-family: var(--serif); font-size: clamp(38px, 4.6vw, 60px); font-weight: 600; color: #fff; line-height: 1.08; letter-spacing: -0.5px; margin-bottom: 24px; }
        .hero-title em { color: var(--gold); font-style: italic; font-weight: 500; }
        .hero-desc { font-size: 16.5px; color: rgba(255,255,255,.6); line-height: 1.75; margin-bottom: 40px; max-width: 460px; }
        .hero-cta { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 56px; }
        .hero-stats { display: flex; gap: 0; border-top: 1px solid var(--line-dark); padding-top: 24px; }
        .hero-stats > div { padding-right: 32px; margin-right: 32px; border-right: 1px solid var(--line-dark); }
        .hero-stats > div:last-child { border-right: none; margin-right:0; padding-right:0; }
        .hero-stat-num { font-family: var(--serif); font-size: 30px; font-weight: 600; color: #fff; }
        .hero-stat-num span { color: var(--gold); }
        .hero-stat-label { font-family: var(--mono); font-size: 10.5px; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.4); margin-top: 4px; }

        /* HERO VISUAL — "transcript" card */
        .hero-visual { position: relative; }
        .hero-card { background: #FFFFFF; border: 1px solid rgba(2,6,23,.04); border-radius: var(--radius-l); padding: 32px; box-shadow: 0 20px 40px -10px rgba(2,6,23,.18); }
        .hero-card-header { display: flex; align-items: center; gap: 14px; margin-bottom: 8px; padding-bottom: 22px; border-bottom: 1px dashed var(--line); }
        .hero-card-avatar { width: 46px; height: 46px; border-radius: 12px; background: linear-gradient(135deg, var(--gold), var(--gold-deep)); display: flex; align-items: center; justify-content: center; font-family: var(--serif); font-weight: 700; color: var(--ink); font-size: 19px; }
        .hero-card-name { font-family: var(--serif); font-weight: 600; color: var(--text); font-size: 16px; }
        .hero-card-role { font-family: var(--mono); font-size: 10.5px; letter-spacing: .05em; text-transform: uppercase; color: var(--text-soft); margin-top: 2px; }
        .hero-card-eyebrow { margin-left: auto; font-family: var(--mono); font-size: 10px; letter-spacing: .06em; color: var(--gold-deep); background: var(--gold-soft); padding: 4px 10px; border-radius: 100px; }
        .progress-list { padding-top: 20px; }
        .progress-item { margin-bottom: 18px; }
        .progress-item:last-child { margin-bottom: 0; }
        .progress-label { display: flex; justify-content: space-between; align-items:baseline; font-size: 13.5px; color: var(--text); margin-bottom: 9px; font-weight: 500; }
        .progress-label span:last-child { font-family: var(--mono); font-size: 12px; color: var(--text-soft); }
        .progress-bar { height: 5px; background: var(--paper-2); border-radius: 100px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 100px; background: linear-gradient(90deg, var(--gold), var(--gold-deep)); }
        .floating-badge { position: absolute; background: rgba(2,6,23,.9); color:#fff; border-radius: var(--radius-m); padding: 13px 18px; box-shadow: 0 16px 30px rgba(2,6,23,.18); display: flex; align-items: center; gap: 12px; border: 1px solid rgba(255,255,255,.03); }
        .floating-badge-1 { top: -22px; right: -26px; }
        .floating-badge-2 { bottom: -22px; left: -26px; }
        .floating-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 15px; }
        .floating-num { font-family: var(--serif); font-size: 15px; font-weight: 600; color: #fff; }
        .floating-text { font-family: var(--mono); font-size: 10px; letter-spacing: .04em; text-transform: uppercase; color: rgba(255,255,255,.5); margin-top: 1px; }

        /* SECTION SHARED */
        .section { padding: 108px 48px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-eyebrow { font-family: var(--mono); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--gold-deep); margin-bottom: 14px; display:flex; align-items:center; gap:10px; }
        .section-eyebrow::before { content:''; width: 22px; height: 1px; background: var(--gold-deep); display:inline-block; }
        .section-title { font-family: var(--serif); font-size: 38px; font-weight: 600; color: var(--text); letter-spacing: -0.4px; margin-bottom: 14px; }
        .section-title em { font-style: italic; color: var(--gold-deep); font-weight: 500; }
        .section-desc { font-size: 15px; color: var(--text-soft); line-height: 1.75; max-width: 460px; }
        .section-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 56px; gap: 24px; flex-wrap: wrap; }

        /* CATEGORIES — catalogue style */
        .categories-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 1px; background: var(--line); border: 1px solid var(--line); border-radius: var(--radius-l); overflow: hidden; }
        .category-card { background: var(--paper); padding: 30px 26px; display: flex; flex-direction: column; align-items: flex-start; gap: 16px; transition: all .25s ease; cursor: pointer; position: relative; }
        .category-card:hover { background: #fff; }
        .category-index { font-family: var(--mono); font-size: 10.5px; color: var(--text-soft); letter-spacing: .05em; }
        .category-icon { width: 50px; height: 50px; border-radius: var(--radius-s); display: flex; align-items: center; justify-content: center; font-size: 22px; background: var(--gold-soft); border: 1px solid rgba(245,158,11,.18); transition: transform .25s ease; }
        .category-card:hover .category-icon { transform: translateY(-3px); }
        .category-name { font-family: var(--serif); font-size: 16px; font-weight: 600; color: var(--text); }
        .category-count { font-family: var(--mono); font-size: 11px; color: var(--text-soft); letter-spacing: .03em; margin-top: 2px; }

        /* COURSES */
        .courses-bg { background: var(--paper-2); position: relative; }
        .courses-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(330px, 1fr)); gap: 28px; }
        .course-card { background: #fff; border-radius: var(--radius-l); overflow: hidden; transition: all .3s ease; box-shadow: 0 2px 0 var(--line); border: 1px solid var(--line); }
        .course-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -12px rgba(2,6,23,.08); border-color: transparent; }
        .course-thumbnail { width: 100%; height: 196px; object-fit: cover; }
        .course-thumbnail-placeholder { width: 100%; height: 196px; display: flex; align-items: center; justify-content: center; font-size: 40px; position: relative; background: linear-gradient(135deg, #0f1a35, #16223a); }
        .course-thumbnail-placeholder::after { content:''; position:absolute; inset:0; background-image: linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px); background-size: 22px 22px; }
        .course-body { padding: 26px; }
        .course-badge { display: inline-flex; align-items: center; gap: 6px; font-family: var(--mono); font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; padding: 5px 12px; border-radius: 100px; margin-bottom: 16px; border: 1px solid transparent; }
        .badge-beginner { background: var(--emerald-soft); color: var(--emerald); border-color: rgba(31,95,78,.18); }
        .badge-intermediate { background: var(--gold-soft); color: var(--gold-deep); border-color: rgba(214,160,60,.25); }
        .badge-advanced { background: var(--rust-soft); color: var(--rust); border-color: rgba(156,74,46,.2); }
        .course-title { font-family: var(--serif); font-size: 18.5px; font-weight: 600; color: var(--text); line-height: 1.35; margin-bottom: 14px; min-height: 50px; }
        .course-teacher { font-size: 13px; color: var(--text-soft); display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .course-teacher-avatar { width: 22px; height: 22px; border-radius: 50%; background: var(--paper-2); display:flex; align-items:center; justify-content:center; font-size: 11px; flex-shrink:0; }
        .course-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 18px; border-top: 1px dashed var(--line); }
        .course-category { font-family: var(--mono); font-size: 11px; color: var(--gold-deep); font-weight: 600; letter-spacing: .03em; text-transform: uppercase; }
        .course-btn { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 700; color: var(--text); border: 1px solid var(--line); border-radius: 100px; padding: 9px 18px; transition: all .2s ease; }
        .course-btn:hover { border-color: var(--ink); background: var(--ink); color: #fff; }

        /* FOOTER */
        .footer { background: linear-gradient(90deg, var(--ink-2), var(--ink)); color: #fff; padding: 72px 48px 32px; }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 40px; border-bottom: 1px solid var(--line-dark); margin-bottom: 24px; gap: 40px; flex-wrap: wrap; }
        .footer-logo { font-family: var(--serif); font-size: 24px; font-weight: 700; }
        .footer-logo span { color: var(--gold); font-style: italic; }
        .footer-tagline { color: rgba(255,255,255,.45); font-size: 13.5px; margin-top: 12px; max-width: 280px; line-height: 1.6; }
        .footer-note { color: rgba(255,255,255,.5); font-size: 14px; max-width: 340px; line-height: 1.7; text-align: right; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .footer-copy { font-family: var(--mono); font-size: 11.5px; color: rgba(255,255,255,.35); letter-spacing: .02em; }

        @media (max-width: 880px) {
            .navbar { padding: 16px 24px; }
            .navbar-links { display:none; }
            .hero { padding: 64px 24px; }
            .hero-inner { grid-template-columns: 1fr; gap: 56px; }
            .hero-visual { max-width: 420px; }
            .section { padding: 72px 24px; }
            .footer { padding: 56px 24px 28px; }
            .footer-note { text-align: left; }
        }
    </style>
</head>
<body>

{{-- NAV --}}
<nav class="navbar">
    <div class="navbar-logo">Learn<span>Zikri</span></div>
    <div class="navbar-links">
        <a href="#categories">Kategori</a>
        <a href="#courses">Kelas</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @endauth
    </div>
    <div class="navbar-actions">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-gold">My Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn btn-gold">Daftar Gratis</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <div>
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Platform Belajar #1 untuk Mahasiswa Indonesia
            </div>
            <h1 class="hero-title">
                Belajar Lebih <em>Cerdas</em>,<br>
                Karir Lebih <em>Cemerlang</em>
            </h1>
            <p class="hero-desc">
                LearnZikri menghadirkan kelas online berkualitas tinggi dari instruktur berpengalaman. Mulai perjalanan belajarmu hari ini dan wujudkan potensi terbaikmu.
            </p>
            <div class="hero-cta">
                <a href="#courses" class="btn btn-gold" style="font-size:14.5px; padding:14px 32px;">Jelajahi Kelas →</a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="font-size:14.5px; padding:14px 32px;">Daftar Gratis</a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-num"><span>{{ $courses->count() }}</span>+</div>
                    <div class="hero-stat-label">Kelas Tersedia</div>
                </div>
                <div>
                    <div class="hero-stat-num"><span>{{ $categories->count() }}</span>+</div>
                    <div class="hero-stat-label">Kategori</div>
                </div>
                <div>
                    <div class="hero-stat-num">100<span>%</span></div>
                    <div class="hero-stat-label">Online &amp; Fleksibel</div>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-card">
                <div class="hero-card-header">
                    <div class="hero-card-avatar">D</div>
                    <div>
                        <div class="hero-card-name">Zikri</div>
                        <div class="hero-card-role">Web Developer Student</div>
                    </div>
                    <div class="hero-card-eyebrow">Progres</div>
                </div>
                <div class="progress-list">
                    <div class="progress-item">
                        <div class="progress-label"><span>Laravel Fundamentals</span><span>85%</span></div>
                        <div class="progress-bar"><div class="progress-fill" style="width:85%"></div></div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label"><span>UI/UX Design</span><span>70%</span></div>
                        <div class="progress-bar"><div class="progress-fill" style="width:70%"></div></div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label"><span>Data Science Basics</span><span>45%</span></div>
                        <div class="progress-bar"><div class="progress-fill" style="width:45%"></div></div>
                    </div>
                </div>
            </div>

            <div class="floating-badge floating-badge-1">
                <div class="floating-icon" style="background:rgba(31,95,78,.35);">✅</div>
                <div>
                    <div class="floating-num">12 Lesson</div>
                    <div class="floating-text">Selesai hari ini</div>
                </div>
            </div>

            <div class="floating-badge floating-badge-2">
                <div class="floating-icon" style="background:rgba(214,160,60,.3);">🏆</div>
                <div>
                    <div class="floating-num">Top Learner</div>
                    <div class="floating-text">Minggu ini</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES --}}
<section class="section" id="categories">
    <div class="section-inner">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">Kategori Kelas</div>
                <h2 class="section-title">Pilih Bidang yang Kamu <em>Minati</em></h2>
                <p class="section-desc">Dari teknologi hingga bisnis, temukan kelas yang sesuai dengan passion-mu.</p>
            </div>
        </div>

        <div class="categories-grid">
            @forelse($categories as $category)
            <a href="{{ route('front.category', $category->slug) }}">
                <div class="category-card">
                    <span class="category-index">CAT—{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="category-icon">
                        @if($category->icon)
                            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" style="width:30px; height:30px; object-fit:cover; border-radius:6px;">
                        @else
                            📚
                        @endif
                    </div>
                    <div>
                        <div class="category-name">{{ $category->name }}</div>
                        <div class="category-count">{{ $category->courses->count() }} Kelas</div>
                    </div>
                </div>
            </a>
            @empty
            <p style="color:#6B6B70; grid-column: span 4; padding: 40px;">Belum ada kategori tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- COURSES --}}
<section class="section courses-bg" id="courses">
    <div class="section-inner">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">Kelas Terbaru</div>
                <h2 class="section-title">Mulai Belajar <em>Sekarang</em></h2>
                <p class="section-desc">Kelas berkualitas tinggi dari instruktur berpengalaman, bisa diakses kapan saja.</p>
            </div>
        </div>

        <div class="courses-grid">
            @forelse($courses as $course)
            <div class="course-card">
                @if($course->thumbnail)
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="course-thumbnail">
                @else
                    <div class="course-thumbnail-placeholder" style="background: linear-gradient(135deg, #14151D, #1D2030);">📖</div>
                @endif
                <div class="course-body">
                    <span class="course-badge badge-{{ $course->difficulty }}">
                        {{ ucfirst($course->difficulty) }}
                    </span>
                    <div class="course-title">{{ $course->name }}</div>
                    <div class="course-teacher">
                        <span class="course-teacher-avatar">👨‍🏫</span> {{ $course->teacher->user->name }}
                    </div>
                    <div class="course-footer">
                        <span class="course-category">{{ $course->category->name }}</span>
                        <a href="{{ route('front.details', $course->slug) }}" class="course-btn">
                            Lihat Kelas →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p style="color:#6B6B70; grid-column: span 3; padding: 40px;">Belum ada kelas tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div>
                <div class="footer-logo">Learn<span>Zikri</span></div>
                <p class="footer-tagline">Platform belajar online terpercaya untuk generasi digital Indonesia.</p>
            </div>
            <p class="footer-note">Belajar mandiri, terarah, dan fleksibel — dirancang untuk mahasiswa yang ingin terus berkembang.</p>
        </div>
        <div class="footer-bottom">
            <div class="footer-copy">© {{ date('Y') }} Learn by Zikri — Sistem Informasi UHTP</div>
            <div class="footer-copy">Dibuat dengan dedikasi untuk pembelajar Indonesia</div>
        </div>
    </div>
</footer>

</body>
</html>