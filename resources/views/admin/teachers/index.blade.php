<x-app-layout>
    <x-slot name="header">Manage Teachers</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        @forelse($teachers as $teacher)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid var(--card-border);">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, #0D1117, #1a2333); display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; color: var(--gold); flex-shrink: 0;">
                        {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--text-dark);">{{ $teacher->user->name }}</div>
                        <div style="font-size: 13px; color: var(--text-soft);">{{ $teacher->user->email }}</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    @if($teacher->is_active ?? true)
                        <span class="badge badge-green">✓ Active</span>
                    @else
                        <span class="badge badge-red">✕ Inactive</span>
                    @endif
                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus teacher ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">🗑 Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div style="padding: 60px; text-align: center; color: var(--text-soft);">
                <div style="font-size: 40px; margin-bottom: 12px;">👨‍🏫</div>
                <p style="font-size: 15px;">Belum ada teacher.</p>
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary" style="margin-top: 16px;">Tambah Teacher Pertama</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
