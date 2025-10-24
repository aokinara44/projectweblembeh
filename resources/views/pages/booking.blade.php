<x-main-layout>
    @section('title', 'Book Your Dive - Rumah Selam Lembeh')
    @section('description', 'Book your diving adventure with Rumah Selam Lembeh. Fill out the form to start planning your trip to the critter capital of the world.')

    {{-- Page Header with Slideshow --}}
    <section 
        x-data="{ images: {{ json_encode($heroImages ?? []) }}, current: 0, next() { this.current = (this.current + 1) % this.images.length; }, init() { if (this.images.length > 1) { setInterval(() => { this.next() }, 5000); } } }"
        x-init="init()"
        class="relative h-64 bg-cover bg-center text-white flex items-center justify-center"
    >
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000" :style="'background-image: url(\'/' + image + '\');'" x-show="current === index"></div>
        </template>
        <div x-show="images.length === 0" class="absolute inset-0 bg-gray-600" style="background-image: url('https://source.unsplash.com/1600x900/?scuba-gear');"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center px-4 fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Book Your Dive</h1>
            <p class="text-lg md:text-xl mt-2">Let's get your adventure started!</p>
        </div>
    </section>

    {{-- Booking Form Content --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-gray-50 p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Booking Form</h2>
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops! Something went wrong.</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number (Optional)</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700">Preferred Dive Date</label>
                            <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" min="{{ now()->format('Y-m-d') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="md:col-span-2">
                            <label for="number_of_divers" class="block text-sm font-medium text-gray-700">Number of Divers</label>
                            <input type="number" name="number_of_divers" id="number_of_divers" value="{{ old('number_of_divers', 1) }}" min="1" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700">Additional Message (Optional)</label>
                            <textarea name="message" id="message" rows="5" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Let us know if you have any special requests, certifications, or preferred dive sites.">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="w-full md:w-auto inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-gray-800 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-transform transform hover:scale-105">
                            Submit Booking Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-main-layout>

