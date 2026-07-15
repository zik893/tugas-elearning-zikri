<x-app-layout>
    <x-slot name="header">New Category</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">← Back</a>
    </x-slot>

    <div class="card" style="max-width: 560px; padding: 36px;">
        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom: 20px;">
                ⚠ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Category Name</label>
                <input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="e.g. Web Development" required autofocus>
                @error('name') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="icon">Category Icon / Thumbnail</label>
                <input class="form-input" type="file" id="icon" name="icon" accept="image/*" required>
                <p style="font-size: 12px; color: var(--text-soft); margin-top: 5px;">PNG, JPG — maks 2MB</p>
                @error('icon') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</x-app-layout>