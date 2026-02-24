<!-- Navigation -->
<nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 group">
                <span class="text-xl font-black text-purple-700 tracking-tight">WANAQUIZ</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-1">
                <a href="/"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                    {{ request()->is('/') ? 'bg-purple-50 text-purple-700' : 'text-gray-600 hover:bg-gray-50 hover:text-purple-700' }}">
                    Beranda
                </a>
                <a href="{{ route('about') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-200
                    {{ request()->routeIs('about') 
                        ? 'bg-purple-50 text-purple-700' 
                        : 'text-gray-600 hover:bg-gray-50 hover:text-purple-700' }}">
                    Tentang Kami
                </a>
            </div>

            <!-- Desktop Right Side -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    {{-- User dropdown --}}
                    <div class="relative" id="desktop-user-wrap">
                        <button id="desktop-user-btn"
                            class="flex items-center gap-2.5 pl-2 pr-3 py-2 rounded-xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition duration-200">
                            <div class="w-7 h-7 bg-purple-700 text-white rounded-lg flex items-center justify-center text-xs font-black flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-gray-800 max-w-28 truncate">{{ Auth::user()->name }}</span>
                            <svg id="desktop-user-arrow" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="desktop-user-menu"
                            class="absolute right-0 mt-2 w-52 bg-white border border-gray-100 rounded-2xl shadow-xl opacity-0 invisible transform scale-95 transition-all duration-200 origin-top-right z-50 overflow-hidden">

                            <div class="px-4 py-3 border-b border-gray-50">
                                <p class="text-xs font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if(auth()->user()->role === 'pengajar')
                                <a href="/pengajar"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                    </svg>
                                    Panel Pengajar
                                </a>
                            @else
                                <a href="{{ route('siswa.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('kuis.riwayat-kuis') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Kuis
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200 border-t border-gray-50">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Profil
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-50">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 border border-gray-200 hover:border-purple-300 hover:text-purple-700 transition duration-200">
                        Masuk
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 rounded-xl text-sm font-bold bg-purple-700 text-white hover:bg-purple-800 transition duration-200 shadow-sm">
                            Daftar Gratis
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Mobile toggle -->
            <button id="nav-mobile-toggle"
                class="md:hidden p-2 rounded-xl text-gray-600 hover:text-purple-700 hover:bg-gray-100 transition duration-200 focus:outline-none">
                <svg id="nav-menu-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="nav-menu-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Overlay -->
<div id="nav-overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40 lg:hidden"></div>

<!-- Mobile Side Menu -->
<div id="nav-side-menu"
    class="fixed top-0 right-0 w-72 h-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 flex flex-col">

    <!-- Mobile menu header -->
    <div class="flex items-center justify-between p-5 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <span class="text-lg font-black text-purple-700">WANAQUIZ</span>
        </div>
        <button id="nav-mobile-close" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Nav links -->
    <nav class="flex-1 p-4 space-y-1">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest px-3 pb-1">Halaman</p>
        <a href="/"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition duration-200
            {{ request()->is('/') 
                ? 'bg-purple-50 text-purple-700' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-purple-700' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Beranda
        </a>
        <a href="{{ route('about') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition duration-200
            {{ request()->routeIs('about') 
                ? 'bg-purple-50 text-purple-700' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-purple-700' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Tentang Kami
        </a>

        @auth
            <div class="pt-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest px-3 pb-1">Akun</p>
                @if(auth()->user()->role === 'pengajar')
                    <a href="/pengajar" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                        Panel Pengajar
                    </a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Dashboard</a>
                    <a href="{{ route('kuis.riwayat-kuis') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Riwayat Kuis</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Edit Profil</a>
            </div>
        @endauth
    </nav>

    <!-- Bottom user section -->
    <div class="border-t border-gray-100 p-4">
        @auth
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-3">
                <div class="w-9 h-9 bg-purple-700 text-white rounded-xl flex items-center justify-center text-sm font-black flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-red-500 border border-red-100 hover:bg-red-50 transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        @else
            <div class="space-y-2">
                <a href="{{ route('login') }}"
                    class="block text-center py-2.5 rounded-xl text-sm font-semibold text-purple-700 border border-purple-200 hover:bg-purple-50 transition duration-200">
                    Masuk
                </a>
                @if(Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block text-center py-2.5 rounded-xl text-sm font-bold bg-purple-700 text-white hover:bg-purple-800 transition duration-200">
                        Daftar Gratis
                    </a>
                @endif
            </div>
        @endauth
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile sidebar
        const toggle   = document.getElementById('nav-mobile-toggle');
        const closeBtn = document.getElementById('nav-mobile-close');
        const menu     = document.getElementById('nav-side-menu');
        const overlay  = document.getElementById('nav-overlay');
        const openIcon = document.getElementById('nav-menu-open');
        const closeIcon= document.getElementById('nav-menu-close');

        function openNav() {
            menu.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeNav() {
            menu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
        }

        toggle?.addEventListener('click', () => menu.classList.contains('translate-x-full') ? openNav() : closeNav());
        closeBtn?.addEventListener('click', closeNav);
        overlay?.addEventListener('click', closeNav);
        document.addEventListener('keydown', e => e.key === 'Escape' && closeNav());

        // Desktop user dropdown
        const userBtn  = document.getElementById('desktop-user-btn');
        const userMenu = document.getElementById('desktop-user-menu');
        const userArrow= document.getElementById('desktop-user-arrow');

        userBtn?.addEventListener('click', e => {
            e.stopPropagation();
            userMenu.classList.toggle('opacity-0');
            userMenu.classList.toggle('invisible');
            userMenu.classList.toggle('scale-95');
            userArrow?.classList.toggle('rotate-180');
        });
        document.addEventListener('click', e => {
            if (userMenu && !userMenu.contains(e.target) && !userBtn.contains(e.target)) {
                userMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                userArrow?.classList.remove('rotate-180');
            }
        });
    });
</script>