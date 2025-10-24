<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reviews') }}
            </h2>
            <a href="{{ route('admin.reviews.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Add New Review') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Session Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
             @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Reviewer') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Review') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Rating') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('Actions') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($reviews as $review)
                                    <tr>
                                        {{-- !! PERUBAHAN DI SINI !! --}}
                                        <td class="px-6 py-4 whitespace-nowrap align-top">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{-- Tampilkan terjemahan EN --}}
                                                {{ $review->getTranslation('reviewer_name', 'en', false) }}
                                            </div>
                                            {{-- Tampilkan kode bahasa lain jika ada isinya --}}
                                            <div class="text-xs text-gray-500 mt-1">
                                                @foreach(config('app.available_locales') as $locale => $localeName)
                                                    @if($locale !== 'en' && $review->hasTranslation('reviewer_name', $locale))
                                                        <span class="mr-1">[{{ strtoupper($locale) }}]</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        {{-- !! PERUBAHAN DI SINI !! --}}
                                        <td class="px-6 py-4 align-top">
                                            <div class="text-sm text-gray-900">
                                                {{-- Tampilkan terjemahan EN & limit --}}
                                                {{ Str::limit($review->getTranslation('review_text', 'en', false), 70) }}
                                            </div>
                                             {{-- Tampilkan kode bahasa lain jika ada isinya --}}
                                            <div class="text-xs text-gray-500 mt-1">
                                                @foreach(config('app.available_locales') as $locale => $localeName)
                                                    @if($locale !== 'en' && $review->hasTranslation('review_text', $locale))
                                                        <span class="mr-1">[{{ strtoupper($locale) }}]</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap align-top">
                                            <div class="text-sm text-gray-900">
                                                {{ $review->rating }} ★
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</a>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ __('No reviews found.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                 {{-- Paginasi --}}
                <div class="p-6 bg-white border-t border-gray-200">
                   {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>