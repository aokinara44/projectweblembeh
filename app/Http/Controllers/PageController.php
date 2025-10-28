<?php

// Lokasi File: app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
    /**
     * Mengambil daftar gambar hero dari folder public.
     * Mengembalikan URL absolut menggunakan asset().
     */
    private function getHeroImages(): array
    {
        $heroImages = [];
        $heroPath = public_path('images/hero'); // Path fisik ke direktori
        $relativePath = 'images/hero'; // Path relatif dari public/

        if (File::isDirectory($heroPath)) {
            $files = File::files($heroPath);
            foreach ($files as $file) {
                // Gunakan asset() untuk membuat URL yang benar
                $heroImages[] = asset($relativePath . '/' . $file->getFilename());
            }
        }
        // Fallback jika tidak ada gambar
        if (empty($heroImages)) {
            $heroImages[] = 'https://placehold.co/1600x900/003366/FFFFFF?text=Rumah+Selam+Lembeh';
        }
        return $heroImages;
    }

    /**
     * Menampilkan halaman Home.
     */
    public function home()
    {
        $featuredServices = \App\Models\Service::with('serviceCategory')->latest()->take(5)->get();
        $latestReviews = \App\Models\Review::where('is_visible', true)->orderBy('created_at', 'desc')->take(5)->get();
        $heroImages = $this->getHeroImages();
        return view('welcome', compact('featuredServices', 'latestReviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Services (Semua Kategori).
     */
    public function services()
    {
        $serviceCategories = ServiceCategory::with('services')->orderBy('name->en', 'asc')->get();
        $heroImages = $this->getHeroImages();
        // Kirim null sebagai selectedCategory
        return view('pages.services', compact('serviceCategories', 'heroImages'))->with('selectedCategory', null);
    }

    /**
     * Method BARU: Menampilkan halaman Services untuk kategori tertentu.
     */
    public function servicesByCategory(Request $request)
    {
        $categorySlug = $request->route('categorySlug');
        $trimmedSlug = trim($categorySlug ?? '');

        if (empty($trimmedSlug)) {
            abort(404);
        }

        // Cari kategori berdasarkan slug
        $serviceCategory = ServiceCategory::where('slug', $trimmedSlug)->firstOrFail();

        // Eager load services
        $serviceCategory->load('services');
        $heroImages = $this->getHeroImages();
        // Kirim objek kategori yang ditemukan sebagai selectedCategory
        return view('pages.services', compact('heroImages'))->with('selectedCategory', $serviceCategory);
    }

    /**
     * Menampilkan halaman Gallery.
     */
    public function gallery()
    {
        $galleryCategories = \App\Models\GalleryCategory::with('galleries')->orderBy('name->en', 'asc')->get();
        $heroImages = $this->getHeroImages();
        return view('pages.gallery', compact('galleryCategories', 'heroImages'));
    }

    /**
     * Menampilkan halaman Dive Spots.
     */
    public function diveSpots()
    {
         $heroImages = $this->getHeroImages();
         return view('pages.divespots', compact('heroImages'));
    }

    /**
     * Menampilkan halaman Reviews.
     */
    public function reviews()
    {
        $reviews = \App\Models\Review::where('is_visible', true)->orderBy('created_at', 'desc')->paginate(10);
        $heroImages = $this->getHeroImages();
        return view('pages.reviews', compact('reviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Contact.
     */
    public function contact()
    {
         $heroImages = $this->getHeroImages();
         return view('pages.contact', compact('heroImages'));
    }

    /**
     * Menangani submit form Contact.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            // Logika pengiriman email (contoh)
            // Mail::to('admin@example.com')->send(new ContactFormMail($validated));

            return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('success', __('contact.form.success'));
        } catch (\Exception $e) {
             // Log::error($e->getMessage());
             return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('error', __('contact.form.error'));
        }
    }
}

