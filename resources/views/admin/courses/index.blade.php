<x-app-layout>
    <x-slot name="header">Manage Courses</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">+ Add Course</a>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        @forelse($courses as $course)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid var(--card-border);">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}"
                         style="width: 88px; height: 60px; border-radius: 10px; object-fit: cover; background: var(--content-bg);">
                    <div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--text-dark);">{{ $course->name }}</div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-top: 5px;">
                            <span class="badge badge-blue" style="font-size: 10px; padding: 2px 8px;">{{ $course->category->name }}</span>
                            <span class="badge badge-amber" style="font-size: 10px; padding: 2px 8px;">{{ ucfirst($course->difficulty) }}</span>
                            <span style="font-size: 12px; color: var(--text-soft);">{{ $course->videos->count() }} videos</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="text-align: right; margin-right: 8px;">
                        <div style="font-size: 11px; color: var(--text-soft);">Instructor</div>
                        <div style="font-size: 13px; font-weight: 600;">{{ $course->teacher->user->name }}</div>
                    </div>
                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-ghost" style="padding: 8px 16px; font-size: 13px;">Videos</a>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-ghost" style="padding: 8px 16px; font-size: 13px;">✏ Edit</a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus kursus ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">🗑</button>
                    </form>
                </div>
            </div>
        @empty
            <div style="padding: 60px; text-align: center; color: var(--text-soft);">
                <div style="font-size: 40px; margin-bottom: 12px;">🎬</div>
                <p style="font-size: 15px;">Belum ada kursus.</p>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary" style="margin-top: 16px;">Tambah Kursus Pertama</a>
            </div>
        @endforelse
    </div>
</x-app-layout>