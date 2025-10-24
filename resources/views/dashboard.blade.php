<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan Selamat Datang --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600">Berikut adalah ringkasan aktivitas di website Anda.</p>
                </div>
            </div>

            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                
                {{-- Total Layanan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.47 2.118v-.09a2.25 2.25 0 012.47-2.118a3 3 0 005.78-1.128zM15 5.25a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.47 2.118v-.09a2.25 2.25 0 012.47-2.118a3 3 0 005.78-1.128zM15 15.75a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.47 2.118v-.09a2.25 2.25 0 012.47-2.118a3 3 0 005.78-1.128z" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Layanan</p>
                                {{-- Variabel $serviceCount dikirim dari DashboardController --}}
                                <p class="text-2xl font-semibold text-gray-900">{{ $serviceCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Gambar --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Gambar Galeri</p>
                                {{-- Variabel $galleryCount dikirim dari DashboardController --}}
                                <p class="text-2xl font-semibold text-gray-900">{{ $galleryCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- !! KARTU REVIEW (PENGGANTI BOOKING) !! --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                {{-- Icon Bintang untuk Review --}}
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.31h5.518a.562.562 0 01.31.95l-4.22 3.07a.564.564 0 00-.17.618l1.58 4.722a.563.563 0 01-.815.618L12.001 15.3a.563.563 0 00-.618 0l-4.22 3.072a.563.563 0 01-.815-.618l1.58-4.722a.564.564 0 00-.17-.618L3.102 9.87a.563.563 0 01.31-.95h5.518a.563.563 0 00.475-.31L11.48 3.5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Review</p>
                                {{-- Variabel $reviewCount dikirim dari DashboardController --}}
                                <p class="text-2xl font-semibold text-gray-900">{{ $reviewCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- !! SEMUA BAGIAN "BOOKING TERBARU" DIHAPUS !! --}}

        </div>
    </div>
</x-app-layout>