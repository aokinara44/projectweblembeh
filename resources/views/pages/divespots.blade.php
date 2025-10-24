<?php
// Lokasi File: resources/views/pages/divespots.blade.php
use Illuminate\Support\Str; // Tambahkan ini jika Anda menggunakan Str::limit pada loop data asli
?>
<x-main-layout>
    {{-- SEO untuk halaman Dive Spots --}}
    @section('title', 'Lembeh Dive Spots - Rumah Selam Lembeh')
    @section('description', 'Explore the world-famous muck diving sites in Lembeh Strait with Rumah Selam Lembeh. Discover unique critters at sites like Nudi Falls, Hairball, and more.')

    {{-- ========================================================== --}}
    {{-- Hero Section with Slideshow (Header Transparan) --}}
    {{-- ========================================================== --}}
    <section
        {{-- Kita akan gunakan gambar hero yang sama dari PageController --}}
        x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, next() { if (this.images.length === 0) return; this.current = (this.current + 1) % this.images.length; }, init() { if (this.images.length > 1) { setInterval(() => { this.next() }, 5000); } } }"
        x-init="init()"
        {{-- Kunci: Atur posisi absolute dan tinggi (h-[75vh] md:h-[80vh]) --}}
        class="absolute inset-x-0 top-0 h-[75vh] md:h-[80vh] bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    >
        {{-- Slideshow --}}
        <template x-for="(image, index) in images" :key="index">
            <div
                class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                {{-- Menggunakan asset() helper dan path dari controller --}}
                :style="'background-image: url(\'' + '{{ asset('') }}' + image + '\');'"
                x-show="current === index"
                x-transition:enter="transition-opacity ease-in-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in-out duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>
        </template>
        
        {{-- Fallback jika tidak ada gambar --}}
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://placehold.co/1600x900/003366/FFFFFF?text=Rumah+Selam+Lembeh');"></div>
        
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        {{-- Teks Header --}}
        <div class="relative z-10 text-center px-4 fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">{{ __('Lembeh Dive Spots') }}</h1>
            <p class="text-lg md:text-xl mt-2">{{ __('The Muck Diving Capital of the World.') }}</p>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- Wrapper Konten Utama (Mendorong Konten Ke Bawah) --}}
    {{-- ========================================================== --}}
    {{-- Kunci: Margin top harus sama dengan tinggi hero section --}}
    <div class="mt-[75vh] md:mt-[80vh]">
        {{-- Konten Utama - Grid Dive Spots --}}
        {{-- Padding ditingkatkan ke py-20 lg:py-28 --}}
        <section class="py-20 lg:py-28 bg-white"> 
            <div class="container mx-auto px-6">
                
                {{-- Pendahuluan --}}
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ __('Discover Unique Critters') }}</h2>
                    <p class="text-gray-600 text-lg">
                        {{ __("Lembeh Strait is famous for its \"muck diving,\" where you'll find some of the rarest and most bizarre underwater creatures on Earth. Each dive site offers a unique adventure.") }}
                    </p>
                </div>

                {{-- Konten Placeholder (Jika Anda belum siap dengan data Model/Controller) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    {{-- Placeholder 1 --}}
                    <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in">
                        <img src="https://placehold.co/400x300/0284c7/ffffff?text=Nudi+Falls" 
                             alt="Nudi Falls Dive Site" 
                             class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold my-2 text-gray-900">{{ __('Nudi Falls') }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ __('Famous for the small waterfall on the cliffside, this site is a hotspot for various nudibranchs, frogfish, and shrimp living on the soft coral wall.') }}</p>
                            <span class="text-sm text-blue-500 font-semibold">{{ __('Nudibranchs, Frogfish') }}</span>
                        </div>
                    </div>

                    {{-- Placeholder 2 --}}
                    <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in" style="animation-delay: 0.2s;">
                        <img src="https://placehold.co/400x300/7c3aed/ffffff?text=Hairball" 
                             alt="Hairball Dive Site" 
                             class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold my-2 text-gray-900">{{ __('Hairball') }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ __('A classic muck site with a dark sand slope. Home to hairy frogfish, stargazers, mimic octopus, and countless other strange critters hiding in the sand.') }}</p>
                            <span class="text-sm text-blue-500 font-semibold">{{ __('Hairy Frogfish, Mimic Octopus') }}</span>
                        </div>
                    </div>

                    {{-- Placeholder 3 --}}
                    <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in" style="animation-delay: 0.4s;">
                        <img src="https://placehold.co/400x300/be123c/ffffff?text=Mawali+Wreck" 
                             alt="Mawali Wreck Dive Site" 
                             class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold my-2 text-gray-900">{{ __('Mawali Wreck') }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ __("A large Japanese cargo ship from WWII, now an amazing artificial reef. It's covered in corals and home to schools of fish, batfish, and macro life.") }}</p>
                            <span class="text-sm text-blue-500 font-semibold">{{ __('Wreck Dive, Batfish') }}</span>
                        </div>
                    </div>

                </div>
                <p class="text-center text-gray-500 mt-12">{{ __('...and many more sites waiting to be explored!') }}</p>
            </div>
        </section>
    </div>
</x-main-layout>