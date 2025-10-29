<?php
// Lokasi File: resources/views/layouts/navigation.blade.php
?>
@php
    $activeMenu = null;
    if (request()->routeIs('admin.service*')) $activeMenu = 'services';
    elseif (request()->routeIs('admin.explore*')) $activeMenu = 'explore';
    elseif (request()->routeIs('admin.gallery*')) $activeMenu = 'media';
    elseif (request()->routeIs('admin.review*')) $activeMenu = 'feedback';
    elseif (request()->routeIs('admin.user*') || request()->routeIs('admin.profile*')) $activeMenu = 'management';
@endphp
<div x-data="{
        activeDropdown: '{{ $activeMenu }}',
        sidebarMinimized: {{ $sidebarMinimized ?? 'false' }},
        floatingDropdown: null,
        toggleFloating(id, event) {
            if (!this.sidebarMinimized) return;
            event.stopPropagation();
            this.activeDropdown = null;
            this.floatingDropdown = (this.floatingDropdown === id) ? null : id;
            if (this.floatingDropdown) {
                const buttonRect = event.currentTarget.getBoundingClientRect();
                const sidebarWidth = document.getElementById('sidebar-container').offsetWidth;
                this.$nextTick(() => {
                    const dropdownEl = this.$refs[id + 'Floating'];
                    dropdownEl.style.top = `${buttonRect.top}px`;
                    dropdownEl.style.left = `${sidebarWidth}px`;
                });
            }
        },
        toggleNormalDropdown(id) {
             if (this.sidebarMinimized) return;
             this.floatingDropdown = null;
             this.activeDropdown = (this.activeDropdown === id) ? null : id;
        }
     }"
     @click.away="floatingDropdown = null"
     x-cloak class="flex flex-col h-full bg-white relative">

    <div class="shrink-0 flex items-center h-16 border-b px-4 overflow-hidden" :class="sidebarMinimized ? 'justify-center' : 'justify-start'">
        <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" class="flex items-center overflow-hidden whitespace-nowrap">
             <div class="flex flex-col items-start leading-none flex-shrink-0" x-show="!sidebarMinimized">
                 <div class="font-bold tracking-[0.1em] text-lg text-shadow-subtle">
                     <span class="logo-rumah">RUMAH</span> <span class="logo-selam">SELAM</span>
                 </div>
                 <div class="overflow-hidden max-h-4">
                     <span class="logo-subtitle block text-shadow-subtle text-xs opacity-80">ADMIN PANEL</span>
                 </div>
             </div>
             <div x-show="sidebarMinimized" class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                 <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /> </svg>
             </div>
        </a>
    </div>

    <nav class="flex-grow py-4 space-y-1 overflow-y-auto overflow-x-hidden"
         :class="sidebarMinimized ? 'px-2' : 'px-4'">

        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" title="Dashboard"
           class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out overflow-hidden whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
           :class="sidebarMinimized ? 'justify-center' : ''">
             <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z" /> </svg>
            {{-- !! Perbaikan: Tambahkan :class binding untuk lebar !! --}}
            <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                <span class="whitespace-nowrap">{{ __('Dashboard') }}</span>
            </div>
        </a>

        {{-- Dropdown Services --}}
        <div class="relative">
            <button @click="sidebarMinimized ? toggleFloating('services', $event) : toggleNormalDropdown('services')" title="Services"
                    class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-left text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out overflow-hidden whitespace-nowrap"
                    :class="sidebarMinimized ? 'justify-center' : ''">
                <span class="flex items-center">
                    <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25h-12A2.25 2.25 0 013.75 18.22V14.15m16.5 0v-2.25a2.25 2.25 0 00-2.25-2.25h-12a2.25 2.25 0 00-2.25 2.25v2.25m16.5 0h-16.5" /> </svg>
                    <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                        <span class="whitespace-nowrap">{{ __('Services') }}</span>
                    </div>
                </span>
                <svg x-show="!sidebarMinimized" class="w-5 h-5 transform transition-transform duration-200 flex-shrink-0" :class="{'rotate-180': activeDropdown === 'services', 'rotate-0': activeDropdown !== 'services'}" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
            </button>
            <div x-show="activeDropdown === 'services' && !sidebarMinimized" x-transition class="mt-1 pl-8 space-y-1 flex flex-col">
                <x-nav-link :href="route('admin.service-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.service-categories.*')"> {{ __('Categories') }} </x-nav-link>
                <x-nav-link :href="route('admin.services.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.services.*')"> {{ __('All Services') }} </x-nav-link>
            </div>
        </div>

        {{-- Dropdown Explore --}}
         <div class="relative">
            <button @click="sidebarMinimized ? toggleFloating('explore', $event) : toggleNormalDropdown('explore')" title="Explore"
                    class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-left text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out overflow-hidden whitespace-nowrap"
                    :class="sidebarMinimized ? 'justify-center' : ''">
                <span class="flex items-center">
                    <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /> </svg>
                     <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                        <span class="whitespace-nowrap">{{ __('Explore') }}</span>
                    </div>
                </span>
                <svg x-show="!sidebarMinimized" class="w-5 h-5 transform transition-transform duration-200 flex-shrink-0" :class="{'rotate-180': activeDropdown === 'explore', 'rotate-0': activeDropdown !== 'explore'}" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
            </button>
            <div x-show="activeDropdown === 'explore' && !sidebarMinimized" x-transition class="mt-1 pl-8 space-y-1 flex flex-col">
                <x-nav-link :href="route('admin.explore-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.explore-categories.*')"> {{ __('Categories') }} </x-nav-link>
                <x-nav-link :href="route('admin.explore-posts.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.explore-posts.*')"> {{ __('Posts') }} </x-nav-link>
            </div>
        </div>

        {{-- Dropdown Media --}}
        <div class="relative">
            <button @click="sidebarMinimized ? toggleFloating('media', $event) : toggleNormalDropdown('media')" title="Media"
                    class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-left text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out overflow-hidden whitespace-nowrap"
                    :class="sidebarMinimized ? 'justify-center' : ''">
                <span class="flex items-center">
                    <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm16.5-1.5H3.75" /> </svg>
                     <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                        <span class="whitespace-nowrap">Media</span>
                    </div>
                </span>
                <svg x-show="!sidebarMinimized" class="w-5 h-5 transform transition-transform duration-200 flex-shrink-0" :class="{'rotate-180': activeDropdown === 'media', 'rotate-0': activeDropdown !== 'media'}" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
            </button>
             <div x-show="activeDropdown === 'media' && !sidebarMinimized" x-transition class="mt-1 pl-8 space-y-1 flex flex-col">
                <x-nav-link :href="route('admin.gallery-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.gallery-categories.*')"> {{ __('Gallery Categories') }} </x-nav-link>
                <x-nav-link :href="route('admin.galleries.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.galleries.*')"> {{ __('Galleries') }} </x-nav-link>
            </div>
        </div>

        {{-- Dropdown Feedback --}}
        <div class="relative">
             <button @click="sidebarMinimized ? toggleFloating('feedback', $event) : toggleNormalDropdown('feedback')" title="Feedback"
                     class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-left text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out overflow-hidden whitespace-nowrap"
                     :class="sidebarMinimized ? 'justify-center' : ''">
                <span class="flex items-center">
                    <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.31h5.518a.562.562 0 01.31.95l-4.22 3.07a.564.564 0 00-.17.618l1.58 4.722a.563.563 0 01-.815.618L12.001 15.3a.563.563 0 00-.618 0l-4.22 3.072a.563.563 0 01-.815-.618l1.58-4.722a.564.564 0 00-.17-.618l-4.22-3.07a.562.562 0 01.31-.95h5.518a.563.563 0 00.475-.31L11.48 3.5z" /> </svg>
                     <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                        <span class="whitespace-nowrap">Feedback</span>
                    </div>
                </span>
                <svg x-show="!sidebarMinimized" class="w-5 h-5 transform transition-transform duration-200 flex-shrink-0" :class="{'rotate-180': activeDropdown === 'feedback', 'rotate-0': activeDropdown !== 'feedback'}" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
            </button>
             <div x-show="activeDropdown === 'feedback' && !sidebarMinimized" x-transition class="mt-1 pl-8 space-y-1 flex flex-col">
                 <x-nav-link :href="route('admin.reviews.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.reviews.*')"> {{ __('Reviews') }} </x-nav-link>
            </div>
        </div>

        {{-- Dropdown Management --}}
        <div class="relative">
             <button @click="sidebarMinimized ? toggleFloating('management', $event) : toggleNormalDropdown('management')" title="Management"
                     class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-left text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out overflow-hidden whitespace-nowrap"
                     :class="sidebarMinimized ? 'justify-center' : ''">
                <span class="flex items-center">
                    <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /> </svg>
                     <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                        <span class="whitespace-nowrap">Management</span>
                    </div>
                </span>
                <svg x-show="!sidebarMinimized" class="w-5 h-5 transform transition-transform duration-200 flex-shrink-0" :class="{'rotate-180': activeDropdown === 'management', 'rotate-0': activeDropdown !== 'management'}" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
            </button>
             <div x-show="activeDropdown === 'management' && !sidebarMinimized" x-transition class="mt-1 pl-8 space-y-1 flex flex-col">
                 <x-nav-link :href="route('admin.users.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.users.*')"> {{ __('Users') }} </x-nav-link>
                 <x-nav-link :href="route('admin.profile.edit', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.profile.edit')"> {{ __('My Profile') }} </x-nav-link>
            </div>
        </div>

    </nav>

    {{-- Tombol Logout --}}
      <div class="mt-auto border-t p-2 flex-shrink-0">
        <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
            @csrf
            <button type="submit" title="Logout"
                    class="flex items-center w-full px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white focus:outline-none transition ease-in-out duration-150 hover:bg-red-50 hover:border-red-300 hover:text-red-700"
                    :class="sidebarMinimized ? 'justify-center' : ''">
                <svg class="w-6 h-6 flex-shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /> </svg>
                 <div class="flex-1 overflow-hidden transition-all duration-300" :class="sidebarMinimized ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                    <span class="text-left whitespace-nowrap">{{ __('Log Out') }}</span>
                 </div>
            </button>
        </form>
    </div>

    {{-- Floating Dropdown Menus --}}
    <div x-ref="servicesFloating" x-show="floatingDropdown === 'services' && sidebarMinimized" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-30 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none;">
        <x-nav-link :href="route('admin.service-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.service-categories.*')"> {{ __('Categories') }} </x-nav-link>
        <x-nav-link :href="route('admin.services.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.services.*')"> {{ __('All Services') }} </x-nav-link>
    </div>
    <div x-ref="exploreFloating" x-show="floatingDropdown === 'explore' && sidebarMinimized" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-30 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none;">
         <x-nav-link :href="route('admin.explore-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.explore-categories.*')"> {{ __('Categories') }} </x-nav-link>
         <x-nav-link :href="route('admin.explore-posts.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.explore-posts.*')"> {{ __('Posts') }} </x-nav-link>
    </div>
     <div x-ref="mediaFloating" x-show="floatingDropdown === 'media' && sidebarMinimized" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-30 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none;">
         <x-nav-link :href="route('admin.gallery-categories.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.gallery-categories.*')"> {{ __('Gallery Categories') }} </x-nav-link>
         <x-nav-link :href="route('admin.galleries.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.galleries.*')"> {{ __('Galleries') }} </x-nav-link>
    </div>
     <div x-ref="feedbackFloating" x-show="floatingDropdown === 'feedback' && sidebarMinimized" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-30 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none;">
         <x-nav-link :href="route('admin.reviews.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.reviews.*')"> {{ __('Reviews') }} </x-nav-link>
    </div>
     <div x-ref="managementFloating" x-show="floatingDropdown === 'management' && sidebarMinimized" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-30 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none;">
          <x-nav-link :href="route('admin.users.index', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.users.*')"> {{ __('Users') }} </x-nav-link>
          <x-nav-link :href="route('admin.profile.edit', ['locale' => app()->getLocale()])" :active="request()->routeIs('admin.profile.edit')"> {{ __('My Profile') }} </x-nav-link>
    </div>

</div>