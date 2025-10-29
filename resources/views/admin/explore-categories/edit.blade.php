{{-- Lokasi File: resources/views/admin/explore-categories/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Explore Category') }}: {{ $exploreCategory->getTranslation('name', 'en') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.explore-categories.update', $exploreCategory) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk update --}}
                        <div class="space-y-4">
                            {{-- Nama Kategori (EN) --}}
                            <div>
                                <x-input-label for="name_en" :value="__('Category Name (EN)') . '*'" />
                                <x-text-input id="name_en" class="block mt-1 w-full" type="text" name="name[en]" :value="old('name.en', $exploreCategory->getTranslation('name', 'en', false))" required autofocus />
                                <x-input-error :messages="$errors->get('name.en')" class="mt-2" />
                            </div>

                            {{-- Nama Kategori (NL) --}}
                            <div>
                                <x-input-label for="name_nl" :value="__('Category Name (NL)')" />
                                <x-text-input id="name_nl" class="block mt-1 w-full" type="text" name="name[nl]" :value="old('name.nl', $exploreCategory->getTranslation('name', 'nl', false))" />
                                <x-input-error :messages="$errors->get('name.nl')" class="mt-2" />
                            </div>

                            {{-- Nama Kategori (ZH) --}}
                            <div>
                                <x-input-label for="name_zh" :value="__('Category Name (ZH)')" />
                                <x-text-input id="name_zh" class="block mt-1 w-full" type="text" name="name[zh]" :value="old('name.zh', $exploreCategory->getTranslation('name', 'zh', false))" />
                                <x-input-error :messages="$errors->get('name.zh')" class="mt-2" />
                            </div>

                            {{-- Slug (Readonly) --}}
                            <div class="mt-4">
                                <x-input-label for="slug" :value="__('Slug')" />
                                <x-text-input id="slug" class="block mt-1 w-full bg-gray-100" type="text" name="slug" :value="$exploreCategory->slug" readonly disabled />
                                <p class="mt-1 text-sm text-gray-500">{{ __("Slug is auto-generated based on the English name and typically shouldn't be changed.") }}</p>
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.explore-categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button>
                                {{ __('Update Category') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>