<div class="space-y-6">

    {{-- ── HEADER ── --}}
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 right-24 w-24 h-24 bg-purple-100 rounded-full translate-y-10"></div>
        <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-sm text-purple-600 font-semibold uppercase tracking-widest mb-1">Rekap Belajar 📋</p>
                <h1 class="text-2xl font-black text-gray-900">Riwayat Kuis</h1>
                <p class="text-gray-500 text-sm mt-0.5">Semua kuis yang sudah kamu kerjakan</p>
            </div>
            <a href="{{ route('siswa.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:border-purple-300 hover:text-purple-700 transition duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Kuis</p>
                <p class="text-xl font-black text-gray-900">{{ $totalSelesai }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Rata-rata</p>
                <p class="text-xl font-black text-gray-900">{{ $rataRata }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Tertinggi</p>
                <p class="text-xl font-black text-green-600">{{ $nilaiTertinggi }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Terendah</p>
                <p class="text-xl font-black text-red-500">{{ $nilaiTerendah }}</p>
            </div>
        </div>

    </div>

    {{-- ── FILTER & SEARCH ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex flex-wrap items-center gap-3">

            {{-- Search --}}
            <div class="relative flex-1 min-w-48">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    wire:model.live.debounce.300ms="cari"
                    type="text"
                    placeholder="Cari nama kuis..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition duration-200"
                />
            </div>

            {{-- Filter nilai --}}
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs text-gray-400 font-medium hidden sm:block">Filter:</span>
                @foreach(['' => 'Semua', 'tinggi' => '≥ 80', 'sedang' => '60–79', 'rendah' => '< 60'] as $val => $label)
                    <button
                        wire:click="$set('filterNilai', '{{ $val }}')"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition duration-150
                            {{ $filterNilai === $val
                                ? 'bg-purple-700 text-white border-purple-700'
                                : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-purple-300 hover:text-purple-700' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

        </div>
    </div>

    {{-- ── TABEL RIWAYAT ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Header tabel --}}
        <div class="grid grid-cols-12 gap-2 px-5 py-3 bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
            <div class="col-span-5">Kuis</div>
            <div class="col-span-2 text-center hidden sm:block">Percobaan</div>
            <div class="col-span-2 text-center">
                <button wire:click="sortToggle('nilai_total')" class="flex items-center gap-1 mx-auto hover:text-purple-700 transition">
                    Nilai
                    @if($sortBy === 'nilai_total')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($sortDir === 'asc')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            @endif
                        </svg>
                    @else
                        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    @endif
                </button>
            </div>
            <div class="col-span-3 text-right">
                <button wire:click="sortToggle('waktu_selesai')" class="flex items-center gap-1 ml-auto hover:text-purple-700 transition">
                    Tanggal
                    @if($sortBy === 'waktu_selesai')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($sortDir === 'asc')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            @endif
                        </svg>
                    @else
                        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    @endif
                </button>
            </div>
        </div>

        {{-- Baris data --}}
        @forelse($riwayat as $item)
            @php
                $nilai = (float) $item->nilai_total;
                $nilaiClass = $nilai >= 80 ? 'text-green-600' : ($nilai >= 60 ? 'text-yellow-500' : 'text-red-500');
                $badgeBg    = $nilai >= 80 ? 'bg-green-50 border-green-100' : ($nilai >= 60 ? 'bg-yellow-50 border-yellow-100' : 'bg-red-50 border-red-100');
                $label      = $nilai >= 80 ? 'Bagus' : ($nilai >= 60 ? 'Cukup' : 'Perlu belajar');
            @endphp
            <div class="grid grid-cols-12 gap-2 items-center px-5 py-4 border-b border-gray-50 hover:bg-gray-50/60 transition duration-150 last:border-b-0">

                {{-- Nama kuis --}}
                <div class="col-span-5 flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-xl flex-shrink-0 flex items-center justify-center
                        {{ $item->is_nilai_terbaik ? 'bg-yellow-100' : 'bg-purple-100' }}">
                        @if($item->is_nilai_terbaik)
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">
                            {{ $item->kuis->nama_kuis ?? '-' }}
                        </p>
                        <p class="text-xs text-gray-400 truncate">
                            👤 {{ $item->kuis->pengajar?->name ?? 'Pengajar' }}
                        </p>
                    </div>
                </div>

                {{-- Percobaan --}}
                <div class="col-span-2 text-center hidden sm:block">
                    <span class="text-xs text-gray-500 font-medium">
                        ke-{{ $item->percobaan_ke }}
                        @if($item->kuis->maks_percobaan)
                            / {{ $item->kuis->maks_percobaan }}
                        @endif
                    </span>
                </div>

                {{-- Nilai --}}
                <div class="col-span-2 flex justify-center">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-black border {{ $badgeBg }} {{ $nilaiClass }}">
                        {{ number_format($nilai, 0) }}
                    </span>
                </div>

                {{-- Tanggal --}}
                <div class="col-span-3 text-right">
                    <p class="text-xs text-gray-500 font-medium">
                        {{ $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y') : '-' }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') : '' }}
                    </p>
                </div>

            </div>
        @empty
            <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-purple-50 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                @if($cari || $filterNilai)
                    <p class="text-gray-500 text-sm font-medium">Tidak ada kuis yang cocok dengan filter.</p>
                    <button wire:click="$set('cari', ''); $set('filterNilai', '')"
                        class="mt-3 text-xs text-purple-700 font-semibold hover:underline">
                        Reset filter
                    </button>
                @else
                    <p class="text-gray-500 text-sm font-medium">Belum ada kuis yang diselesaikan.</p>
                    <p class="text-gray-400 text-xs mt-1">Mulai kuis dari dashboard!</p>
                    <a href="{{ route('siswa.dashboard') }}"
                        class="mt-4 px-4 py-2 bg-purple-700 text-white text-xs font-semibold rounded-lg hover:bg-purple-800 transition duration-200">
                        Ke Dashboard
                    </a>
                @endif
            </div>
        @endforelse

    </div>

    {{-- ── PAGINATION ── --}}
    @if($riwayat->hasPages())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
            {{ $riwayat->links() }}
        </div>
    @endif

</div>