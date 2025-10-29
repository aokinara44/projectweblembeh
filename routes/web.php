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
use App\Http\Middleware\SetLocale;

/*
|--------------------------------------------------------------------------
| GRUP 1: RUTE NON-LOCALE (ADMIN, AUTH, SISTEM)
|--------------------------------------------------------------------------
*/
Route::middleware(SetLocale::class)->group(function () {
    require __DIR__ . '/auth.php';
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(SetLocale::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('gallery-categories', GalleryCategoryController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('users', UserController::class);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::get('/sitemap.xml', [SitemapController::class, 'generate'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| GRUP 2: RUTE PUBLIK (WAJIB DENGAN LOCALE)
|--------------------------------------------------------------------------
*/
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(SetLocale::class) // Middleware diterapkan di sini untuk seluruh grup
    ->group(function () {
        
        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/services', [PageController::class, 'services'])->name('services');
        Route::get('/services/{categorySlug}', [PageController::class, 'servicesByCategory'])->name('services.category');
        Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
        Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews');
        Route::get('/divespots', [PageController::class, 'diveSpots'])->name('divespots');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
        
        // Middleware individual tidak lagi diperlukan di sini
    });

/*
|--------------------------------------------------------------------------
| GRUP 3: REDIRECT (PENANGKAP)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $locale = session('locale', config('app.fallback_locale', 'en'));
    return redirect()->route('home', ['locale' => $locale]);
});

Route::get('/{path}', function ($path) {
    $publicPaths = ['services', 'gallery', 'reviews', 'divespots', 'contact'];
    $locale = session('locale', config('app.fallback_locale', 'en'));

    if (in_array($path, $publicPaths)) {
        return redirect(url($locale . '/' . $path));
    }

    if (preg_match('/^services\/([a-z0-9-]+)$/', $path, $matches)) {
        $categorySlug = $matches[1];
        return redirect()->route('services.category', ['locale' => $locale, 'categorySlug' => $categorySlug]);
    }

    abort(404);

})->where('path', '^(?!admin|login|logout|register|forgot-password|reset-password|sitemap\.xml|_ignition|storage|build|favicon\.ico).*$');