<?php

// Lokasi File: app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;

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
        View::composer('layouts.main', function ($view) {

            $serviceCategoriesForNav = ServiceCategory::orderBy('name->en', 'asc')
                ->select('id', 'name', 'slug')
                ->get();

            $exploreCategoriesForNav = $this->getExploreNavItems();

            $view->with('serviceCategoriesForNav', $serviceCategoriesForNav)
                ->with('exploreCategoriesForNav', $exploreCategoriesForNav);
        });
    }

    /**
     * Mengambil item navigasi Explore dengan memindai folder views
     * dan menyimpannya di cache.
     */
    private function getExploreNavItems(): array
    {
        $cacheKey = 'explore_nav_items';
        $cacheTime = config('app.debug') ? 1 : 60 * 60 * 24; // 1 detik (debug) atau 24 jam (produksi)

        return Cache::remember($cacheKey, $cacheTime, function () {
            $items = [];
            $path = resource_path('views/pages/explore');

            if (!File::isDirectory($path)) {
                return [];
            }

            $files = File::files($path);

            foreach ($files as $file) {
                // --- AWAL PERBAIKAN ---
                $filename = $file->getFilename(); // Cth: "diving.blade.php"

                // 1. Kita cek manual untuk file .blade.php
                if (Str::endsWith($filename, '.blade.php')) {

                    // 2. Ambil nama file sebelum ".blade.php"
                    $slug = Str::before($filename, '.blade.php'); // Cth: "diving"

                    // 3. Lewati file 'index' jika ada (agar tidak jadi sub-menu)
                    if ($slug === 'index') {
                        continue;
                    }

                    // 4. Ganti ->ucwords() menjadi ->title() (Fix error asli)
                    $name = Str::of($slug)
                        ->replace('-', ' ')
                        ->replace('_', ' ')
                        ->title(); // Cth: "Diving"

                    $items[] = [
                        'name' => (string) $name,
                        'slug' => $slug,
                    ];
                }
                // --- AKHIR PERBAIKAN ---
            }

            return $items;
        });
    }
}