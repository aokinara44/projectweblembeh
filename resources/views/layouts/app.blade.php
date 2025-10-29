<!DOCTYPE html>
{{-- Lokasi File: resources/views/layouts/app.blade.php --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')

        <style>
            [x-cloak] { display: none !important; }
            .sidebar-width-transition { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        </style>
    </head>
    <body class="font-sans antialiased">
        {{-- Listener event tetap ada --}}
        <div x-data="{ sidebarMinimized: false }" @toggle-sidebar.window="sidebarMinimized = !sidebarMinimized"
             class="min-h-screen flex bg-gray-100">

            {{-- Tambahkan ID --}}
            <div id="sidebar-container" :class="sidebarMinimized ? 'w-20' : 'w-64'" class="bg-white shadow-md flex-shrink-0 overflow-hidden flex flex-col sidebar-width-transition z-20">
                 @include('layouts.navigation', ['sidebarMinimized' => '$data.sidebarMinimized'])
            </div>

            <div class="flex-1 flex flex-col overflow-x-hidden">

                <header class="bg-white shadow z-10 flex-shrink-0">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                        {{-- Tombol Minimize/Expand --}}
                        <button @click="$dispatch('toggle-sidebar')" title="{{ __('Toggle Sidebar') }}"
                                class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                             <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /> </svg>
                        </button>

                        {{-- Slot Header (Judul Halaman) --}}
                        <div class="flex-grow ml-4">
                             @if (isset($header))
                                {{ $header }}
                            @endif
                        </div>

                         {{-- User Dropdown Header --}}
                        <div class="ml-auto">
                            @include('layouts.partials.user-dropdown-header')
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>

        @stack('scripts')
    </body>
</html>