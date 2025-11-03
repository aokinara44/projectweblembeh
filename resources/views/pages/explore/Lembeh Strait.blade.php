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

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 1: PENGANTAR (DARI ARTIKEL BARU) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Lembeh Strait: The Ultimate Muck Diving Guide</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Imagine this: you are floating in silence, not over a vibrant coral garden, but over a seemingly endless expanse of black volcanic sand. Your flashlight beam cuts through the slightly murky water, catching... a piece of trash? No. As you get closer, the "trash" moves—a pair of eyes stares back. It's a Hairy Frogfish, perfectly camouflaged, waiting for prey. A few feet away, a golf-ball-sized octopus "walks" across the seabed on two tentacles.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Welcome to the Lembeh Strait.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">What Exactly is "Muck Diving"?</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The term "Muck Diving" is the antithesis of what most people imagine for a tropical dive. Forget majestic walls and pelagic fish. Muck diving is the art of finding extraordinary beauty in the small, the strange, and the overlooked. It's a slow, observant underwater treasure hunt, conducted in habitats that at first glance seem barren—sandy, silty, or natural debris—but are in fact home to some of the most bizarre and evolutionarily specialized creatures on the planet.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        And among all muck diving destinations, none compares to Lembeh. Universally recognized as the <strong>"Critter Capital of the World,"</strong> this is not hyperbole; it is a biological fact. This comprehensive guide will explain why this narrow strip of water is so special and what wonders await you.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 2: GEOGRAFI & PETA (KONTEN BARU DITAMBAHKAN) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Our Location: The Geographical Miracle</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Why Lembeh? What makes this 16-kilometer long strait a unique biological incubator? The answer lies in a perfect convergence of geography, geology, and biology.
                    </p>
                    
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">Find Us on the Map</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        We are located in the heart of this biological hotspot. The strait separates the mainland of North Sulawesi from Lembeh Island, creating a unique, sheltered marine environment.
                    </p>
                    
                    {{-- PETA YANG DISEMATKAN (SESUAI PERMINTAAN ANDA) --}}
                    <div class="my-6 rounded-lg shadow-md overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/d/embed?mid=1LM899nZl_RiWG0rh6399utb_zFA7HNI&ehbc=2E312F" 
                            class="w-full aspect-video border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                     <p class="text-sm text-center text-gray-600 -mt-4 mb-6 italic">Note: Map may not load if the URL is a placeholder.</p>
                    

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">A Perfectly Sheltered Geography</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The strait is a narrow channel protected by Lembeh Island. This lake-like condition allows fine sediment to settle, creating the ideal silty, sandy bottom for burrowing creatures. It also acts as a "funnel," with nutrient-rich currents passing through from both the Sulawesi Sea and Maluku Sea, constantly supplying food to the complex chain of life on the seafloor.
                    </p>
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Volcanic Black Sand</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        This area sits on the Pacific Ring of Fire. The black volcanic sand, deposited by millennia of eruptions, is a key component. For predators and prey, this uniform black background is a blank canvas. It forces evolution into overdrive, leading to extreme camouflage (like the Hairy Frogfish), bizarre mimicry (like the Mimic Octopus), or brilliant warning colors (like the Flamboyant Cuttlefish).
                    </p>

                    {{-- ========================================================== --}}
                    {{-- GAMBAR 1 - TIDAK DIUBAH --}}
                    {{-- ========================================================== --}}
                    <figure class="my-6">
                        <img src="{{ asset('images/hero/Coconut octopus (1).webp') }}" alt="Coconut Octopus in Lembeh Strait" class="rounded-lg shadow-md w-full">
                        <figcaption class="text-sm text-center text-gray-600 mt-2 italic">A Coconut Octopus (Amphioctopus marginatus) peers from its shell.</figcaption>
                    </figure>

                    {{-- ========================================================== --}}
                    {{-- "WONDERS THAT AWAIT" - DARI TEMPLAT ASLI --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">The Wonders That Await: The "Lembeh Wishlist"</h2>
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

                    {{-- ========================================================== --}}
                    {{-- GAMBAR 2 & 3 - TIDAK DIUBAH --}}
                    {{-- ========================================================== --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                        <figure>
                            <img src="{{ asset('images/hero/Bullocky Nudibranch  (1).webp') }}" alt="Bullocky Nudibranch in Lembeh Strait" class="rounded-lg shadow-md w-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A colorful Bullocky Nudibranch (Goniobranchus bullockii).</figcaption>
                        </figure>
                        <figure>
                            <img src="{{ asset('images/hero/weedy scorpion fish (Rhinophias) (1).webp') }}" alt="Weedy Scorpionfish (Rhinopias) in Lembeh Strait" class="rounded-lg shadow-md w-full">
                            <figcaption class="text-center text-sm italic text-gray-600 mt-2">A rare Weedy Scorpionfish (Rhinopias) perfectly camouflaged.</figcaption>
                        </figure>
                    </div>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 4: PENGALAMAN MENYELAM (DARI ARTIKEL BARU) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">The Lembeh Dive Experience: Rhythm and Technique</h2>
                    
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Daily Rhythm: Slow and Methodical</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Diving in Lembeh is not about the distance you cover; it's about what you find in every square meter. A typical day involves 2 or 3 dives (morning, midday, afternoon) and a highly recommended optional night dive. The pace is slow, designed for maximum observation.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Real Star: The "Eagle-Eyed" Dive Guides</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Your success in Lembeh depends on your dive guide. The local guides here are legendary, trained for years to spot the invisible. They can see a pair of pinpoint eyes in the sand (a Stargazer) or a "strand of hair" that is actually a Hairy Shrimp. Trust them, follow them patiently, and prepare to be amazed.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">Dive Technique: Buoyancy is Everything</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Muck diving is about control. Poor buoyancy is disastrous for both you and the environment.
                    </p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>Do Not Touch Anything:</strong> The "empty" bottom is not empty. It's full of camouflaged, often venomous, creatures.</li>
                        <li><strong>Fin Control:</strong> Avoid strong or chaotic kicks. Use a controlled frog kick. Stirring up the sand ruins visibility for everyone and can bury delicate creatures.</li>
                        <li><strong>Horizontal Trim:</strong> Keep your body horizontal to minimize the risk of your fins hitting the bottom.</li>
                    </ul>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Absolute Must-Do: The Night Dive</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        If you don't do a night dive in Lembeh, you've missed half the magic. When the sun sets, the cast of characters changes completely. The seafloor explodes with activity. Bobbit worms emerge, countless crustaceans hunt, and cephalopods become far more active. It is a mesmerizing, alien opera.
                    </p>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 5: FOTOGRAFI (DARI ARTIKEL BARU) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">A Macro Photography Paradise</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Lembeh's popularity skyrocketed because of macro photography. The black sand acts as a perfect "studio backdrop," creating dramatic negative space that makes subjects pop.
                    </p>
                    
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">Recommended Gear</h3>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>Lenses:</strong> A 60mm macro is the workhorse for subjects like nudibranchs and frogfish. A 100mm/105mm macro is essential for shy or tiny subjects like pygmy seahorses.</li>
                        <li><strong>Strobes:</strong> Dual external strobes are standard for even lighting.</li>
                        <li><strong>Snoots:</strong> A "snoot" narrows your light beam to a small spot, perfect for isolating a subject against the black sand for a dramatic, professional-looking shot.</li>
                        <li><strong>Diopters:</strong> A wet-lens "magnifier" (diopter) is a must-have for "super-macro" shots, like the eye of a shrimp.</li>
                    </ul>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">The Golden Rule: Photography Ethics Above All</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        This is the most important part. A photo is **never** more important than the welfare of the subject.
                    </p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>NO TOUCHING, NO POKING:</strong> Never touch, push, or "pose" a creature. Using a stick to make a seahorse turn is unacceptable.</li>
                        <li><strong>No "Gardening":</strong> Do not "clean" an area by moving algae or sponges. You are destroying another creature's home or food source.</li>
                        <li><strong>Use Your Muck Stick Correctly:</strong> It is only for stabilizing yourself by planting it in a single, empty spot of sand so you can remain still.</li>
                        <li><strong>Limit the "Paparazzi":</strong> Take a few respectful shots of a rare subject, then move on and let others (and the animal) have their turn.</li>
                    </ul>

                    {{-- ========================================================== --}}
                    {{-- BAGIAN 6: PERENCANAAN (DARI ARTIKEL BARU) --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Practical Travel Planning</h2>
                    
                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">When is the Best Time to Visit?</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        The good news: **Lembeh is a year-round destination.** The strait is so protected that dives are almost never cancelled.
                    </p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>Best Overall (Weather & Visibility):</strong> March to November is generally the dry season, offering calmer seas and visibility up to 15-20m.</li>
                        <li><strong>Best for Critters (Rainy Season):</strong> December to February. Rain can reduce visibility (5-10m), but many photographers believe the cooler water brings out more rare critters like cephalopods and Rhinopias.</li>
                    </ul>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">How to Get There</h3>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Your destination airport is <strong>Sam Ratulangi International Airport (MDC)</strong> in Manado. The easiest international route is via Singapore (SIN), which has direct flights. Domestically, there are many flights from Jakarta (CGK) and Bali (DPS).
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        From Manado airport, it is a 90-minute to 2-hour drive to the port town of Bitung. All resorts, including Rumah Selam Lembeh, will arrange this transfer for you, which may include a short boat hop across the strait to your resort.
                    </p>

                    <h3 class="text-2xl font-semibold mt-6 mb-3 text-gray-900">What to Bring (Besides Dive Gear)</h3>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-4 space-y-2 pl-4">
                        <li><strong>Muck Stick:</strong> Essential for stabilization.</li>
                        <li><strong>Dive Torch:</strong> Mandatory, even on day dives, to see in crevices and reveal true colors.</li>
                        <li><strong>Dive Insurance:</strong> Mandatory. Ensure it covers medical evacuation.</li>
                        <li><strong>Camera Gear:</strong> Bring extra batteries and memory cards. You will use them.</li>
                    </ul>

                    {{-- ========================================================== --}}
                    {{-- "WHY DIVE WITH US" - DARI TEMPLAT ASLI --}}
                    {{-- ========================================================== --}}
                    <h2 class="text-3xl font-bold mt-8 mb-4 text-gray-900">Why Dive With Us? The Rumah Selam Difference</h2>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Diving in Lembeh isn't just about jumping in the water; it's about knowledge. Without a trained eye, 90% of these wonders remain hidden in plain sight. At Rumah Selam Lembeh, we pride ourselves on our local guides. They grew up in these waters, they know where the critters "hang out," and they understand their behavior.
                    </p>
                    <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                        Our guides are not just divers; they are critter-finding artists. They carry magnifying glasses and pointers (not to touch, but to show) to point out creatures smaller than a grain of rice. We prioritize small groups (a maximum of 4 divers per guide) to ensure you get a personal, safe, and unforgettable experience, without crowding the delicate marine life.
                    </p>
                    
                    {{-- ========================================================== --}}
                    {{-- Call to Action (Tidak Diubah) --}}
                    {{-- ========================================================== --}}
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