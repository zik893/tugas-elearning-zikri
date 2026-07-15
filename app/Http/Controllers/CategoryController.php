<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $iconPath = $request->file('icon')->store('icons', 'public');

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'icon' => $iconPath,
            ]);
        });

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil ditambahkan!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $iconPath = $category->icon;

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
            }

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'icon' => $iconPath,
            ]);
        });

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil dihapus!');
    }
}