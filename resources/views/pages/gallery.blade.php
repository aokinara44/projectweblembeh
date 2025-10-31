<?php
// Lokasi File: resources/views/pages/gallery.blade.php
?>
<x-main-layout>
    @section('title', __('gallery.title') . ' - Rumah Selam Lembeh')
    @section('description', __('gallery.subtitle'))

    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPLigppBRTavQAtXk9zw9rw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .glightbox-clean .gslide-description { background: rgba(0,0,0,0.7) !important; padding: 10px 15px !important; }
            .glightbox-clean .gslide-title { margin-bottom: 5px !important; color: #fff !important; }
            .glightbox-clean .gdesc-inner { color: #eee !important; }
            [x-cloak] { display: none !important; }
        </style>
    @endpush

    <div class="bg-white">
        <section
            x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, interval: null,
                      next() { this.current = (this.current + 1) % this.images.length; },
                      prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; },
                      startSlider() { if (this.images.length > 1) { this.interval = setInterval(() => { this.next() }, 5000); } },
                      stopSlider() { clearInterval(this.interval); this.interval = null; },
                      initComponent() { this.startSlider(); }
                    }"
            x-init="initComponent()"
            @mouseenter="stopSlider"
            @mouseleave="startSlider"
            class="relative h-[60vh] sm:h-[70vh] md:h-[80vh] bg-gray-900 text-white overflow-hidden"
        >
            <template x-for="(image, index) in images" :key="index">
                <div
                    class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out"
                    :style="'background-image: url(\\'' + image + '\\');'"
                    x-show="current === index"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                    <div class="absolute inset-0 bg-black opacity-30"></div>
                </div>
            </template>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center z-10 p-4">
                 <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-shadow-lg">{{ __('gallery.title') }}</h1>
                 <p class="mt-4 text-lg sm:text-xl lg:text-2xl text-shadow max-w-2xl">{{ __('gallery.subtitle') }}</p>
            </div>
            <template x-if="images.length > 1">
                <div class="absolute inset-y-0 left-0 flex items-center z-10">
                    <button @click="prev()" class="p-2 sm:p-4 text-white opacity-70 hover:opacity-100 focus:outline-none">
                         <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                </div>
            </template>
            <template x-if="images.length > 1">
                 <div class="absolute inset-y-0 right-0 flex items-center z-10">
                    <button @click="next()" class="p-2 sm:p-4 text-white opacity-70 hover:opacity-100 focus:outline-none">
                       <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </template>
        </section>

        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50"
                 x-data="{
                     selectedCategorySlug: 'all',
                     categories: {{ json_encode($galleryCategories->map(function($cat) {
                         return [
                             'slug' => $cat->slug,
                             'name' => $cat->getTranslation('name', app()->getLocale()),
                             'galleries' => $cat->galleries->map(function($gal) {
                                 return [
                                     'id' => $gal->id,
                                     'image_url' => Storage::url($gal->image_path),
                                     'title' => $gal->getTranslation('title', app()->getLocale()) ?? '',
                                     'category_slug' => $gal->galleryCategory->slug ?? ''
                                 ];
                             })->all()
                         ];
                     })) }},
                     lightbox: null,
                     init() {
                         this.lightbox = GLightbox({
                             selector: '.glightbox',
                             touchNavigation: true,
                             loop: false,
                             autoplayVideos: true,
                             titleSource: 'data-title',
                             descriptionSource: 'data-title',
                             descPosition: 'bottom',
                         });
                         this.$watch('selectedCategorySlug', () => {
                             this.$nextTick(() => {
                                 if (this.lightbox) {
                                     this.lightbox.reload();
                                 }
                             });
                         });
                     }
                 }"
                 x-cloak>

            <div class="max-w-7xl mx-auto">
                <div class="mb-12 flex flex-wrap justify-center gap-2 sm:gap-4">
                    <button @click="selectedCategorySlug = 'all'"
                            :class="{
                                'bg-yellow-400 text-blue-800 font-semibold shadow-md ring-2 ring-yellow-500 ring-offset-1': selectedCategorySlug === 'all',
                                'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-800 border border-gray-300': selectedCategorySlug !== 'all'
                            }"
                            class="px-4 py-2 rounded-full text-sm sm:text-base transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                        {{ __('gallery.all_categories') }}
                    </button>
                    <template x-for="category in categories" :key="category.slug">
                        <button @click="selectedCategorySlug = category.slug"
                                :class="{
                                    'bg-yellow-400 text-blue-800 font-semibold shadow-md ring-2 ring-yellow-500 ring-offset-1': selectedCategorySlug === category.slug,
                                    'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-800 border border-gray-300': selectedCategorySlug !== category.slug
                                }"
                                class="px-4 py-2 rounded-full text-sm sm:text-base transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                                x-text="category.name">
                        </button>
                    </template>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <template x-for="category in categories" :key="'cat-' + category.slug">
                        <template x-for="gallery in category.galleries" :key="gallery.id">
                            <div x-show="selectedCategorySlug === 'all' || selectedCategorySlug === gallery.category_slug"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-90"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-90"
                                 class="relative group overflow-hidden rounded-lg shadow-md aspect-square bg-gray-200">
                                <a :href="gallery.image_url"
                                   class="glightbox block w-full h-full"
                                   :data-gallery="'gallery-' + (selectedCategorySlug === 'all' ? 'all' : category.slug)"
                                   :data-title="gallery.title"
                                   :data-description="gallery.title">
                                    <img :src="gallery.image_url"
                                         :alt="gallery.title"
                                         loading="lazy"
                                         class="w-full h-full object-cover transform transition duration-500 ease-in-out group-hover:scale-110 group-hover:brightness-75">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                         <svg class="w-10 h-10 text-white drop-shadow-md" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <h3 class="text-white text-sm font-medium truncate" x-text="gallery.title"></h3>
                                    </div>
                                </a>
                            </div>
                        </template>
                    </template>
                     <div x-show="!categories.length || categories.flatMap(c => c.galleries).filter(g => selectedCategorySlug === 'all' || selectedCategorySlug === g.category_slug).length === 0"
                          class="col-span-full text-center text-gray-500 py-10">
                         {{ __('gallery.no_images_in_category') }}
                     </div>
                </div>

                 {{-- Pastikan ini adalah baris 183 --}}
                 @if($galleryCategories->isEmpty() && !$errors->any())
                    <p class="col-span-full text-center text-gray-500 py-10">{{ __('gallery.no_galleries_yet') }}</p>
                 @endif

            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
</x-main-layout>