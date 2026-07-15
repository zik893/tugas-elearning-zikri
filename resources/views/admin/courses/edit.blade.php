<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-2 px-4">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $course->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="teacher_id" :value="__('Teacher')" />
                        <select name="teacher_id" id="teacher_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Teacher --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="difficulty" :value="__('Difficulty')" />
                        <select name="difficulty" id="difficulty" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Difficulty --</option>
                            <option value="beginner" {{ old('difficulty', $course->difficulty) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('difficulty', $course->difficulty) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('difficulty', $course->difficulty) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea id="about" name="about" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ old('about', $course->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="Current Thumbnail" class="w-32 h-24 object-cover rounded-lg mb-2">
                        @endif
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti thumbnail.</p>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.courses.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                            Cancel
                        </a>
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>