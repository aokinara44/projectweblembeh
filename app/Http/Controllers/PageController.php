<?php

// Lokasi File: app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

// Hapus use model yang tidak perlu jika ada (GalleryCategory, Review, Service, ServiceCategory)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    /**
     * Mengambil daftar gambar hero dari folder public.
     */
    private function getHeroImages(): array
    {
        $heroImages = [];
        $heroPath = public_path('images/hero');
        if (File::isDirectory($heroPath)) {
            $files = File::files($heroPath);
            foreach ($files as $file) {
                $heroImages[] = 'images/hero/' . $file->getFilename();
            }
        }
        return $heroImages;
    }

    /**
     * Menampilkan halaman Home.
     */
    public function home()
    {
        // Kode ini tetap sama
        $featuredServices = \App\Models\Service::with('serviceCategory')->latest()->take(5)->get();
        $latestReviews = \App\Models\Review::where('is_visible', true)->orderBy('created_at', 'desc')->take(5)->get();
        $heroImages = $this->getHeroImages();
        return view('welcome', compact('featuredServices', 'latestReviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Services.
     */
    public function services()
    {
        // Kode ini tetap sama
        $serviceCategories = \App\Models\ServiceCategory::with('services')->orderBy('name', 'asc')->get();
        $heroImages = $this->getHeroImages();
        return view('pages.services', compact('serviceCategories', 'heroImages'));
    }

    /**
     * Menampilkan halaman Gallery.
     */
    public function gallery()
    {
        // Kode ini tetap sama
        $galleryCategories = \App\Models\GalleryCategory::with('galleries')->orderBy('name', 'asc')->get();
        $heroImages = $this->getHeroImages();
        return view('pages.gallery', compact('galleryCategories', 'heroImages'));
    }

    /**
     * Menampilkan halaman Dive Spots.
     */
    public function diveSpots()
    {
         // !! PERUBAHAN: Hanya kirim heroImages !!
         $heroImages = $this->getHeroImages();
         return view('pages.divespots', compact('heroImages')); // Tidak perlu $diveSpots lagi
    }

    /**
     * Menampilkan halaman Reviews.
     */
    public function reviews()
    {
        // Kode ini tetap sama
        $reviews = \App\Models\Review::where('is_visible', true)->orderBy('created_at', 'desc')->paginate(10);
        $heroImages = $this->getHeroImages();
        return view('pages.reviews', compact('reviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Contact.
     */
    public function contact()
    {
         // Kode ini tetap sama
         $heroImages = $this->getHeroImages();
         return view('pages.contact', compact('heroImages'));
    }

    /**
     * Menangani submit form Contact.
     */
    public function submitContact(Request $request)
    {
        // Kode ini tetap sama
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('success', __('contact.form.success'));
        } catch (\Exception $e) {
             return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('error', __('contact.form.error'));
        }
    }
}