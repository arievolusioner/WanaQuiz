<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WanaQuiz') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/logo-wq.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo-wq.png') }}?v=1">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100">

        <!-- Overlay untuk mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 transition-opacity duration-300 lg:hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar"
            class="w-64 bg-white shadow-lg flex flex-col flex-shrink-0 transform translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out fixed lg:relative inset-y-0 right-0 z-40">

            <!-- Logo -->
            <div class="p-6 border-b border-gray-100">
                <a href="/" class="block">
                    <h2 class="text-2xl font-black text-purple-700 tracking-tight">WANAQUIZ</h2>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">Platform Kuis Online</p>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex flex-col p-4 space-y-1 flex-1">

                <!-- Label -->
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest px-3 pb-1">Menu</p>

                <!-- Dashboard -->
                <a href="{{ route('siswa.dashboard') }}"
                    class="flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-semibold transition duration-200
                    {{ request()->routeIs('siswa.dashboard') ? 'bg-purple-50 text-purple-700' : 'text-gray-600 hover:bg-gray-50 hover:text-purple-700' }}">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ request()->routeIs('siswa.dashboard') ? 'bg-purple-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    Dashboard
                </a>

                <!-- Riwayat -->
                <a href="{{ route('kuis.riwayat-kuis') }}"
                    class="flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-semibold transition duration-200
                    {{ request()->routeIs('kuis.riwayat-kuis') ? 'bg-purple-50 text-purple-700' : 'text-gray-600 hover:bg-gray-50 hover:text-purple-700' }}">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ request()->routeIs('kuis.riwayat-kuis') ? 'bg-purple-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </span>
                    Riwayat Kuis
                </a>

            </nav>

            <!-- User Section -->
            <div class="border-t border-gray-100 p-4">
                <div class="relative">

                    <!-- User Button -->
                    <button id="user-menu-btn"
                        class="flex items-center w-full p-2.5 text-left hover:bg-gray-50 rounded-xl transition duration-200 group">

                        <!-- Avatar -->
                        <div class="w-9 h-9 bg-purple-600 text-white rounded-xl flex items-center justify-center flex-shrink-0 text-sm font-black">
                            {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'U' }}
                        </div>

                        <!-- Info -->
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{ Auth::user()->name ?? 'User' }}
                            </p>
                            <p class="text-xs text-gray-400 truncate">
                                {{ Auth::user()->email ?? '' }}
                            </p>
                        </div>

                        <!-- Arrow -->
                        <svg id="user-arrow" class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="user-dropdown"
                        class="absolute bottom-full left-0 mb-2 w-full bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible transform scale-95 transition-all duration-200 origin-bottom z-50 overflow-hidden">

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200 border-b border-gray-50">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edit Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

            <!-- Top Header -->
            <header class="bg-white shadow-sm flex-shrink-0 border-b border-gray-100">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">

                    <!-- Judul halaman dinamis -->
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-6 bg-purple-600 rounded-full hidden sm:block"></div>
                        <h2 class="text-base font-bold text-gray-800">
                            @if(request()->routeIs('siswa.dashboard'))
                                Dashboard
                            @elseif(request()->routeIs('kuis.mulai'))
                                Sedang Mengerjakan Kuis
                            @elseif(request()->routeIs('kuis.riwayat-kuis'))
                                Riwayat Kuis
                            @elseif(request()->routeIs('kuis.lihat-nilai'))
                                Hasil Kuis
                            @else
                                WANAQUIZ
                            @endif
                        </h2>
                    </div>

                    <!-- Mobile toggle -->
                    <button id="mobile-sidebar-toggle"
                        class="lg:hidden text-gray-600 hover:text-purple-700 focus:outline-none p-1 rounded-lg hover:bg-gray-100 transition duration-200">
                        <svg id="menu-open-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="menu-close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userMenuBtn   = document.getElementById('user-menu-btn');
            const userDropdown  = document.getElementById('user-dropdown');
            const userArrow     = document.getElementById('user-arrow');
            const mobileToggle  = document.getElementById('mobile-sidebar-toggle');
            const sidebar       = document.getElementById('sidebar');
            const overlay       = document.getElementById('sidebar-overlay');
            const menuOpenIcon  = document.getElementById('menu-open-icon');
            const menuCloseIcon = document.getElementById('menu-close-icon');

            // ── User dropdown ──────────────────────────────────────
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = !userDropdown.classList.contains('invisible');
                    userDropdown.classList.toggle('opacity-0');
                    userDropdown.classList.toggle('invisible');
                    userDropdown.classList.toggle('scale-95');
                    userArrow?.classList.toggle('rotate-180');
                });

                document.addEventListener('click', (e) => {
                    if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                        userDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                        userArrow?.classList.remove('rotate-180');
                    }
                });
            }

            // ── Mobile sidebar ─────────────────────────────────────
            function openSidebar() {
                sidebar.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                menuOpenIcon.classList.add('hidden');
                menuCloseIcon.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.add('translate-x-full');
                overlay.classList.add('hidden');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileToggle?.addEventListener('click', () => {
                sidebar.classList.contains('translate-x-full') ? openSidebar() : closeSidebar();
            });

            overlay?.addEventListener('click', closeSidebar);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeSidebar();
            });

            // Tutup sidebar saat klik link (mobile)
            sidebar.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) closeSidebar();
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });

            // Init mobile
            if (window.innerWidth < 1024) {
                sidebar.classList.add('translate-x-full');
            }
        });
    </script>
</body>

</html>