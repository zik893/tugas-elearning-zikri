<x-app-layout>
    <x-slot name="header">Manage Categories</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        @forelse($categories as $category)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid var(--card-border);">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}"
                         style="width: 56px; height: 56px; border-radius: 12px; object-fit: cover; background: var(--content-bg);">
                    <div>
                        <div style="font-weight: 700; font-size: 15px; color: var(--text-dark);">{{ $category->name }}</div>
                        <div style="font-size: 12px; font-family: var(--mono); color: var(--text-soft); margin-top: 3px;">
                            {{ $category->slug ?? Str::slug($category->name) }}
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 12px; color: var(--text-soft); margin-right: 8px;">
                        {{ $category->created_at->format('d M Y') }}
                    </span>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-ghost" style="padding: 8px 18px; font-size: 13px;">
                        ✏ Edit
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 8px 18px; font-size: 13px;">
                            🗑 Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div style="padding: 60px; text-align: center; color: var(--text-soft);">
                <div style="font-size: 40px; margin-bottom: 12px;">🏷️</div>
                <p style="font-size: 15px;">Belum ada kategori.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-top: 16px;">Tambah Kategori Pertama</a>
            </div>
        @endforelse
    </div>
</x-app-layout>