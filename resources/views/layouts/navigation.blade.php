@php
    use Illuminate\Support\Facades\Auth;

    $isActive = fn($pattern) => request()->routeIs($pattern);
    $activeClass = 'bg-gray-900 text-white';
    $inactiveClass = 'text-gray-300 hover:bg-gray-700 hover:text-white';

    $activeMenu = '';
    if ($isActive('admin.services.*') || $isActive('admin.service-categories.*')) $activeMenu = 'layanan';
    if ($isActive('admin.galleries.*') || $isActive('admin.gallery-categories.*')) $activeMenu = 'galeri';
    // Menu blog sudah dihapus
@endphp

<div
    class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-white transform transition-all duration-300 ease-in-out sm:relative sm:translate-x-0"
    :class="{
        'translate-x-0': mobileSidebarOpen,
        '-translate-x-full sm:translate-x-0': !mobileSidebarOpen,
        'sm:w-64': !sidebarCollapsed,
        'sm:w-20': sidebarCollapsed
    }"
    @click.away="mobileSidebarOpen = false"
>
    <div class="flex items-center justify-center px-4 py-6 overflow-hidden">
        {{-- INI LINK YANG KITA UBAH --}}
        <a href="{{ route('admin.dashboard') }}"> {{-- Nama route sudah benar 'admin.dashboard' --}}
            <span class="text-white text-lg font-bold" :class="{'sm:hidden': sidebarCollapsed}">Rumah Selam Admin</span>
             <svg x-show="sidebarCollapsed" x-cloak class="w-8 h-8 text-white hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2h1a2 2 0 002-2v-1a2 2 0 012-2h1.945M7.75 4h8.5a2.25 2.25 0 012.25 2.25v1.5a2.25 2.25 0 01-2.25 2.25h-8.5A2.25 2.25 0 015.5 7.75v-1.5A2.25 2.25 0 017.75 4z"></path></svg>
        </a>
    </div>

    <nav
        x-data="{ openDropdown: '' }"
        x-init="
            if (!sidebarCollapsed) openDropdown = '{{ $activeMenu }}';
            $watch('sidebarCollapsed', collapsed => {
                openDropdown = collapsed ? '' : '{{ $activeMenu }}';
            });
        "
        class="flex-1 px-4 space-y-1"
    >

        {{-- INI LINK YANG KITA UBAH --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition-colors duration-200 {{ $isActive('admin.dashboard') ? $activeClass : $inactiveClass }}"> {{-- Nama route sudah benar 'admin.dashboard' --}}
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span :class="{'sm:hidden': sidebarCollapsed}">{{ __('Dashboard') }}</span>
        </a>

        <div class="px-4 pt-4 pb-2">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider" :class="{'sm:hidden': sidebarCollapsed}">Konten</span>
            <div x-show="sidebarCollapsed" x-cloak class="border-t border-gray-700 hidden sm:block"></div>
        </div>

        {{-- Layanan Dropdown --}}
        <div class="relative" @click.away="if (sidebarCollapsed) openDropdown = ''">
            <button @click.stop="openDropdown = (openDropdown === 'layanan' ? '' : 'layanan')" class="w-full flex items-center justify-between space-x-3 px-4 py-2.5 rounded-md transition-colors duration-200 {{ $isActive('admin.services.*') || $isActive('admin.service-categories.*') ? 'bg-gray-700' : $inactiveClass }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span :class="{'sm:hidden': sidebarCollapsed}">Layanan</span>
                </div>
                <svg x-show="!sidebarCollapsed" class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': openDropdown === 'layanan' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="openDropdown === 'layanan'" x-cloak @click.stop="if (sidebarCollapsed) openDropdown = ''" x-transition class="mt-1 space-y-1" :class="{'pl-8': !sidebarCollapsed, 'sm:absolute sm:left-20 sm:w-48 sm:bg-gray-800 sm:rounded-md sm:shadow-lg sm:p-2 sm:z-10': sidebarCollapsed}">
                <a href="{{ route('admin.services.index') }}" class="block w-full text-left pr-4 py-2 rounded-md transition-colors duration-200 text-sm {{ $isActive('admin.services.*') ? $activeClass : $inactiveClass }}" :class="{'pl-4': !sidebarCollapsed}">Semua Layanan</a>
                <a href="{{ route('admin.service-categories.index') }}" class="block w-full text-left pr-4 py-2 rounded-md transition-colors duration-200 text-sm {{ $isActive('admin.service-categories.*') ? $activeClass : $inactiveClass }}" :class="{'pl-4': !sidebarCollapsed}">Kategori Layanan</a>
            </div>
        </div>

        {{-- Galeri Dropdown --}}
        <div class="relative" @click.away="if (sidebarCollapsed) openDropdown = ''">
             <button @click.stop="openDropdown = (openDropdown === 'galeri' ? '' : 'galeri')" class="w-full flex items-center justify-between space-x-3 px-4 py-2.5 rounded-md transition-colors duration-200 {{ $isActive('admin.galleries.*') || $isActive('admin.gallery-categories.*') ? 'bg-gray-700' : $inactiveClass }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m5 5v-4.5a2.5 2.5 0 00-5 0V16m0 0h-4.5a2.5 2.5 0 000 5H14m0-5a2.5 2.5 0 005 0V11a2.5 2.5 0 00-5 0v2.5z"></path></svg>
                    <span :class="{'sm:hidden': sidebarCollapsed}">Galeri</span>
                </div>
                <svg x-show="!sidebarCollapsed" class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': openDropdown === 'galeri' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="openDropdown === 'galeri'" x-cloak @click.stop="if (sidebarCollapsed) openDropdown = ''" x-transition class="mt-1 space-y-1" :class="{'pl-8': !sidebarCollapsed, 'sm:absolute sm:left-20 sm:w-48 sm:bg-gray-800 sm:rounded-md sm:shadow-lg sm:p-2 sm:z-10': sidebarCollapsed}">
                <a href="{{ route('admin.galleries.index') }}" class="block w-full text-left pr-4 py-2 rounded-md transition-colors duration-200 text-sm {{ $isActive('admin.galleries.*') ? $activeClass : $inactiveClass }}" :class="{'pl-4': !sidebarCollapsed}">Semua Galeri</a>
                <a href="{{ route('admin.gallery-categories.index') }}" class="block w-full text-left pr-4 py-2 rounded-md transition-colors duration-200 text-sm {{ $isActive('admin.gallery-categories.*') ? $activeClass : $inactiveClass }}" :class="{'pl-4': !sidebarCollapsed}">Kategori Galeri</a>
            </div>
        </div>

        {{-- Blog Dropdown SUDAH DIHAPUS --}}

        <div class="px-4 pt-4 pb-2">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider" :class="{'sm:hidden': sidebarCollapsed}">Manajemen</span>
            <div x-show="sidebarCollapsed" x-cloak class="border-t border-gray-700 hidden sm:block"></div>
        </div>

        {{-- Booking SUDAH DIHAPUS --}}

        <a href="{{ route('admin.reviews.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition-colors duration-200 {{ $isActive('admin.reviews.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118L2.98 9.1c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            <span :class="{'sm:hidden': sidebarCollapsed}">Reviews</span>
        </a>
        <div class="px-4 pt-4 pb-2">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider" :class="{'sm:hidden': sidebarCollapsed}">Pengaturan</span>
            <div x-show="sidebarCollapsed" x-cloak class="border-t border-gray-700 hidden sm:block"></div>
        </div>

        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition-colors duration-200 {{ $isActive('admin.users.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A10.99 10.99 0 002.63 12c0-3.033 1.25-5.78 3.28-7.72 1.94-1.89 4.59-3.03 7.43-3.03 2.84 0 5.49.94 7.43 3.03 2.03 1.94 3.28 4.69 3.28 7.72 0 3.03-1.25 5.78-3.28 7.72-1.94 1.89-4.59 3.03-7.43 3.03-1.39 0-2.73-.28-3.95-.79z"></path></svg>
            <span :class="{'sm:hidden': sidebarCollapsed}">Users</span>
        </a>
    </nav>

    <div class="sm:hidden p-4 border-t border-gray-700">
        <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.profile.edit')" class="text-gray-300 hover:text-white"> {{-- Nama route sudah 'admin.profile.edit' --}}
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-300 hover:text-white">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>