<?php

// Lokasi File: app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Ditambahkan
use App\Models\ServiceCategory; // Ditambahkan

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menambahkan View Composer untuk layout 'main'
        View::composer('layouts.main', function ($view) {
            // Mengambil semua kategori layanan, diurutkan berdasarkan nama (terjemahan bahasa Inggris)
            // Hanya ambil ID, Name, dan Slug untuk efisiensi
            $serviceCategoriesForNav = ServiceCategory::orderBy('name->en', 'asc')
                                        ->select('id', 'name', 'slug')
                                        ->get();
            
            // Mengirim data ke view dengan nama variabel 'serviceCategoriesForNav'
            $view->with('serviceCategoriesForNav', $serviceCategoriesForNav);
        });
    }
}