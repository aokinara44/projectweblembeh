{{-- resources/views/pages/explore/index.blade.php --}}
<x-main-layout :title="__('Explore Our Services')">

    {{-- Hero Section (Simple Title) --}}
    <div class="pt-32 pb-16 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-white">
                {{ __('Explore Our Services') }}
            </h1>
            <p class="text-xl text-center text-gray-600 dark:text-gray-300 mt-4">
                {{ __('Discover the wonders of Lembeh and beyond with Rumah Selam.') }}
            </p>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Tautan ke Halaman Layanan --}}
            <a href="{{ url('/explore/diving') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Diving Packages') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('See our various diving schedules, from morning dives to night and mandarin dives.') }}
                </p>
            </a>

            <a href="{{ url('/explore/bangka-trip') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Bangka Trip') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('Explore the pristine dive sites around Bangka Island, departing from Lembeh.') }}
                </p>
            </a>

            <a href="{{ url('/explore/snorkeling') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Snorkeling') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('Enjoy the beautiful underwater scenery without diving.') }}
                </p>
            </a>

            <a href="{{ url('/explore/tangkoko-trip') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Tangkoko Trip') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('Visit the Tangkoko Nature Reserve, home to Tarsiers and Black Macaques.') }}
                </p>
            </a>

            <a href="{{ url('/explore/highland-tour') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Highland Tour') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('Discover the cool and scenic highlands of Minahasa.') }}
                </p>
            </a>

            <a href="{{ url('/explore/airport-transport') }}"
                class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('Airport Transport') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('We can help arrange smooth and reliable airport transfers for you.') }}
                </p>
            </a>

        </div>
    </div>
</x-main-layout>