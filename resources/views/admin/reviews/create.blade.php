<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.reviews.store') }}">
                        @csrf

                        {{-- !! PERUBAHAN: Input Reviewer Name Multi-bahasa !! --}}
                        @foreach(config('app.available_locales') as $locale => $localeName)
                            <div class="mb-4">
                                <x-input-label :for="'reviewer_name_' . $locale">
                                    {{ __('Reviewer Name') }} ({{ strtoupper($locale) }})
                                    @if($locale === 'en') <span class="text-red-500">*</span> @endif
                                </x-input-label>
                                <x-text-input
                                    :id="'reviewer_name_' . $locale"
                                    class="block mt-1 w-full"
                                    type="text"
                                    :name="'reviewer_name[' . $locale . ']'"
                                    :value="old('reviewer_name.' . $locale)"
                                    :required="$locale === 'en'"
                                    autofocus="{{ $locale === 'en' }}" />
                                @error('reviewer_name.' . $locale)
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                        @error('reviewer_name')
                           <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        {{-- !! PERUBAHAN: Input Review Text Multi-bahasa (Textarea) !! --}}
                         @foreach(config('app.available_locales') as $locale => $localeName)
                            <div class="mb-4">
                                <x-input-label :for="'review_text_' . $locale">
                                    {{ __('Review Text') }} ({{ strtoupper($locale) }})
                                     @if($locale === 'en') <span class="text-red-500">*</span> @endif
                                </x-input-label>
                                <textarea
                                    id="'review_text_' . $locale"
                                    name="review_text[{{ $locale }}]"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="5"
                                    {{ $locale === 'en' ? 'required' : '' }}
                                >{{ old('review_text.' . $locale) }}</textarea>
                                @error('review_text.' . $locale)
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                        @error('review_text')
                           <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mb-4">
                            <x-input-label for="rating" :value="__('Rating (1-5)')" />
                            <x-text-input id="rating" class="block mt-1 w-full" type="number" name="rating" :value="old('rating', 5)" required min="1" max="5" />
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>