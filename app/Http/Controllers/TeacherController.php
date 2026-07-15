<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'User with this email not found'])->withInput();
        }

        Teacher::create([
            'user_id' => $user->id,
            'is_active' => true,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'is_active' => 'nullable|boolean',
        ]);

        $teacher->update([
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : $teacher->is_active,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted');
    }
}
