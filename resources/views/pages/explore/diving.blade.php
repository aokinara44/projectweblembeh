{{-- resources/views/pages/explore/diving.blade.php --}}
<x-main-layout :title="__('Diving Packages')">

    {{-- Hero Section (Simple Title) --}}
    <div class="pt-32 pb-16 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-white">
                {{ __('Diving Packages') }}
            </h1>
            <p class="text-xl text-center text-gray-600 dark:text-gray-300 mt-4">
                {{ __('Explore the rich biodiversity of Lembeh Strait with our guided dive packages.') }}
            </p>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="container mx-auto px-4 py-16">
        <section id="diving-packages">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- 2DD Package --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">
                            {{ __('2DD (2 Morning Dives)') }}
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('Two dives in the morning. Will be finished latest by 1 PM.') }}
                        </p>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ __('Schedule:') }}
                        </h4>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 space-y-1">
                            <li>7.45-8.00am : {{ __('Hotel pickup') }}</li>
                            <li>8.00-8.30am: {{ __('Diving preparation') }}</li>
                            <li>8.45am: {{ __('Depart by boat to the first site') }}</li>
                        </ul>
                    </div>
                </div>

                {{-- 3DD Package --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('3DD (3 Dives)') }}
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('Two morning dives and one afternoon dive.') }}
                        </p>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ __('Schedule:') }}
                        </h4>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 space-y-1">
                            <li>7.45-8.00am : {{ __('Hotel pickup') }}</li>
                            <li>8.00-8.30am: {{ __('Diving preparation') }}</li>
                            <li>8.45am: {{ __('Depart by boat to the first site') }}</li>
                            <li>12.00-1PM: {{ __('Lunch break') }}</li>
                            <li>2.30-3pm: {{ __('Continue afternoon dive') }}</li>
                        </ul>
                    </div>
                </div>

                {{-- 2DD 1ND/MD Package --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">
                            {{ __('2DD 1ND/MD') }}</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('Two morning dives plus one night dive or Mandarin (dusk) dive.') }}
                        </p>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ __('Schedule:') }}
                        </h4>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 space-y-1">
                            <li>7.45-8.00am : {{ __('Hotel pickup') }}</li>
                            <li>8.00-8.30am: {{ __('Diving preparation') }}</li>
                            <li>8.45am: {{ __('Depart by boat to the first site') }}</li>
                            <li>12.00-1PM: {{ __('Lunch break') }}</li>
                            <li>5.00pm: {{ __('Mandarin or dusk dive begins') }}</li>
                            <li>6.00pm: {{ __('Night dive begins') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Additional Notes --}}
            <div class="mt-12 bg-blue-50 dark:bg-gray-800 p-6 rounded-lg border-l-4 border-blue-500">
                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                    {{ __('Additional Notes: Mandarin Dive') }}</h4>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __("Based on the diver community here, since we only have one dive site to do Mandarin, all dive resorts must be on schedule. Rumah Selam's schedule is on Monday to avoid overcrowding. If you want to do a mandarin dive other than Monday, we will try our best to re-arrange with other resorts, but cannot 100% sure. Confirmation will be told at least one day before or in the day around morning time.") }}
                </p>
            </div>
        </section>
    </div>
</x-main-layout>