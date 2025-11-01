{{-- resources/views/pages/explore/muck-diving.blade.php --}}
<x-main-layout :title="__('Muck Diving in Lembeh')">

    {{-- 1. Hero Section --}}
    <div class="relative pt-32 pb-24 bg-cover bg-center" style="background-image: url('https://placehold.co/1920x800/2a3e52/FFFFFF?text=Muck+Diving+Lembeh+Strait');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="container mx-auto px-4 relative z-10 text-white text-center">
            <h1 class="text-5xl font-extrabold mb-4 animate-fade-in-up">
                {{ __('Experience the Wonders of Muck Diving in Lembeh Strait') }}
            </h1>
            <p class="text-xl font-light mb-8 animate-fade-in-up delay-200">
                {{ __('Uncover the hidden gems of the underwater world with Rumah Selam Dive Center.') }}
            </p>
            
            {{-- --- AWAL PERBAIKAN --- --}}
            {{-- Mengganti route('page.show', ...) dengan route('contact', ...) --}}
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105 animate-fade-in-up delay-400">
                {{ __('Book Your Dive Trip Now!') }}
            </a>
            {{-- --- AKHIR PERBAIKAN --- --}}

        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Konten Utama (Kiri) --}}
            <div class="lg:w-2/3">

                {{-- 2. Apa itu Muck Diving? --}}
                <section id="what-is-muck-diving" class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 border-b-2 border-blue-500 pb-2">
                        {{ __('Apa Sebenarnya Muck Diving itu?') }}
                    </h2>
                    <div class="flex flex-col md:flex-row gap-6 mb-6">
                        <div class="md:w-1/2">
                            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                {{ __('Muck Diving (atau selam lumpur) adalah jenis penyelaman yang berfokus pada eksplorasi dasar laut berpasir atau berlumpur. Berbeda dengan terumbu karang yang penuh warna, lokasi muck diving mungkin terlihat "kosong" pada pandangan pertama.') }}
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ __('Namun, di sinilah letak keajaibannya. Dasar laut ini adalah rumah bagi makhluk-makhluk (critter) paling aneh, langka, dan ahli kamuflase di planet ini. Anda akan mencari hewan-hewan makro unik yang tidak akan Anda temukan di tempat lain.') }}
                            </p>
                        </div>
                        <div class="md:w-1/2">
                            <img src="https://placehold.co/800x600/5d6d7e/ffffff?text=Muck+Diving+Critter+(Contoh:+Frogfish)"
                                alt="Muck Diving Critter" class="rounded-lg shadow-xl w-full h-auto object-cover">
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ __('Selat Lembeh secara global diakui sebagai "Ibu Kota Muck Diving Dunia". Pasir vulkanik hitam kami yang kaya nutrisi adalah latar belakang sempurna yang membuat warna-warni critter seperti Nudibranch, Frogfish, Hairy Shrimp, Mimic Octopus, dan Flamboyant Cuttlefish semakin menonjol.') }}
                    </p>
                </section>

                {{-- 3. Galeri Critter --}}
                <section id="critter-gallery" class="mb-12">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                        {{ __('Makhluk Unik yang Bisa Anda Temui') }}
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <img src="https://placehold.co/400x400/8e44ad/ffffff?text=Hairy+Frogfish"
                            alt="Hairy Frogfish" class="rounded-lg shadow-lg aspect-square object-cover">
                        <img src="https://placehold.co/400x400/e67e22/ffffff?text=Flamboyant+Cuttlefish"
                            alt="Flamboyant Cuttlefish" class="rounded-lg shadow-lg aspect-square object-cover">
                        <img src="https://placehold.co/400x400/3498db/ffffff?text=Mimic+Octopus" alt="Mimic Octopus"
                            class="rounded-lg shadow-lg aspect-square object-cover">
                        <img src="https://placehold.co/400x400/2ecc71/ffffff?text=Nudibranch+(Beragam)"
                            alt="Nudibranch" class="rounded-lg shadow-lg aspect-square object-cover">
                    </div>
                </section>

                {{-- 5. Peta Dive Site --}}
                <section id="dive-map">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 border-b-2 border-blue-500 pb-2">
                        {{ __('Peta Dive Site Rumah Selam') }}
                    </h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        {{ __('Jelajahi lokasi penyelaman utama kami di Selat Lembeh. Pemandu kami akan membawa Anda ke tempat-tempat terbaik berdasarkan kondisi dan apa yang ingin Anda lihat.') }}
                    </p>
                    <div class="w-full aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 rounded-lg shadow-xl overflow-hidden">
                        {{-- Ini adalah iframe yang Anda berikan --}}
                        <iframe
                            src="https://www.google.com/maps/d/embed?mid=1LM899nZl_RiWG0rh6399utb_zFA7HNI&ehbc=2E312F&noprof=1"
                            width="100%"
                            height="480"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </section>

            </div>

            {{-- Sidebar (Kanan) --}}
            <div class="lg:w-1/3">
                {{-- 4. Mengapa Memilih Rumah Selam --}}
                <aside class="sticky top-28 bg-blue-50 dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                        {{ __('Mengapa Muck Diving bersama Rumah Selam?') }}
                    </h3>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <span class="block bg-blue-500 text-white rounded-full p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Pemandu Lokal "Mata Elang"') }}</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('Pemandu kami lahir dan besar di Lembeh. Mereka memiliki mata setajam elang yang terlatih untuk menemukan critter terkecil dan paling terkamuflase yang sering terlewatkan oleh orang lain.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <span class="block bg-blue-500 text-white rounded-full p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-2.144M12 6v12M9 20h.01M3 20h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Rasio Grup Kecil') }}</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('Kami membatasi penyelam per pemandu (rasio maks 1:4, seringkali lebih kecil) untuk memastikan Anda mendapatkan pelayanan personal, tidak terburu-buru, dan memiliki banyak ruang untuk melihat & memotret.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <span class="block bg-blue-500 text-white rounded-full p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Ramah Fotografer') }}</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('Kami mengerti kebutuhan fotografer. Pemandu kami ahli dalam menemukan subjek, membantu pencahayaan (jika diminta), dan sabar menunggu Anda mendapatkan "perfect shot".') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <span class="block bg-blue-500 text-white rounded-full p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Fasilitas & Keamanan') }}</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('Nikmati penyelaman dari kapal yang nyaman dengan kru yang sigap. Semua peralatan kami terawat dengan baik dan kami mengutamakan standar keselamatan tertinggi.') }}</p>
                            </div>
                        </li>
                    </ul>
                    
                    {{-- --- AWAL PERBAIKAN --- --}}
                    {{-- Mengganti route('page.show', ...) dengan route('contact', ...) --}}
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
                       class="mt-8 w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                        {{ __('Pesan Petualangan Muck Diving Anda!') }}
                    </a>
                    {{-- --- AKHIR PERBAIKAN --- --}}

                </aside>
            </div>

        </div>
    </div>
</x-main-layout>