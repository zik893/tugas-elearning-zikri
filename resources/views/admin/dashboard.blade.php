<x-app-layout>
    <x-slot name="header">{{ Auth::user()->hasRole('owner') ? 'Owner Dashboard' : 'Dashboard' }}</x-slot>

    @role('owner')
    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--blue-soft);">🎬</div>
            <div>
                <div class="stat-label">Total Courses</div>
                <div class="stat-value">{{ $courses }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--gold-soft);">💳</div>
            <div>
                <div class="stat-label">Transactions</div>
                <div class="stat-value">{{ $transactions }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--emerald-soft);">👩‍🎓</div>
            <div>
                <div class="stat-label">Students</div>
                <div class="stat-value">{{ $students }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(139,92,246,.1);">👨‍🏫</div>
            <div>
                <div class="stat-label">Teachers</div>
                <div class="stat-value">{{ $teachers }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(236,72,153,.1);">🏷️</div>
            <div>
                <div class="stat-label">Categories</div>
                <div class="stat-value">{{ $categories }}</div>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="card" style="padding: 28px;">
        <h2 style="font-family: var(--serif); font-size: 20px; font-weight: 700; margin-bottom: 18px; color: var(--text-dark);">Quick Actions</h2>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">+ New Course</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-ghost">+ New Category</a>
            <a href="{{ route('admin.subscribe_transactions.index') }}" class="btn btn-ghost">View Transactions</a>
            <a href="{{ route('front.index') }}" class="btn btn-ghost" target="_blank">↗ View Website</a>
        </div>
    </div>
    @endrole

    @role('teacher')
    <div class="stats-grid" style="grid-template-columns: repeat(2, 1fr); max-width: 480px;">
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--blue-soft);">🎬</div>
            <div>
                <div class="stat-label">My Courses</div>
                <div class="stat-value">{{ $courses }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--emerald-soft);">👩‍🎓</div>
            <div>
                <div class="stat-label">My Students</div>
                <div class="stat-value">{{ $students }}</div>
            </div>
        </div>
    </div>
    <div class="card" style="padding: 28px; max-width: 480px; margin-top: 20px;">
        <h2 style="font-family: var(--serif); font-size: 20px; font-weight: 700; margin-bottom: 14px;">Quick Actions</h2>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">+ New Course</a>
            <a href="{{ route('front.index') }}" class="btn btn-ghost" target="_blank">↗ View Site</a>
        </div>
    </div>
    @endrole

    @role('student')
    <div class="card" style="padding: 40px; max-width: 560px;">
        <div style="font-size: 48px; margin-bottom: 16px;">🎓</div>
        <h2 style="font-family: var(--serif); font-size: 26px; font-weight: 700; margin-bottom: 10px;">Upgrade Skills Today</h2>
        <p style="color: var(--text-soft); margin-bottom: 24px; font-size: 15px; line-height: 1.6;">
            Grow your career with experienced teachers in LearnZikri. Explore hundreds of curated courses.
        </p>
        <a href="{{ route('front.index') }}" class="btn btn-primary">Explore Catalog →</a>
    </div>
    @endrole
</x-app-layout>
