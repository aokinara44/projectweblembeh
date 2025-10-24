<?php

// Lokasi File: app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    /**
     * Mengambil daftar gambar hero dari folder public.
     * Fungsi helper ini bisa dipanggil dari method lain.
     */
    private function getHeroImages(): array
    {
        $heroImages = [];
        $heroPath = public_path('images/hero');
        if (File::isDirectory($heroPath)) {
            $files = File::files($heroPath);
            foreach ($files as $file) {
                // Hanya ambil path relatif dari folder public
                $heroImages[] = 'images/hero/' . $file->getFilename();
            }
        }
        // Fallback jika tidak ada gambar
        if (empty($heroImages)) {
             // Anda bisa siapkan gambar default jika perlu
             // $heroImages = ['images/default-hero.jpg'];
        }
        return $heroImages;
    }

    /**
     * Menampilkan halaman Home.
     */
    public function home()
    {
        $featuredServices = Service::with('serviceCategory')->latest()->take(5)->get();
        $latestReviews = Review::where('is_visible', true)->orderBy('created_at', 'desc')->take(5)->get();
        $heroImages = $this->getHeroImages();

        return view('welcome', compact('featuredServices', 'latestReviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Services.
     */
    public function services()
    {
        $serviceCategories = ServiceCategory::with('services')->orderBy('name', 'asc')->get();
        $heroImages = $this->getHeroImages();

        return view('pages.services', compact('serviceCategories', 'heroImages'));
    }

    /**
     * Menampilkan halaman Gallery.
     */
    public function gallery()
    {
        $galleryCategories = GalleryCategory::with('galleries')->orderBy('name', 'asc')->get();
        $heroImages = $this->getHeroImages(); // Ambil gambar hero

        return view('pages.gallery', compact('galleryCategories', 'heroImages'));
    }

    /**
     * Menampilkan halaman Dive Spots.
     */
    public function diveSpots()
    {
         $heroImages = $this->getHeroImages(); // Ambil gambar hero
        return view('pages.divespots', compact('heroImages'));
    }

    /**
     * Menampilkan halaman Reviews.
     */
    public function reviews()
    {
        $reviews = Review::where('is_visible', true)->orderBy('created_at', 'desc')->paginate(10);
        $heroImages = $this->getHeroImages(); // Ambil gambar hero
        return view('pages.reviews', compact('reviews', 'heroImages'));
    }

    /**
     * Menampilkan halaman Contact.
     */
    public function contact()
    {
         $heroImages = $this->getHeroImages(); // Ambil gambar hero
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
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        try {
            // Logika pengiriman email Anda (jika ada)
            // Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));

            // Redirect ke halaman kontak dengan pesan sukses
            return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('success', __('contact.form.success', 'Thank you for your message! We will get back to you soon.'));

        } catch (\Exception $e) {
            // Log error jika perlu
            // \Illuminate\Support\Facades\Log::error($e->getMessage());

             // Redirect ke halaman kontak dengan pesan error
            return redirect()->route('contact', ['locale' => app()->getLocale()])
                             ->with('error', __('contact.form.error', 'Sorry, there was an error sending your message.'));
        }
    }
}

