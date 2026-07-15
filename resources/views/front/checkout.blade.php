<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — {{ $course->name }} | LearnZikri</title>
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
            --emerald: #0EA5A4;
            --emerald-soft: rgba(14,165,164,.12);
            --radius-l: 22px;
            --radius-m: 14px;
            --radius-s: 8px;
            --serif: 'Fraunces', serif;
            --sans: 'Inter', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--sans); background: var(--paper); color: var(--text); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* Navbar */
        .navbar { background: var(--ink); padding: 20px 48px; display: flex; justify-content: space-between; align-items: center; }
        .navbar-logo { font-family: var(--serif); font-weight: 700; font-size: 22px; color: #fff; }
        .navbar-logo span { color: var(--gold); font-style: italic; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 13.5px; font-weight: 600; border-radius: 100px; padding: 12px 26px; border: 1px solid transparent; cursor: pointer; transition: all .25s ease; text-decoration: none; }
        .btn-gold { background: var(--gold); color: var(--ink); }
        .btn-gold:hover { background: var(--gold-deep); color: #fff; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(245,158,11,.3); }
        .btn-outline { border: 1px solid rgba(255,255,255,.24); color: #fff; background: transparent; }
        .btn-outline:hover { background: rgba(255,255,255,.08); }

        /* Page layout */
        .page { max-width: 1000px; margin: 60px auto; padding: 0 24px; display: grid; grid-template-columns: 1.4fr 1fr; gap: 32px; align-items: start; }

        /* Left: Upload card */
        .upload-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius-l);
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .section-label {
            font-family: var(--mono);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--gold-deep);
            font-weight: 700;
            margin-bottom: 10px;
        }
        .card-title {
            font-family: var(--serif);
            font-size: 26px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
        }
        .card-subtitle {
            font-size: 14px;
            color: var(--text-soft);
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Bank info box */
        .bank-info {
            background: var(--ink);
            border-radius: var(--radius-m);
            padding: 24px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .bank-label { font-family: var(--mono); font-size: 11px; text-transform: uppercase; color: rgba(255,255,255,.5); margin-bottom: 6px; }
        .bank-name { font-size: 15px; font-weight: 700; color: #fff; }
        .bank-number { font-family: var(--mono); font-size: 22px; font-weight: 700; color: var(--gold); letter-spacing: 2px; }
        .copy-btn {
            background: rgba(245,158,11,.15);
            border: 1px solid rgba(245,158,11,.3);
            color: var(--gold);
            padding: 8px 16px;
            border-radius: var(--radius-s);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            font-family: var(--mono);
        }
        .copy-btn:hover { background: var(--gold); color: var(--ink); }

        /* Upload area */
        .upload-area {
            border: 2px dashed var(--line);
            border-radius: var(--radius-m);
            padding: 36px 24px;
            text-align: center;
            cursor: pointer;
            transition: all .25s ease;
            background: var(--paper-2);
            margin-bottom: 24px;
            position: relative;
        }
        .upload-area:hover, .upload-area.dragover { border-color: var(--gold); background: var(--gold-soft); }
        .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-icon { font-size: 40px; margin-bottom: 12px; }
        .upload-text { font-weight: 600; font-size: 15px; color: var(--ink); margin-bottom: 4px; }
        .upload-subtext { font-size: 13px; color: var(--text-soft); }
        .upload-preview { max-width: 100%; max-height: 200px; border-radius: var(--radius-s); margin-top: 16px; object-fit: contain; display: none; }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: var(--gold);
            color: var(--ink);
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 100px;
            cursor: pointer;
            transition: all .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .submit-btn:hover { background: var(--gold-deep); color: #fff; transform: translateY(-2px); box-shadow: 0 10px 30px rgba(245,158,11,.35); }

        .error-text { color: #ef4444; font-size: 13px; margin-top: 6px; }

        /* Right: Summary card */
        .summary-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius-l);
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 24px;
        }
        .summary-title { font-family: var(--serif); font-size: 20px; font-weight: 600; margin-bottom: 20px; }
        .course-thumb {
            width: 100%;
            height: 140px;
            border-radius: var(--radius-m);
            object-fit: cover;
            background: linear-gradient(135deg, var(--ink), var(--ink-2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .course-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .course-name { font-family: var(--serif); font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .course-meta { font-size: 13px; color: var(--text-soft); margin-bottom: 4px; }
        .divider { border: none; border-top: 1px dashed var(--line); margin: 20px 0; }
        .price-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .price-label { font-size: 14px; color: var(--text-soft); }
        .price-value { font-size: 14px; font-weight: 600; color: var(--text); }
        .total-row { display: flex; justify-content: space-between; align-items: center; }
        .total-label { font-size: 16px; font-weight: 700; color: var(--ink); }
        .total-value { font-family: var(--serif); font-size: 22px; font-weight: 700; color: var(--gold-deep); }

        .feature-list { list-style: none; margin-top: 20px; display: flex; flex-direction: column; gap: 10px; }
        .feature-list li { display: flex; align-items: center; gap: 10px; font-size: 13.5px; color: var(--text-soft); }
        .feature-list li::before { content: '✓'; width: 20px; height: 20px; background: var(--emerald-soft); color: var(--emerald); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }

        /* Success alert */
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 14px 20px; border-radius: var(--radius-s); margin-bottom: 20px; font-size: 14px; font-weight: 500; }

        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .navbar { padding: 16px 20px; }
            .upload-card { padding: 28px 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('front.index') }}" class="navbar-logo">Learn<span>Zikri</span></a>
    <a href="{{ route('front.details', $course->slug) }}" class="btn btn-outline">← Kembali ke Detail</a>
</nav>

<div class="page">
    <!-- Left: Form -->
    <div class="upload-card">
        <p class="section-label">Pembayaran</p>
        <h1 class="card-title">Transfer & Upload Bukti</h1>
        <p class="card-subtitle">Transfer ke rekening di bawah, lalu upload foto/screenshot bukti transfer kamu. Tim kami akan mengkonfirmasi dalam 1×24 jam.</p>

        <!-- Bank Info -->
        <div class="bank-info">
            <div>
                <p class="bank-label">Transfer ke</p>
                <p class="bank-name">Bank BCA — a.n. LearnZikri</p>
                <p class="bank-number" id="bankNumber">1234 5678 9012</p>
            </div>
            <button class="copy-btn" onclick="copyNumber()">Salin</button>
        </div>

        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:14px 20px; border-radius:var(--radius-s); margin-bottom:20px; font-size:14px; font-weight:500;">
                ⚠ {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('front.checkout.store', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Upload Area -->
            <div class="upload-area" id="uploadArea">
                <input type="file" name="proof" accept="image/png,image/jpg,image/jpeg" id="proofInput" onchange="previewFile(this)" required>
                <div class="upload-icon">📎</div>
                <p class="upload-text">Klik atau drag foto bukti transfer</p>
                <p class="upload-subtext">PNG, JPG, JPEG — Maks. 2MB</p>
                <img id="uploadPreview" class="upload-preview" alt="Preview">
            </div>
            @error('proof')
                <p class="error-text">⚠ {{ $message }}</p>
            @enderror

            <button type="submit" class="submit-btn">
                <span>📤</span>
                Kirim Bukti & Tunggu Konfirmasi
            </button>
        </form>
    </div>

    <!-- Right: Order Summary -->
    <div class="summary-card">
        <h2 class="summary-title">Ringkasan Pesanan</h2>

        <div class="course-thumb">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}">
            @else
                📚
            @endif
        </div>

        <div class="course-name">{{ $course->name }}</div>
        <p class="course-meta">🏷 Kategori: {{ $course->category->name }}</p>
        <p class="course-meta">👨‍🏫 Instruktur: {{ $course->teacher->user->name }}</p>
        <p class="course-meta">🎬 {{ $course->videos->count() }} Video Pembelajaran</p>
        <p class="course-meta">📊 Tingkat: {{ ucfirst($course->difficulty) }}</p>

        <hr class="divider">

        <div class="price-row">
            <span class="price-label">Harga Kursus</span>
            <span class="price-value">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
        </div>
        <div class="price-row">
            <span class="price-label">Akses</span>
            <span class="price-value" style="color: var(--emerald); font-weight: 700;">30 Hari</span>
        </div>

        <hr class="divider">

        <div class="total-row">
            <span class="total-label">Total</span>
            <span class="total-value">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
        </div>

        <ul class="feature-list">
            <li>Akses semua video kursus</li>
            <li>Sertifikat penyelesaian</li>
            <li>Akses selama 30 hari</li>
            <li>Pembayaran manual & aman</li>
        </ul>
    </div>
</div>

<script>
function previewFile(input) {
    const preview = document.getElementById('uploadPreview');
    const uploadArea = document.getElementById('uploadArea');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            uploadArea.querySelector('.upload-icon').textContent = '✅';
            uploadArea.querySelector('.upload-text').textContent = input.files[0].name;
            uploadArea.querySelector('.upload-subtext').textContent = (input.files[0].size / 1024).toFixed(0) + ' KB';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function copyNumber() {
    const number = document.getElementById('bankNumber').textContent.replace(/\s/g,'');
    navigator.clipboard.writeText(number).then(() => {
        const btn = document.querySelector('.copy-btn');
        btn.textContent = 'Tersalin ✓';
        setTimeout(() => btn.textContent = 'Salin', 2000);
    });
}

// Drag and drop
const uploadArea = document.getElementById('uploadArea');
uploadArea.addEventListener('dragover', (e) => { e.preventDefault(); uploadArea.classList.add('dragover'); });
uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    const dt = e.dataTransfer;
    if (dt.files.length) {
        document.getElementById('proofInput').files = dt.files;
        previewFile(document.getElementById('proofInput'));
    }
});
</script>

</body>
</html>