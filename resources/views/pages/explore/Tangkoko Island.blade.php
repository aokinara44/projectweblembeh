{{-- resources/views/pages/explore/tangkoko.blade.php --}}

<x-main-layout :title="__('Tangkoko National Park - North Sulawesi\'s Wild Heart')">

    {{-- ========================================================== --}}
    {{-- HERO SECTION - STRUKTUR SAMA, KONTEN DISESUAIKAN --}}
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
        {{-- Fallback jika tidak ada gambar (Teks diubah untuk Tangkoko) --}}
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://placehold.co/1600x900/003366/FFFFFF?text=Tangkoko+National+Park');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 text-center px-4 animate-fade-in-up">
            
            {{-- Judul dan deskripsi disesuaikan untuk Tangkoko (fallback) --}}
            <h1 class="text-4xl md:text-5xl font-extrabold">{{ isset($selectedCategory) ? $selectedCategory->name : __('Tangkoko National Park') }}</h1>
            <p class="text-lg md:text-xl mt-2 text-gray-200">{{ isset($selectedCategory) ? __('Showing explore for category:') . ' ' . $selectedCategory->name : __('Explore the wild heart of North Sulawesi.') }}</p>

        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- START KONTEN ARTIKEL TANGKOKO --}}
    {{-- ========================================================== --}}
    
    <div class="mt-[75vh] md:mt-[80vh]">
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">

                <div class="max-w-4xl mx-auto">

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 1: PENGANTAR TANGKOKO --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">The Other Side of Paradise: A Journey into North Sulawesi’s Tangkoko National Park</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        When North Sulawesi is mentioned, the mind almost invariably plunges underwater. It conjures images of the world-renowned vertical coral walls of Bunaken National Park or the bizarre, sought-after critters lurking in the black volcanic sands of the Lembeh Strait. For decades, this province has built its reputation as a diver's mecca, a world of blue.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        But just an hour’s drive from the bustling port city of Bitung, a different kingdom exists. It is a world dominated not by blue, but by an overwhelming, profound green. This is Tangkoko-Batuangus National Park, the region's premier terrestrial treasure and a critical sanctuary for some of the most unique and endangered wildlife on Earth.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        For travelers willing to trade their fins for a pair of trekking boots, Tangkoko offers an accessible yet deeply immersive journey into a primal rainforest. It is a living laboratory of evolution, and a visit here is a powerful reminder that the wonders of North Sulawesi are not confined to its seas.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 2: SUASANA HUTAN --}}
                    {{-- ========================================================== --}}
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Forest Sanctuary</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The transition is immediate. The journey from Bitung snakes through villages and clove plantations, but as you approach the park boundaries, the noise of civilization fades, replaced by the rising hum of the forest. The moment you step under the canopy, the world changes.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The air becomes thick, humid, and still. The intense equatorial sun is filtered into soft, dappled rays that struggle to reach the forest floor. You find yourself standing among giants: massive, ancient Ficus trees, or strangler figs, whose buttress roots spread like architectural marvels across the dark, volcanic soil. The ground is a carpet of decaying leaves, crisscrossed by lianas as thick as a man's arm.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        This is not a silent place. The forest has a constant, overlapping soundtrack. A background thrum of thousands of insects provides the rhythm, while the sharp, varied calls of tropical birds—parrots, kingfishers, and pittas—provide the melody. It is a sensory immersion. The scent is of damp earth, rich decomposition, and the faint, sweet perfume of unseen flowers.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 3: PRIMATA (YAKI) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">The Charismatic Primates of Tangkoko</h2>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Black Crested Macaque (Yaki)</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        You will almost certainly hear the Yaki (*Macaca nigra*) before you see them. The sound of cracking branches, soft grunts, and the rustle of a large group moving through the undergrowth announces their arrival.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Suddenly, they are all around you. With their jet-black fur, striking punk-rocker crest of hair, and intelligent, expressive faces, the Black Crested Macaques are the park's most iconic residents. Unlike many primates, they spend a great deal of their time on the forest floor, foraging in large, complex social groups that can number over 50 individuals.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Observing them is like watching a live-action drama. Dominant males patrol the group's perimeter while mothers patiently groom their infants. Juveniles, full of energy, chase each other, wrestle, and tumble through the leaf litter.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        What is most remarkable is their indifference to human presence. Years of careful, respectful tourism mean the macaques are habituated. They will go about their daily business—foraging, playing, grooming, and squabbling—often just a few meters away. This allows for an incredibly intimate and photographic experience, offering a profound glimpse into the complex social lives of these critically endangered monkeys.
                    </p>

                    {{-- GAMBAR 1 (YAKI) - DIPERBARUI --}}
                    <figure class="my-6">
                        <img src="https://www.lembehresort.com/wp-content/uploads/Black-crested-macaque.jpg" alt="Black Crested Macaque (Yaki) in Tangkoko" class="rounded-lg shadow-md w-full">
                        <figcaption class="text-sm text-center text-gray-600 mt-2 italic">A Black Crested Macaque (Yaki) on the forest floor in Tangkoko.</figcaption>
                    </figure>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 4: PRIMATA (TARSIUS) --}}
                    {{-- ========================================================== --}}
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Spectral Tarsier</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        As the afternoon light begins to fade and the Yaki troops prepare to settle for the night, the objective of the trek shifts. The guides lead you to a different part of the forest, often to a specific, hollowed-out tree. And then, you wait.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        This is the second main event. As dusk settles and the jungle's daytime sounds are replaced by the chirps and clicks of nocturnal insects, you search for movement.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Then, from the darkness of its sleeping hole, a pair of enormous, luminous eyes will appear. This is the Spectral Tarsier (*Tarsius tarsier*), one of the smallest primates in the world. Barely larger than an adult's fist, this tiny, nocturnal creature is an evolutionary marvel. Its head can rotate nearly 180 degrees, and its eyes, relative to its body size, are the largest of any mammal.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        You will watch, mostly in silence, as the Tarsier family—usually a mated pair and their offspring—emerges. They cling vertically to trunks, their long, slender fingers and toes giving them an alien-like appearance. They communicate in high-pitched chirps before launching themselves with explosive power, leaping several meters from tree to tree to begin their nightly hunt for insects. The encounter is brief, conducted in low light to protect their sensitive eyes, but it is an unforgettable and captivating experience.
                    </p>

                    {{-- GAMBAR 2 & 3 (TARSIUS & RANGKONG) - DIPERBARUI --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                        <figure>
                            <img src="https://www.lembehresort.com/wp-content/uploads/Lembeh-Resort-Tarsier-9-copy.jpg?lossy=2&strip=0&webp=1" alt="Spectral Tarsier in Tangkoko" class="rounded-lg shadow-md w-full object-cover h-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A tiny Spectral Tarsier, one of the smallest primates on Earth.</figcaption>
                        </figure>
                        <figure>
                            <img src="https://images.unsplash.com/photo-1702945262371-50629a54a27e?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435" alt="Knobbed Hornbill in Tangkoko" class="rounded-lg shadow-md w-full object-cover h-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A Knobbed Hornbill, often seen flying over the canopy.</figcaption>
                        </figure>
                    </div>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 5: EKOSISTEM LAIN & PEMANDU --}}
                    {{-- ========================================================== --}}
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">Beyond the Primates: A Richer Ecosystem</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        While the primates may be the stars, they are supported by a vast cast of other fascinating wildlife. As you trek, your guide’s trained eyes will scan the canopy for other, shyer residents. A sudden, loud *whooshing* sound overhead signals the flight of the Knobbed Hornbill. Higher up, and much harder to spot, is the Bear Cuscus (*Ailurops ursinus*), a slow-moving, tree-dwelling marsupial.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The forest is also a paradise for birdwatchers. Colorful Kingfishers, endemic Pittas, and elegant Paradise Flycatchers flit through the lower storeys.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Keepers of the Forest: The Local Guides</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        A trip into Tangkoko is not a solitary endeavor. The experience is made possible by the park's exceptional local guides. These men and women, many of whom grew up in the villages bordering the park, are the true interpreters and guardians of this ecosystem.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Their knowledge is not learned from books; it is generational. Where a visitor sees only a wall of green, a guide sees a story. They are, in every sense, essential.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 6: WAKTU KUNJUNGAN --}}
                    {{-- ========================================================== --}}
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">Timing Your Visit: The Rhythm of the Forest</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Tangkoko operates on two main schedules, each offering a distinct experience.
                    </p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>The Morning Trek (Starts at 6:00 AM):</strong> For early risers, this is a magical time. The air is at its coolest and freshest. This is the best time for birdwatching and seeing the Black Crested Macaques as they start their day.</li>
                        <li><strong>The Afternoon Trek (Starts at 3:00 PM):</strong> This is the most popular option. You begin in the warm afternoon light, spending time with the macaques, and the trek culminates in the unique and memorable sighting of the Tarsiers as they wake for the night.</li>
                    </ul>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">A Final Word</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Tangkoko National Park is a vital counter-narrative to North Sulawesi's tourism story. It is a powerful testament to the incredible biodiversity that exists *beyond* the reef. It is a chance to walk among some of the planet's most unique creatures and to leave with a profound appreciation for the green heart of this remarkable Indonesian province.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- Call to Action (Disesuaikan untuk Tangkoko) --}}
                    {{-- ========================================================== --}}
                    <div class="mt-12 bg-blue-50 dark:bg-gray-800 p-6 rounded-lg border-l-4 border-blue-500">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            Ready to Explore the Jungle?
                        </h4>
                        <p class="text-gray-700 dark:text-gray-300">
                            Our guided treks are designed to maximize your chances of spotting wildlife, from the Yaki to the Tarsier. Let us show you the wonders of Tangkoko.
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
    {{-- AKHIR KONTEN ARTIKEL TANGKOKO --}}
    {{-- ========================================================== --}}
</x-main-layout>