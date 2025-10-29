{{-- Lokasi File: resources/views/admin/explore-posts/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Explore Post') }}: {{ $explorePost->getTranslation('title', 'en') }}
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

                    <form action="{{ route('admin.explore-posts.update', $explorePost) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk update --}}
                        <div class="space-y-6">

                            {{-- Kategori --}}
                            <div>
                                <x-input-label for="explore_category_id" :value="__('Category') . '*'" />
                                <select name="explore_category_id" id="explore_category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">{{ __('-- Select Category --') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('explore_category_id', $explorePost->explore_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->getTranslation('name', 'en') }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('explore_category_id')" class="mt-2" />
                            </div>

                             {{-- Judul (EN) --}}
                            <div>
                                <x-input-label for="title_en" :value="__('Title (EN)') . '*'" />
                                <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title[en]" :value="old('title.en', $explorePost->getTranslation('title', 'en', false))" required />
                                <x-input-error :messages="$errors->get('title.en')" class="mt-2" />
                            </div>

                            {{-- Judul (NL) --}}
                            <div>
                                <x-input-label for="title_nl" :value="__('Title (NL)')" />
                                <x-text-input id="title_nl" class="block mt-1 w-full" type="text" name="title[nl]" :value="old('title.nl', $explorePost->getTranslation('title', 'nl', false))" />
                                <x-input-error :messages="$errors->get('title.nl')" class="mt-2" />
                            </div>

                            {{-- Judul (ZH) --}}
                            <div>
                                <x-input-label for="title_zh" :value="__('Title (ZH)')" />
                                <x-text-input id="title_zh" class="block mt-1 w-full" type="text" name="title[zh]" :value="old('title.zh', $explorePost->getTranslation('title', 'zh', false))" />
                                <x-input-error :messages="$errors->get('title.zh')" class="mt-2" />
                            </div>

                             {{-- Slug (Readonly) --}}
                             <div class="mt-4">
                                <x-input-label for="slug" :value="__('Slug')" />
                                <x-text-input id="slug" class="block mt-1 w-full bg-gray-100" type="text" name="slug" :value="$explorePost->slug" readonly disabled />
                                <p class="mt-1 text-sm text-gray-500">{{ __("Slug is auto-generated based on the English title and typically shouldn't be changed.") }}</p>
                            </div>

                            {{-- Konten (EN) --}}
                            <div class="mt-4">
                                <x-input-label for="content_en" :value="__('Content (EN)') . '*'" />
                                <textarea id="content_en" name="content[en]" class="tinymce-editor block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content.en', $explorePost->getTranslation('content', 'en', false)) }}</textarea>
                                <x-input-error :messages="$errors->get('content.en')" class="mt-2" />
                            </div>

                            {{-- Konten (NL) --}}
                             <div class="mt-4">
                                <x-input-label for="content_nl" :value="__('Content (NL)')" />
                                <textarea id="content_nl" name="content[nl]" class="tinymce-editor block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content.nl', $explorePost->getTranslation('content', 'nl', false)) }}</textarea>
                                <x-input-error :messages="$errors->get('content.nl')" class="mt-2" />
                            </div>

                             {{-- Konten (ZH) --}}
                             <div class="mt-4">
                                <x-input-label for="content_zh" :value="__('Content (ZH)')" />
                                <textarea id="content_zh" name="content[zh]" class="tinymce-editor block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content.zh', $explorePost->getTranslation('content', 'zh', false)) }}</textarea>
                                <x-input-error :messages="$errors->get('content.zh')" class="mt-2" />
                            </div>

                             {{-- Gambar Unggulan --}}
                            <div>
                                <x-input-label for="featured_image" :value="__('Featured Image')" />
                                <input type="file" name="featured_image" id="featured_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-1"/>
                                <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                                <p class="mt-1 text-sm text-gray-500">Leave blank to keep the current image. Max file size: 2MB. Allowed types: jpg, jpeg, png, webp.</p>

                                {{-- Tampilkan gambar saat ini jika ada --}}
                                @if($explorePost->featured_image)
                                    <div class="mt-4">
                                        <img src="{{ Storage::url($explorePost->featured_image) }}" alt="Current Featured Image" class="h-40 w-auto rounded">
                                    </div>
                                @endif
                            </div>

                             {{-- Status Publikasi --}}
                            <div class="block mt-4">
                                <label for="is_published" class="inline-flex items-center">
                                    <input id="is_published" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_published" value="1" {{ old('is_published', $explorePost->is_published) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                                </label>
                                 <x-input-error :messages="$errors->get('is_published')" class="mt-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.explore-posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button>
                                {{ __('Update Post') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk inisialisasi TinyMCE --}}
    @push('scripts')
    {{-- Pastikan path ini benar --}}
    <script src="{{ asset('build/assets/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
          selector: 'textarea.tinymce-editor',
          plugins: 'code table lists image link media autoresize fullscreen preview wordcount',
          toolbar: 'undo redo | blocks | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | link image media | code table | fullscreen preview',
          height: 400,
          autoresize_bottom_margin: 16,
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          // content_style: 'body { font-family: Figtree, sans-serif; font-size:1rem }'
        });
      });
    </script>
    @endpush

</x-app-layout>