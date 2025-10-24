<x-main-layout>
    @section('title', 'Booking Submitted - Rumah Selam Lembeh')

    {{-- Booking Success Content --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-3xl text-center">
            <div class="bg-green-100 p-6 rounded-full inline-block mb-6">
                <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Thank You! Your Booking Request is Received.</h1>
            <p class="text-gray-600 mb-6">We have received your booking request and will get back to you shortly via email to confirm the details. Please check your inbox (and spam folder, just in case).</p>
            
            @if(session('bookingCode'))
                <div class="bg-gray-100 border border-dashed border-gray-300 rounded-lg p-4 inline-block">
                    <p class="text-gray-600">Your Booking Code is:</p>
                    <p class="text-2xl font-bold text-blue-600 tracking-widest">{{ session('bookingCode') }}</p>
                </div>
            @endif

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    &larr; Back to Home
                </a>
            </div>
        </div>
    </section>

</x-main-layout>
