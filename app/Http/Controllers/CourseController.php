<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('owner')) {
            $courses = Course::with(['category', 'teacher.user'])->get();
        } else {
            $teacher = Teacher::where('user_id', Auth::id())->firstOrFail();
            $courses = Course::with(['category', 'teacher.user'])
                ->where('teacher_id', $teacher->id)
                ->get();
        }
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = Teacher::with('user')->get();
        return view('admin.courses.create', compact('categories', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'teacher_id'  => 'required|exists:teachers,id',
            'about'       => 'required|string',
            'difficulty'  => 'required|in:beginner,intermediate,advanced',
            'thumbnail'   => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            Course::create([
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'category_id' => $request->category_id,
                'teacher_id'  => $request->teacher_id,
                'about'       => $request->about,
                'difficulty'  => $request->difficulty,
                'thumbnail'   => $thumbnailPath,
            ]);
        });

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course berhasil ditambahkan!');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        $teachers = Teacher::with('user')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'teacher_id'  => 'required|exists:teachers,id',
            'about'       => 'required|string',
            'difficulty'  => 'required|in:beginner,intermediate,advanced',
            'thumbnail'   => 'sometimes|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        DB::transaction(function () use ($request, $course) {
            $thumbnailPath = $course->thumbnail;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }
            $course->update([
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'category_id' => $request->category_id,
                'teacher_id'  => $request->teacher_id,
                'about'       => $request->about,
                'difficulty'  => $request->difficulty,
                'thumbnail'   => $thumbnailPath,
            ]);
        });

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course berhasil diupdate!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')
            ->with('success', 'Course berhasil dihapus!');
    }
}