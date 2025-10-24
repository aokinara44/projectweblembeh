<?php

// Lokasi File: routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SetLocale; // <-- Pastikan ini di-import

/*
|--------------------------------------------------------------------------
| GRUP 1: RUTE NON-LOCALE (ADMIN, AUTH, SISTEM)
|--------------------------------------------------------------------------
| Rute ini TIDAK akan memiliki prefix /en, /id, dll.
| URL-nya tetap: /login, /admin/dashboard, /sitemap.xml
*/

// Rute Auth (login, logout, dll.)
// Kita panggil SetLocale di sini agar halaman login bisa
// menampilkan bahasa yang benar (berdasarkan session).
Route::middleware(SetLocale::class)->group(function () {
    require __DIR__ . '/auth.php';
});

// Rute Admin (WAJIB setelah login)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Kita panggil SetLocale lagi di sini agar admin panel 
    // juga menggunakan bahasa dari session.
    Route::middleware(SetLocale::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Name: admin.dashboard
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('gallery-categories', GalleryCategoryController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('users', UserController::class);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');   // Name: admin.profile.edit
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Name: admin.profile.update
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');// Name: admin.profile.destroy
    });
});

// Rute Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'generate'])->name('sitemap');


/*
|--------------------------------------------------------------------------
| GRUP 2: RUTE PUBLIK (WAJIB DENGAN LOCALE)
|--------------------------------------------------------------------------
| Rute ini WAJIB memiliki prefix /en, /id, dll.
*/
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(SetLocale::class) // Middleware dijalankan di sini untuk mengambil {locale} dari URL
    ->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('home'); // Name: home
        Route::get('/services', [PageController::class, 'services'])->name('services'); // Name: services
        Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');   // Name: gallery
        Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews');   // Name: reviews
        Route::get('/divespots', [PageController::class, 'diveSpots'])->name('divespots'); // Name: divespots
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');     // Name: contact
        Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit'); // Name: contact.submit
    });

/*
|--------------------------------------------------------------------------
| GRUP 3: REDIRECT (PENANGKAP)
|--------------------------------------------------------------------------
| Mengarahkan pengunjung yang salah URL (tanpa locale) ke URL yang benar.
*/

// 1. Redirect jika akses root (/) tanpa locale
Route::get('/', function () {
    // Ambil locale dari session atau fallback, lalu redirect
    $locale = session('locale', config('app.fallback_locale', 'en'));
    // Redirect ke route 'home' yang sudah BENAR (punya prefix)
    return redirect()->route('home', ['locale' => $locale]);
});

// 2. Redirect rute publik lain yang salah (tanpa locale)
// PENTING: Ini harus ditaruh di PALING BAWAH
Route::get('/{path}', function ($path) {
    // Daftar rute publik Anda (sesuai dengan yang ada di GRUP 2)
    $publicPaths = ['services', 'gallery', 'reviews', 'divespots', 'contact'];
    
    if (in_array($path, $publicPaths)) {
        $locale = session('locale', config('app.fallback_locale', 'en'));
        // Redirect ke URL yang benar
        return redirect(url($locale . '/' . $path));
    }
    
    // Jika tidak ada di daftar, biarkan Laravel menangani (akan jadi 404 Not Found)
    abort(404);

})->where('path', '^(?!admin|login|logout|register|forgot-password|reset-password|sitemap\.xml|_ignition|storage|build|favicon\.ico).*$');
// Regex di atas (where) penting untuk MENGECUALIKAN path admin/login dll.
// agar tidak tertangkap oleh redirect ini.
