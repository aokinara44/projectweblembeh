<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Booking; // <-- DIHAPUS
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data statistik.
     */
    public function index()
    {
        // Ambil data statistik dari berbagai model
        $serviceCount = Service::count();
        $galleryCount = Gallery::count();
        $reviewCount = Review::count();
        // $pendingBookingsCount = Booking::where('status', 'pending')->count(); // <-- DIHAPUS
        // $recentBookings = Booking::latest()->take(5)->get(); // <-- DIHAPUS

        // Kirim semua data yang telah diambil ke view 'dashboard'
        return view('dashboard', compact(
            'serviceCount',
            'galleryCount',
            'reviewCount'
            // 'pendingBookingsCount', // <-- DIHAPUS
            // 'recentBookings' // <-- DIHAPUS
        ));
    }
}