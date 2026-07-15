<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseVideo;
use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();

        return view('front.index', compact('courses', 'categories'));
    }

    public function details(Course $course)
    {
        return view('front.details', compact('course'));
    }

    public function category(Category $category)
    {
        $courses = Course::where('category_id', $category->id)->get();

        return view('front.category', compact('category', 'courses'));
    }

    public function pricing()
    {
        $courses = Course::all();

        return view('front.pricing', compact('courses'));
    }

    public function checkout(Course $course)
    {
        return view('front.checkout', compact('course'));
    }

    public function checkoutProcess(Request $request, Course $course)
    {
        $request->validate([
            'proof' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $proofPath = $request->file('proof')->store('proofs', 'public');

        SubscribeTransaction::create([
            'course_id'  => $course->id,
            'user_id'    => Auth::id(),
            'proof'      => $proofPath,
            'total_amount' => $course->price, // Pastikan field ini ada di DB jika diperlukan
            'is_paid'    => false,
        ]);

        return redirect()->route('front.index')->with('success', 'Bukti transfer berhasil dikirim, menunggu konfirmasi.');
    }

    public function learning(Course $course, CourseVideo $courseVideo)
    {
        // Pastikan user sudah subscribe
        if (!Auth::user()->hasActiveSubscription()) {
            return redirect()->route('front.checkout', $course)
                ->with('error', 'Kamu perlu berlangganan untuk mengakses materi ini.');
        }

        return view('front.learning', compact('course', 'courseVideo'));
    }
}