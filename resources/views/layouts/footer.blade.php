<footer class="bg-gray-900 text-white">

    <!-- Main footer content -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Brand -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl font-black text-white tracking-tight">WANAQUIZ</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Platform kuis online modern untuk pembelajaran yang lebih cerdas, cepat, dan menyenangkan.
                </p>
            </div>

            <!-- Menu -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Halaman</h4>
                <ul class="space-y-2.5">
                    <li><a href="/" class="text-sm text-gray-400 hover:text-purple-400 transition duration-200">Beranda</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-purple-400 transition duration-200">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Fitur -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Fitur</h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-purple-400 transition duration-200">Mulai Kuis</a></li>
                    <li><a href="{{ route('register') }}" class="text-sm text-gray-400 hover:text-purple-400 transition duration-200">Daftar Gratis</a></li>
                    @auth
                        @if(auth()->user()->role !== 'pengajar')
                            <li><a href="{{ route('kuis.riwayat-kuis') }}" class="text-sm text-gray-400 hover:text-purple-400 transition duration-200">Riwayat Kuis</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Kontak</h4>
                <ul class="space-y-2.5">
                    <li class="flex items-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@wanaquiz.com
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        (021) 1234-5678
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} WanaQuiz. All rights reserved.</p>
        </div>
    </div>

</footer>