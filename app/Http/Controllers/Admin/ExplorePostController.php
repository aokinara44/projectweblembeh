<?php

// Lokasi File: app/Http/Controllers/Admin/ExplorePostController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExplorePost;
use App\Models\ExploreCategory; // Import ExploreCategory
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str untuk slug
use Illuminate\Support\Facades\Storage; // Import Storage untuk file

class ExplorePostController extends Controller
{
    /**
     * Menampilkan daftar post explore.
     */
    public function index()
    {
        // Eager load relasi exploreCategory untuk efisiensi
        $posts = ExplorePost::with('exploreCategory')->latest()->paginate(10);
        return view('admin.explore-posts.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat post explore baru.
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = ExploreCategory::orderBy('name->en')->get();
        return view('admin.explore-posts.create', compact('categories'));
    }

    /**
     * Menyimpan post explore baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'explore_category_id' => 'required|exists:explore_categories,id',
            'title' => 'required|array|min:1',
            'title.en' => 'required|string|max:255',
            'title.nl' => 'nullable|string|max:255',
            'title.zh' => 'nullable|string|max:255',
            'content' => 'required|array|min:1',
            'content.en' => 'required|string', // Konten wajib minimal EN
            'content.nl' => 'nullable|string',
            'content.zh' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi gambar
            'is_published' => 'nullable|boolean', // Status publikasi
        ]);

        // Buat slug dari judul bahasa Inggris
        $validated['slug'] = Str::slug($validated['title']['en']);
        // Handle status publikasi (jika checkbox tidak dicentang, nilainya null)
        $validated['is_published'] = $request->has('is_published');

        // Handle upload gambar
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('explore_posts', 'public');
        }

        ExplorePost::create($validated);

        return redirect()->route('admin.explore-posts.index')
                         ->with('success', 'Explore post created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit post explore.
     */
    public function edit(ExplorePost $explorePost) // Route model binding
    {
        $categories = ExploreCategory::orderBy('name->en')->get();
        return view('admin.explore-posts.edit', compact('explorePost', 'categories'));
    }

    /**
     * Memperbarui post explore di database.
     */
    public function update(Request $request, ExplorePost $explorePost) // Route model binding
    {
        $validated = $request->validate([
            'explore_category_id' => 'required|exists:explore_categories,id',
            'title' => 'required|array|min:1',
            'title.en' => 'required|string|max:255',
            'title.nl' => 'nullable|string|max:255',
            'title.zh' => 'nullable|string|max:255',
            'content' => 'required|array|min:1',
            'content.en' => 'required|string',
            'content.nl' => 'nullable|string',
            'content.zh' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        // Buat slug baru HANYA jika judul EN berubah
        if ($explorePost->getTranslation('title', 'en', false) !== $validated['title']['en']) {
             $validated['slug'] = Str::slug($validated['title']['en']);
        }
        $validated['is_published'] = $request->has('is_published');

        // Handle upload gambar (hapus yang lama jika ada yang baru)
        if ($request->hasFile('featured_image')) {
            // Hapus gambar lama jika ada
            if ($explorePost->featured_image && Storage::disk('public')->exists($explorePost->featured_image)) {
                Storage::disk('public')->delete($explorePost->featured_image);
            }
            // Simpan gambar baru
            $validated['featured_image'] = $request->file('featured_image')->store('explore_posts', 'public');
        }

        $explorePost->update($validated);

        return redirect()->route('admin.explore-posts.index')
                         ->with('success', 'Explore post updated successfully.');
    }

    /**
     * Menghapus post explore dari database.
     */
    public function destroy(ExplorePost $explorePost) // Route model binding
    {
         // Hapus gambar terkait jika ada
        if ($explorePost->featured_image && Storage::disk('public')->exists($explorePost->featured_image)) {
            Storage::disk('public')->delete($explorePost->featured_image);
        }

        $explorePost->delete();

        return redirect()->route('admin.explore-posts.index')
                         ->with('success', 'Explore post deleted successfully.');
    }
}