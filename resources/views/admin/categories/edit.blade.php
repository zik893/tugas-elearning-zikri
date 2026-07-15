<x-app-layout>
    <x-slot name="header">Edit Category</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">← Back</a>
    </x-slot>

    <div class="card" style="max-width: 560px; padding: 36px;">
        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom: 20px;">
                ⚠ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="name">Category Name</label>
                <input class="form-input" type="text" id="name" name="name"
                       value="{{ old('name', $category->name) }}" required>
                @error('name') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Current Icon</label>
                @if($category->icon)
                    <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}"
                         style="width: 72px; height: 72px; object-fit: cover; border-radius: 12px; border: 1px solid var(--card-border); margin-bottom: 12px;">
                @endif
                <label class="form-label" for="icon">Replace Icon (optional)</label>
                <input class="form-input" type="file" id="icon" name="icon" accept="image/*">
                <p style="font-size: 12px; color: var(--text-soft); margin-top: 5px;">Kosongkan jika tidak ingin mengubah icon.</p>
                @error('icon') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>
</x-app-layout>