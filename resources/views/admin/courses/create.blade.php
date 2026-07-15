<x-app-layout>
    <x-slot name="header">New Course</x-slot>
    <x-slot name="headerActions">
        <a href="{{ route('admin.courses.index') }}" class="btn btn-ghost">← Back</a>
    </x-slot>

    <div class="card" style="max-width: 680px; padding: 36px;">
        @if($errors->any())
            <div class="alert alert-error">⚠ {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" for="name">Course Name</label>
                    <input class="form-input" type="text" id="name" name="name"
                           value="{{ old('name') }}" placeholder="e.g. Belajar Laravel dari Nol" required>
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="category_id">Category</label>
                    <select class="form-input" name="category_id" id="category_id" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="teacher_id">Instructor</label>
                    <select class="form-input" name="teacher_id" id="teacher_id" required>
                        <option value="">— Pilih Teacher —</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="difficulty">Difficulty Level</label>
                    <select class="form-input" name="difficulty" id="difficulty" required>
                        <option value="">— Pilih Level —</option>
                        <option value="beginner" {{ old('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('difficulty') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="thumbnail">Thumbnail</label>
                    <input class="form-input" type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
                    <p style="font-size: 12px; color: var(--text-soft); margin-top: 4px;">PNG, JPG — maks 2MB</p>
                    @error('thumbnail') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" for="about">Deskripsi Kursus</label>
                    <textarea class="form-input" id="about" name="about" rows="5"
                              placeholder="Ceritakan apa yang akan dipelajari dalam kursus ini..." required>{{ old('about') }}</textarea>
                    @error('about') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 8px;">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Course</button>
            </div>
        </form>
    </div>
</x-app-layout>