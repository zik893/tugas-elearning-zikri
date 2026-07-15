<x-app-layout>
    <x-slot name="header">New Teacher</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-ghost">← Back</a>
    </x-slot>

    <div class="card" style="max-width: 520px; padding: 36px;">
        @if($errors->any())
            <div class="alert alert-error">⚠ {{ $errors->first() }}</div>
        @endif

        <p style="font-size: 14px; color: var(--text-soft); margin-bottom: 24px; line-height: 1.6;">
            Masukkan email user yang sudah terdaftar. User tersebut akan mendapatkan role <strong>Teacher</strong>.
        </p>

        <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email User</label>
                <input class="form-input" type="email" id="email" name="email"
                       value="{{ old('email') }}" placeholder="teacher@example.com" required autofocus>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 8px;">
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Teacher</button>
            </div>
        </form>
    </div>
</x-app-layout>
