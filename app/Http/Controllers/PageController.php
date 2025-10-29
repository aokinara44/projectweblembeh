<?php

// Lokasi File: app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
// !! TAMBAHKAN INI JIKA KITA MEMBUAT MODEL Article NANTI !!
// use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage; 
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
        $heroPath = public_path('images/hero'); 
        $relativePath = 'images/hero'; 

        if (File::isDirectory($heroPath)) {
            $files = File::files($heroPath);
            foreach ($files as $file) {
                $heroImages[] = asset($relativePath . '/' . $file->getFilename());
            }
        }
        
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
        // !! Kita mungkin tidak perlu $serviceCategories lagi di sini jika dropdown sudah dinamis !!
        // !! Tapi biarkan dulu untuk halaman /services !!
        $serviceCategories = ServiceCategory::with('services')->orderBy('name->en', 'asc')->get();
        $heroImages = $this->getHeroImages();
        return view('pages.services', compact('serviceCategories', 'heroImages'))->with('selectedCategory', null);
    }

    /**
     * Menampilkan halaman Services untuk kategori tertentu.
     */
    public function servicesByCategory(Request $request)
    {
        $categorySlug = $request->route('categorySlug');
        $trimmedSlug = trim($categorySlug ?? '');

        if (empty($trimmedSlug)) {
            abort(404);
        }

        $serviceCategory = ServiceCategory::where('slug', $trimmedSlug)->firstOrFail();
        $serviceCategory->load('services'); 
        $heroImages = $this->getHeroImages();

        // !! NANTI KITA AKAN TAMBAHKAN LOGIKA UNTUK MENGAMBIL ARTIKEL TERKAIT DI SINI !!
        // $relatedArticles = Article::where('service_category_id', $serviceCategory->id)->take(3)->get();

        // !! Kirim $relatedArticles ke view NANTI !!
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
     * Menampilkan halaman Explore (sebelumnya Dive Spots).
     */
    // !! PERUBAHAN NAMA METHOD: diveSpots -> explore !!
    public function explore()
    {
         $heroImages = $this->getHeroImages();
         // !! NANTI KITA AKAN AMBIL DATA ARTIKEL DI SINI !!
         // $articles = Article::latest()->paginate(9); 
         
         // !! PERUBAHAN NAMA VIEW: divespots -> explore !!
         // !! Kirim $articles ke view NANTI !!
         return view('pages.explore', compact('heroImages')); 
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