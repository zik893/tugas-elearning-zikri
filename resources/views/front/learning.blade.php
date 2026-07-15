<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar: {{ $courseVideo->name }} — {{ $course->name }}</title>
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

        .learning-container { display: grid; grid-template-columns: 2.5fr 1fr; min-height: calc(100vh - 80px); }
        .video-section { padding: 40px; background: var(--paper-2); display: flex; flex-direction: column; gap: 24px; }
        
        .video-player-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: var(--radius-l);
            background: #000;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .video-player-wrapper iframe,
        .video-player-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-title { font-family: var(--serif); font-size: 28px; font-weight: 600; color: var(--ink); }
        .course-info-tag { font-family: var(--mono); font-size: 12px; color: var(--gold-deep); text-transform: uppercase; font-weight: bold; }
        
        .sidebar { background: #fff; border-left: 1px solid var(--line); display: flex; flex-direction: column; }
        .sidebar-header { padding: 24px; border-bottom: 1px solid var(--line); }
        .sidebar-title { font-family: var(--serif); font-size: 18px; font-weight: 600; }
        .video-list { list-style: none; overflow-y: auto; flex-grow: 1; }
        .video-item-link { display: flex; align-items: center; gap: 12px; padding: 20px 24px; border-bottom: 1px solid var(--line); transition: background .2s; }
        .video-item-link:hover { background: var(--paper-2); }
        .video-item-link.active { background: var(--gold-soft); border-left: 4px solid var(--gold); }
        .video-number { font-family: var(--mono); font-size: 12px; color: var(--text-soft); }
        .video-name { font-size: 14.5px; font-weight: 500; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('front.details', $course->slug) }}" class="navbar-logo">Learn<span>Zikri</span></a>
    <a href="{{ route('front.details', $course->slug) }}" class="btn btn-outline">← Kembali ke Detail Kelas</a>
</nav>

<div class="learning-container">
    <div class="video-section">
        <div class="video-player-wrapper">
            @if(str_contains($courseVideo->video_url, 'youtube.com') || str_contains($courseVideo->video_url, 'youtu.be'))
                @php
                    // Extract youtube video id
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $courseVideo->video_url, $match);
                    $youtube_id = $match[1] ?? '';
                @endphp
                @if($youtube_id)
                    <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}" allowfullscreen></iframe>
                @else
                    <div style="display:flex; justify-content:center; align-items:center; height:100%; color:#fff; font-family:var(--sans);">URL Video YouTube tidak valid</div>
                @endif
            @else
                <video src="{{ $courseVideo->video_url }}" controls></video>
            @endif
        </div>
        <div>
            <span class="course-info-tag">{{ $course->name }}</span>
            <h1 class="video-title">{{ $courseVideo->name }}</h1>
        </div>
    </div>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">Daftar Materi Kelas</h2>
        </div>
        <div class="video-list">
            @foreach($course->videos as $index => $v)
                <a href="{{ route('front.learning', [$course, $v]) }}" class="video-item-link {{ $courseVideo->id == $v->id ? 'active' : '' }}">
                    <span class="video-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="video-name">{{ $v->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

</body>
</html>
