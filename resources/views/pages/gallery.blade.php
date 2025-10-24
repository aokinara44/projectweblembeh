<?php
// Lokasi File: resources/views/pages/gallery.blade.php
?>
<x-main-layout>
    @section('title', 'Gallery - Rumah Selam Lembeh')
    @section('description', 'Explore stunning underwater photography from Lembeh Strait, featuring unique critters and vibrant marine life captured by our guests and guides.')

    @push('head')
        {{-- Lightbox CSS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPLigppBRTavQAtXk9zw9rw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .category-button { transition: all 0.3s ease; }
            .category-button.active { background-color: #FACC15; color: #1E3A8A; font-weight: 600; } /* yellow-400, blue-800 */
            .category-button:not(.active):hover { background-color: #DBEAFE; } /* blue-100 */
            .glightbox-clean .gslide-description { background: rgba(0,0,0,0.7) !important; padding: 10px 15px !important; }
            .glightbox-clean .gslide-title { margin-bottom: 5px !important; }
        </style>
    @endpush

    {{-- ========================================================== --}}
    {{-- Hero Section with Slider (Header Transparan) --}}
    {{-- ========================================================== --}}
    <section
        {{-- Gunakan pengecekan isset untuk variabel heroImages --}}
        x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, next() { if (this.images.length === 0) return; this.current = (this.current + 1) % this.images.length; }, init() { if (this.images.length > 1) { setInterval(() => { this.next() }, 5000); } } }"
        x-init="init()"
        {{-- Kunci: class absolute dan tinggi (h-[75vh]) --}}
        class="absolute inset-x-0 top-0 h-[75vh] md:h-[80vh] bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    >
        <template x-for="(image, index) in images" :key="index">
            <div
                class="absolute inset-0 bg-cover bg-center"
                {{-- Gunakan asset() helper dan path dari controller --}}
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

        {{-- Fallback jika tidak ada gambar hero --}}
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://placehold.co/1600x900/003366/FFFFFF?text=Rumah+Selam+Lembeh');"></div>

        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative z-10 text-center px-4 animate-fade-in-up">
            <h1 class="text-4xl md:text-5xl font-extrabold">{{ __('gallery.header.title') }}</h1>
            <p class="text-lg md:text-xl mt-2 text-gray-200">{{ __('gallery.header.description') }}</p>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- Wrapper Konten Galeri dengan Margin Top (Mendorong Konten Ke Bawah) --}}
    {{-- ========================================================== --}}
    <div class="mt-[75vh] md:mt-[80vh]">
        <section class="py-20 bg-gray-50" x-data="{ selectedCategory: 'all' }">
            <div class="container mx-auto px-6">
                {{-- Category Filters --}}
                <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-12">
                    <button @click="selectedCategory = 'all'"
                            :class="selectedCategory === 'all' ? 'active' : ''"
                            class="category-button px-4 py-2 rounded-full border border-gray-300 text-gray-700 bg-white font-medium text-sm md:text-base">
                        {{ __('All') }}
                    </button>
                    {{-- Pengecekan isset untuk menghindari error --}}
                    @if(isset($galleryCategories))
                        @foreach($galleryCategories as $category)
                            <button @click="selectedCategory = '{{ $category->slug }}'"
                                    :class="selectedCategory === '{{ $category->slug }}' ? 'active' : ''"
                                    class="category-button px-4 py-2 rounded-full border border-gray-300 text-gray-700 bg-white font-medium text-sm md:text-base">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    @endif
                </div>

                {{-- Image Grid --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                    {{-- !! PERBAIKAN BUG: Gunakan $galleryCategories di forelse !! --}}
                    @if(isset($galleryCategories))
                        @forelse($galleryCategories as $category)
                            @foreach ($category->galleries as $gallery)
                                <a href="{{ Storage::url($gallery->image_path) }}"
                                   class="glightbox block rounded-lg overflow-hidden shadow-md group relative aspect-square transition-opacity duration-300"
                                   data-gallery="gallery-{{ $category->slug }}"
                                   data-description="{{ $gallery->description ? e($gallery->description) : '' }}"
                                   data-title="{{ e($gallery->name) }}"
                                   :data-category-slug="'{{ $category->slug }}'"
                                   x-show="selectedCategory === 'all' || selectedCategory === '{{ $category->slug }}'"
                                   x-transition:enter="transition ease-out duration-300"
                                   x-transition:enter-start="opacity-0 scale-95"
                                   x-transition:enter-end="opacity-100 scale-100"
                                   x-transition:leave="transition ease-in duration-200"
                                   x-transition:leave-start="opacity-100 scale-100"
                                   x-transition:leave-end="opacity-0 scale-95"
                                   style="display: none;"
                                   x-cloak>
                                    <img src="{{ Storage::url($gallery->image_path) }}"
                                         alt="{{ $gallery->name }}"
                                         title="{{ $gallery->name }}"
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-300"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-300 flex items-end justify-center p-2">
                                        <p class="text-white text-xs text-center opacity-0 group-hover:opacity-100 transition duration-300 truncate">
                                            {{ $gallery->name }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @empty
                            <p class="col-span-full text-center text-gray-500 py-10">{{ __('No images found in the gallery yet.') }}</p>
                        @endforelse
                    @else
                        {{-- Fallback jika variabel $galleryCategories tidak di-pass sama sekali --}}
                        <p class="col-span-full text-center text-gray-500 py-10">{{ __('Error loading gallery categories.') }}</p>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        {{-- Lightbox JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const lightbox = GLightbox({
                    selector: '.glightbox',
                    touchNavigation: true,
                    loop: false,
                    titleSource: 'data-title',
                    descriptionSource: 'data-description',
                    descPosition: 'bottom',
                });
            });
        </script>
    @endpush

</x-main-layout>