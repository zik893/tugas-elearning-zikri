<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\SubscribeTransaction;
use App\Models\User;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('owner')) {
            $courses = Course::count();
            $transactions = SubscribeTransaction::count();
            $students = User::role('student')->count();
            $teachers = Teacher::count();
            $categories = Category::count();

            return view('admin.dashboard', compact('courses', 'transactions', 'students', 'teachers', 'categories'));
        } 
        
        if ($user->hasRole('teacher')) {
            // As a teacher, show their own courses and students
            $teacher = Teacher::where('user_id', $user->id)->first();
            $courses = Course::where('teacher_id', $teacher->id)->count();
            
            // Get unique students that subscribed to their courses (this might be complex, let's keep it simple for now)
            $students = SubscribeTransaction::where('is_paid', true)
                ->whereHas('course', function($query) use ($teacher) {
                    $query->where('teacher_id', $teacher->id);
                })->distinct('user_id')->count('user_id');

            return view('admin.dashboard', compact('courses', 'students'));
        }

        // Default to student
        return view('admin.dashboard');
    }
}
