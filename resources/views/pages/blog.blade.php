<x-main-layout>
    @section('title', 'Our Blog - Rumah Selam Lembeh')
    @section('description', 'Read our latest articles, diving tips, and news from the underwater world of Lembeh Strait.')

    {{-- Page Header with Slideshow --}}
    <section 
        x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, next() { this.current = (this.current + 1) % this.images.length; }, init() { if (this.images.length > 1) { setInterval(() => { this.next() }, 5000); } } }"
        x-init="init()"
        class="relative h-64 bg-cover bg-center text-white flex items-center justify-center"
    >
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000" :style="'background-image: url(\'/' + image + '\');'" x-show="current === index"></div>
        </template>
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://source.unsplash.com/1600x900/?writing,notebook');"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center px-4 fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Our Blog</h1>
            <p class="text-lg md:text-xl mt-2">Stories, Tips, and News From Our Dive Center.</p>
        </div>
    </section>

    {{-- Blog Content --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">

            @if($posts->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">There are no blog posts yet. Please check back soon!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in">
                            <a href="{{ route('post.detail', $post) }}">
                                <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : 'https://source.unsplash.com/400x300/?ocean' }}" alt="{{ $post->title }}" class="w-full h-56 object-cover">
                            </a>
                            <div class="p-6">
                                <div class="mb-3">
                                    <span class="text-sm text-blue-500 font-semibold">{{ $post->postCategory->name ?? 'Uncategorized' }}</span>
                                    <span class="text-sm text-gray-500 mx-1">&bull;</span>
                                    <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="{{ route('post.detail', $post) }}" class="hover:text-blue-600 transition-colors">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}</p>
                                <a href="{{ route('post.detail', $post) }}" class="font-semibold text-yellow-500 hover:text-yellow-600">Read More &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginasi -->
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </section>

</x-main-layout>

