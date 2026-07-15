<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} — LearnDafa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #FAF9F5; color: #101114; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }

        /* NAV */
        .navbar { background: #0B0B0D; padding: 18px 48px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .navbar-logo { font-weight: 800; font-size: 20px; color: #fff; letter-spacing: -0.5px; }
        .navbar-logo span { color: #F0B429; }
        .navbar-links { display: flex; gap: 32px; }
        .navbar-links a { color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500; transition: color .2s; }
        .navbar-links a:hover { color: #F0B429; }
        .navbar-actions { display: flex; gap: 10px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 14px; font-weight: 600; border-radius: 100px; padding: 12px 24px; border: none; cursor: pointer; transition: all .25s; }
        .btn-gold { background: #F0B429; color: #0B0B0D; }
        .btn-gold:hover { background: #fff; }
        .btn-outline { border: 1.5px solid rgba(255,255,255,.3); color: #fff; background: transparent; }
        .btn-outline:hover { border-color: #F0B429; color: #F0B429; }

        /* PAGE HEADER */
        .page-header { background: linear-gradient(135deg, #0B0B0D 0%, #1a1a2e 50%, #16213e 100%); padding: 64px 48px; position: relative; overflow: hidden; }
        .page-header::before { content: ''; position: absolute; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(240,180,41,.15), transparent 70%); top: -200px; right: -100px; }
        .page-header-inner { max-width: 1200px; margin: 0 auto; position: relative; z-index: 2; }
        .breadcrumb { font-size: 13px; color: rgba(255,255,255,.5); margin-bottom: 16px; }
        .breadcrumb a { color: #F0B429; }
        .page-eyebrow { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #F0B429; margin-bottom: 12px; }
        .page-title { font-size: clamp(28px, 4vw, 44px); font-weight: 800; color: #fff; letter-spacing: -0.5px; margin-bottom: 12px; }
        .page-desc { font-size: 15px; color: rgba(255,255,255,.6); max-width: 520px; }

        /* SECTION */
        .section { padding: 64px 48px 100px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }

        /* COURSES */
        .courses-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
        .course-card { background: #fff; border-radius: 20px; overflow: hidden; transition: all .3s; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
        .course-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.12); }
        .course-thumbnail { width: 100%; height: 200px; object-fit: cover; }
        .course-thumbnail-placeholder { width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; font-size: 48px; }
        .course-body { padding: 24px; }
        .course-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; padding: 5px 12px; border-radius: 100px; margin-bottom: 12px; }
        .badge-beginner { background: #D1FAE5; color: #065F46; }
        .badge-intermediate { background: #FEF3C7; color: #92400E; }
        .badge-advanced { background: #FEE2E2; color: #991B1B; }
        .course-title { font-size: 17px; font-weight: 700; color: #101114; line-height: 1.4; margin-bottom: 10px; }
        .course-teacher { font-size: 13px; color: #6B6B70; display: flex; align-items: center; gap: 6px; margin-bottom: 16px; }
        .course-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #E6E3D9; }
        .course-category { font-size: 12px; color: #C9860E; font-weight: 600; }
        .course-btn { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #101114; border: 1.5px solid #E6E3D9; border-radius: 100px; padding: 8px 18px; transition: all .2s; }
        .course-btn:hover { border-color: #F0B429; background: #F0B429; }

        .empty-state { text-align: center; padding: 60px 20px; color: #6B6B70; }

        /* FOOTER */
        .footer { background: #0B0B0D; color: #fff; padding: 60px 48px 32px; }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top { display: flex; justify-content: space-between; align-items: center; padding-bottom: 32px; border-bottom: 1px solid rgba(255,255,255,.1); margin-bottom: 24px; }
        .footer-logo { font-size: 20px; font-weight: 800; }
        .footer-logo span { color: #F0B429; }
        .footer-copy { font-size: 13px; color: rgba(255,255,255,.4); }
    </style>
</head>
<body>

{{-- NAV --}}
<nav class="navbar">
    <div class="navbar-logo">Learn<span>Dafa</span></div>
    <div class="navbar-links">
        <a href="{{ route('front.index') }}#categories">Kategori</a>
        <a href="{{ route('front.index') }}#courses">Kelas</a>
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

{{-- PAGE HEADER --}}
<section class="page-header">
    <div class="page-header-inner">
        <div class="breadcrumb">
            <a href="{{ route('front.index') }}">Beranda</a> / Kategori / {{ $category->name }}
        </div>
        <div class="page-eyebrow">Kategori Kelas</div>
        <h1 class="page-title">{{ $category->name }}</h1>
        <p class="page-desc">Menampilkan {{ $courses->count() }} kelas dalam kategori {{ $category->name }}.</p>
    </div>
</section>

{{-- COURSES --}}
<section class="section">
    <div class="section-inner">
        <div class="courses-grid">
            @forelse($courses as $course)
            <div class="course-card">
                @if($course->thumbnail)
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="course-thumbnail">
                @else
                    <div class="course-thumbnail-placeholder" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">📖</div>
                @endif
                <div class="course-body">
                    <span class="course-badge badge-{{ $course->difficulty }}">
                        {{ ucfirst($course->difficulty) }}
                    </span>
                    <div class="course-title">{{ $course->name }}</div>
                    <div class="course-teacher">
                        👨‍🏫 {{ $course->teacher->user->name }}
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
            <div class="empty-state" style="grid-column: 1 / -1;">
                Belum ada kelas tersedia di kategori ini.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-logo">Learn<span>Dafa</span></div>
            <p style="color:rgba(255,255,255,.5); font-size:14px;">Platform belajar online terpercaya untuk generasi digital Indonesia.</p>
        </div>
        <div class="footer-copy">
            © {{ date('Y') }} LearnDafa by Dafagiandra Dwi Maulana — Sistem Informasi UHTP
        </div>
    </div>
</footer>

</body>
</html>