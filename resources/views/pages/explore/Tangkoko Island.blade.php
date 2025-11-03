{{-- resources/views/pages/explore/diving.blade.php --}}

<x-main-layout :title="__('Diving in Lembeh - The Muck Diving Capital')">
 
    {{-- ========================================================== --}}
    {{-- HERO SECTION - TIDAK DIUBAH --}}
    {{-- ========================================================== --}}
    <section
        x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, next() { this.current = (this.current + 1) % this.images.length; }, init() { if (this.images.length > 1) { setInterval(() => { this.next() }, 5000); } } }"
        x-init="init()"
        class="absolute inset-x-0 top-0 h-[75vh] md:h-[80vh] bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    >
        <template x-for="(image, index) in images" :key="index">
             {{-- Menggunakan asset() untuk URL gambar --}}
            <div
                class="absolute inset-0 bg-cover bg-center"
                :style="'background-image: url(\'' + image + '\');'"
                x-show="current === index"
                x-transition:enter="transition-opacity ease-in-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in-out duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>
        </template>
        {{-- Fallback jika tidak ada gambar (Logika dari Anda) --}}
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://placehold.co/1600x900/003366/FFFFFF?text=Rumah+Selam+Lembeh');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 text-center px-4 animate-fade-in-up">
            
            <h1 class="text-4xl md:text-5xl font-extrabold">{{ isset($selectedCategory) ? $selectedCategory->name : __('explore.header.title') }}</h1>
            <p class="text-lg md:text-xl mt-2 text-gray-200">{{ isset($selectedCategory) ? __('Showing explore for category:') . ' ' . $selectedCategory->name : __('explore.header.description') }}</p>

        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- START KONTEN ARTIKEL BARU YANG DIPERPANJANG --}}
    {{-- ========================================================== --}}
    
    <div class="mt-[75vh] md:mt-[80vh]">
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">

                <div class="max-w-4xl mx-auto">

                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Welcome to the Muck Diving Capital</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        When many divers dream of colorful coral reefs and large pelagics, the Lembeh Strait offers something entirely different, unique, and arguably far more fascinating. Located in North Sulawesi, Indonesia, this narrow strait is known worldwide as the <strong>"World's Muck Diving Capital"</strong>.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Forget the crystal-clear blue expanse for a moment. Here, the adventure unfolds on dark, volcanic sand slopes, or "muck". It is here, among natural and man-made debris, that some of the strangest, rarest, and most photogenic creatures on the planet thrive.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">What Exactly is "Muck Diving"?</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Muck diving is an underwater treasure hunt. It’s all about spotting "critters" — small, bizarre creatures with perfect camouflage. The visibility here might not be crystal clear, but what you find will leave you speechless.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Unlike traditional reef diving, muck diving focuses on the sediment. This dark volcanic sand, which might look 'empty' at first glance, is the perfect camouflage for a staggering array of masters of disguise. It requires patience and a keen eye—or even better, one of our expert local guides!
                    </p>
                    
                    {{-- GAMBAR 1 - TIDAK DIUBAH --}}
                    <figure class="my-6">
                        <img src="{{ asset('images/hero/Coconut octopus (1).webp') }}" alt="Coconut Octopus in Lembeh Strait" class="rounded-lg shadow-md w-full">
                        <figcaption class="text-sm text-center text-gray-600 mt-2 italic">A Coconut Octopus (Amphioctopus marginatus) peers from its shell.</figcaption>
                    </figure>

                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">The Wonders That Await</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Lembeh Strait is a macro-photographer's paradise, home to an incredible density of "critters." Our experienced local dive guides at Rumah Selam Lembeh are experts at finding these elusive creatures, including:
                    </p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>Frogfish:</strong> From giant, hairy, and painted to the tiniest new recruits, these ambush predators are a highlight of Lembeh.</li>
                        <li><strong>Pygmy Seahorse:</strong> Spotting this fingernail-sized creature (like *Bargibanti* or *Denise's*) on a sea fan is a rewarding challenge.</li>
                        <li><strong>Mimic Octopus & Coconut Octopus:</strong> Witness the genius of the Mimic Octopus as it impersonates other sea creatures, or watch the Coconut Octopus cleverly use shells for protection.</li>
                        <li><strong>Flamboyant Cuttlefish:</strong> A tiny, psychedelic cuttlefish that "walks" along the seabed, flashing hypnotic colors.</li>
                        <li><strong>Nudibranchs:</strong> Hundreds of species of shell-less sea slugs in the most vibrant colors and patterns imaginable. Lembeh is a global hotspot for them.</li>
                        <li><strong>Rhinopias (Scorpionfish):</strong> The Weedy (Rhinopias frondosa) and Paddle-flap (Rhinopias eschmeyeri) are prized sightings for their rarity and bizarre beauty.</li>
                        <li><strong>Ghost Pipefish:</strong> Ornate, Harlequin, and Robust ghost pipefish hide perfectly among seagrass and crinoids, swaying in the current.</li>
                        <li><strong>Rare Crustaceans:</strong> Look for Hairy Shrimp, Zebra Crabs, Harlequin Shrimps, and the elusive Boxer Crab carrying its tiny anemone 'gloves'.</li>
                        <li><strong>And Many More:</strong> Stargazers, Snake Eels, Bobbit Worms, and countless species yet to be classified.</li>
                    </ul>

                    {{-- GAMBAR 2 & 3 - TIDAK DIUBAH --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                        <figure>
                            <img src="{{ asset('images/hero/Bullocky Nudibranch (1).webp') }}" alt="Bullocky Nudibranch in Lembeh Strait" class="rounded-lg shadow-md w-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A colorful Bullocky Nudibranch (Goniobranchus bullockii).</figcaption>
                        </figure>
                        <figure>
                            <img src="{{ asset('images/hero/weedy scorpion fish (Rhinophias) (1).webp') }}" alt="Weedy Scorpionfish (Rhinopias) in Lembeh Strait" class="rounded-lg shadow-md w-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A rare Weedy Scorpionfish (Rhinopias) perfectly camouflaged.</figcaption>
                        </figure>
                    </div>

                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Why Dive With Us? The Rumah Selam Difference</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Diving in Lembeh isn't just about jumping in the water; it's about knowledge. Without a trained eye, 90% of these wonders remain hidden in plain sight. At Rumah Selam Lembeh, we pride ourselves on our local guides. They grew up in these waters, they know where the critters "hang out," and they understand their behavior.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Our guides are not just divers; they are critter-finding artists. They carry magnifying glasses and pointers (not to touch, but to show) to point out creatures smaller than a grain of rice. We prioritize small groups (a maximum of 4 divers per guide) to ensure you get a personal, safe, and unforgettable experience, without crowding the delicate marine life.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">A Typical Dive Day</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        A day with Rumah Selam Lembeh is designed to be stress-free and full of discovery. We typically offer two morning dives and an optional third dive in the afternoon or evening (Night/Mandarin). You'll depart on our comfortable, spacious boat, enjoy a relaxing surface interval with hot coffee, tea, and snacks, and dive at sites carefully chosen based on the ocean conditions and, most importantly, what you want to see. All you need to do is relax, look, and be amazed.
                    </p>

                    {{-- Call to Action (Tidak Diubah) --}}
                    <div class="mt-12 bg-blue-50 dark:bg-gray-800 p-6 rounded-lg border-l-4 border-blue-500">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            Ready to Start Your Adventure?
                        </h4>
                        <p class="text-gray-700 dark:text-gray-300">
                            Our diving packages are designed to maximize your time underwater, whether you want two morning dives or to add a spectacular night dive. Let us show you why Lembeh Strait is a place like no other.
                        </p>
                        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="inline-block bg-yellow-400 text-gray-800 px-6 py-2 rounded-full font-semibold hover:bg-yellow-500 transition duration-300 ease-in-out shadow-md hover:shadow-lg mt-4">
                            {{ __('contact.form.button') }}
                        </a>
                    </div>
                    
                </div>
                
            </div>
        </section>
    </div>
    {{-- ========================================================== --}}
    {{-- AKHIR PERUBAHAN KONTEN --}}
    {{-- ========================================================== --}}
</x-main-layout>