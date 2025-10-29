<?php

// Lokasi File: app/Http/Controllers/Admin/ExploreCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExploreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str untuk slug

class ExploreCategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori explore.
     */
    public function index()
    {
        $categories = ExploreCategory::latest()->paginate(10);
        return view('admin.explore-categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori explore baru.
     */
    public function create()
    {
        return view('admin.explore-categories.create');
    }

    /**
     * Menyimpan kategori explore baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array|min:1',
            'name.en' => 'required|string|max:255', // Wajib ada minimal bahasa Inggris
            'name.nl' => 'nullable|string|max:255',
            'name.zh' => 'nullable|string|max:255',
        ]);

        // Buat slug dari nama bahasa Inggris
        $validated['slug'] = Str::slug($validated['name']['en']);

        ExploreCategory::create($validated);

        return redirect()->route('admin.explore-categories.index')
                         ->with('success', 'Explore category created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit kategori explore.
     */
    public function edit(ExploreCategory $exploreCategory) // Route model binding
    {
        return view('admin.explore-categories.edit', compact('exploreCategory'));
    }

    /**
     * Memperbarui kategori explore di database.
     */
    public function update(Request $request, ExploreCategory $exploreCategory) // Route model binding
    {
        $validated = $request->validate([
            'name' => 'required|array|min:1',
            'name.en' => 'required|string|max:255',
            'name.nl' => 'nullable|string|max:255',
            'name.zh' => 'nullable|string|max:255',
        ]);

        // Buat slug baru HANYA jika nama EN berubah
        if ($exploreCategory->getTranslation('name', 'en', false) !== $validated['name']['en']) {
            $validated['slug'] = Str::slug($validated['name']['en']);
        }

        $exploreCategory->update($validated);

        return redirect()->route('admin.explore-categories.index')
                         ->with('success', 'Explore category updated successfully.');
    }

    /**
     * Menghapus kategori explore dari database.
     */
    public function destroy(ExploreCategory $exploreCategory) // Route model binding
    {
        // Periksa relasi sebelum menghapus (opsional tapi bagus)
        // if ($exploreCategory->explorePosts()->count() > 0) {
        //     return redirect()->route('admin.explore-categories.index')
        //                      ->with('error', 'Cannot delete category with associated posts.');
        // }

        $exploreCategory->delete();

        return redirect()->route('admin.explore-categories.index')
                         ->with('success', 'Explore category deleted successfully.');
    }
}