<div class="space-y-6">

    {{-- ── HEADER ── --}}
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 right-24 w-24 h-24 bg-purple-100 rounded-full translate-y-10"></div>
        <div class="relative z-10 flex items-start justify-between flex-wrap gap-4">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <p class="text-sm text-purple-600 font-semibold uppercase tracking-widest">Hasil Kuis 🎯</p>
                    @if($isNilaiTerbaik)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-100 text-yellow-600 text-xs font-bold rounded-lg border border-yellow-200">
                            ⭐ Nilai Terbaik
                        </span>
                    @endif
                </div>
                <h1 class="text-2xl font-black text-gray-900 truncate">{{ $namaKuis }}</h1>
                <p class="text-gray-400 text-sm mt-0.5">
                    👤 {{ $pengajar }}
                    @if($maksPercobaan)
                        · 🔄 Percobaan ke-{{ $percobaanKe }} / {{ $maksPercobaan }}
                    @endif
                </p>
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <a href="{{ route('kuis.riwayat-kuis') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:border-purple-300 hover:text-purple-700 transition duration-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Riwayat
                </a>
                <a href="{{ route('siswa.dashboard') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </div>

    {{-- ── KARTU NILAI UTAMA ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- Nilai besar --}}
        <div class="sm:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center">
            @php
                $n = $nilaiTotal;
                $ringColor = $n >= 80 ? 'text-green-500' : ($n >= 60 ? 'text-yellow-500' : 'text-red-500');
                $ringBg    = $n >= 80 ? 'bg-green-50' : ($n >= 60 ? 'bg-yellow-50' : 'bg-red-50');
                $label     = $n >= 80 ? 'Bagus sekali!' : ($n >= 60 ? 'Lumayan!' : 'Perlu belajar lagi');
            @endphp
            <div class="w-24 h-24 rounded-full {{ $ringBg }} flex items-center justify-center mb-3 border-4
                {{ $n >= 80 ? 'border-green-200' : ($n >= 60 ? 'border-yellow-200' : 'border-red-200') }}">
                <span class="text-3xl font-black {{ $ringColor }}">{{ number_format($n, 0) }}</span>
            </div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total Nilai</p>
            <p class="text-sm font-bold {{ $ringColor }} mt-0.5">{{ $label }}</p>
        </div>

        {{-- Stat detail --}}
        <div class="sm:col-span-2 grid grid-cols-2 gap-4">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Jawaban Benar</p>
                    <p class="text-xl font-black text-green-600">{{ $jumlahBenar }}<span class="text-sm font-medium text-gray-400"> / {{ $totalSoal }}</span></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Jawaban Salah</p>
                    <p class="text-xl font-black text-red-500">{{ $jumlahSalah }}<span class="text-sm font-medium text-gray-400"> / {{ $totalSoal }}</span></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Tidak Dijawab</p>
                    <p class="text-xl font-black text-gray-500">{{ $jumlahKosong }}<span class="text-sm font-medium text-gray-400"> / {{ $totalSoal }}</span></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Durasi</p>
                    <p class="text-sm font-black text-purple-700">{{ $this->formatDurasi($durasiDetik) }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── PROGRESS BAR AKURASI ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm font-semibold text-gray-700">Akurasi Jawaban</p>
            <span class="text-sm font-black
                {{ $persentase >= 80 ? 'text-green-600' : ($persentase >= 60 ? 'text-yellow-500' : 'text-red-500') }}">
                {{ $persentase }}%
            </span>
        </div>
        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full rounded-full transition-all duration-700
                {{ $persentase >= 80 ? 'bg-green-500' : ($persentase >= 60 ? 'bg-yellow-400' : 'bg-red-500') }}"
                style="width: {{ $persentase }}%">
            </div>
        </div>
        <div class="flex justify-between text-xs text-gray-400 mt-1.5">
            <span>{{ $waktuMulai }}</span>
            <span>Selesai {{ $waktuSelesai }}</span>
        </div>
    </div>

    {{-- ── DETAIL PEMBAHASAN SOAL ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-base font-bold text-gray-800">Pembahasan Soal</h3>
            <p class="text-xs text-gray-400 mt-0.5">Lihat jawaban benar dan pilihan yang kamu buat</p>
        </div>

        <div class="divide-y divide-gray-50">
            @foreach($detailJawaban as $item)
                @php
                    $statusIcon  = $item['is_benar'] ? 'benar' : ($item['is_dijawab'] ? 'salah' : 'kosong');
                    $headerBg    = $item['is_benar'] ? 'bg-green-50' : ($item['is_dijawab'] ? 'bg-red-50' : 'bg-gray-50');
                    $badgeColor  = $item['is_benar'] ? 'bg-green-100 text-green-700 border-green-200' : ($item['is_dijawab'] ? 'bg-red-100 text-red-600 border-red-200' : 'bg-gray-100 text-gray-500 border-gray-200');
                    $badgeLabel  = $item['is_benar'] ? '✓ Benar' : ($item['is_dijawab'] ? '✗ Salah' : '— Kosong');
                @endphp

                <div class="overflow-hidden">
                    {{-- Soal header --}}
                    <div class="flex items-center gap-3 px-6 py-3 {{ $headerBg }}">
                        <span class="w-7 h-7 rounded-lg bg-white shadow-sm text-xs font-black text-gray-700 flex items-center justify-center flex-shrink-0 border border-gray-100">
                            {{ $item['nomor'] }}
                        </span>
                        <span class="flex-1 text-sm font-semibold text-gray-800 leading-snug">
                            {{ $item['teks'] }}
                        </span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($item['bobot'] > 1)
                                <span class="text-xs bg-yellow-50 text-yellow-600 font-semibold px-2 py-0.5 rounded-lg border border-yellow-100">
                                    {{ $item['bobot'] }} poin
                                </span>
                            @endif
                            <span class="text-xs font-bold px-2.5 py-1 rounded-lg border {{ $badgeColor }}">
                                {{ $badgeLabel }}
                            </span>
                        </div>
                    </div>

                    {{-- Opsi jawaban --}}
                    <div class="px-6 py-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($item['opsi'] as $opsi)
                            @php
                                // Tentukan style setiap opsi
                                if ($opsi['benar'] && $opsi['dipilih']) {
                                    // Benar & dipilih → hijau solid
                                    $opsiClass = 'border-green-500 bg-green-50 text-green-700';
                                    $dotClass  = 'border-green-500 bg-green-500';
                                    $icon      = '✓';
                                } elseif ($opsi['benar'] && !$opsi['dipilih']) {
                                    // Benar tapi tidak dipilih → hijau outline (kunci jawaban)
                                    $opsiClass = 'border-green-300 bg-green-50/50 text-green-600';
                                    $dotClass  = 'border-green-300';
                                    $icon      = '✓';
                                } elseif (!$opsi['benar'] && $opsi['dipilih']) {
                                    // Salah & dipilih → merah
                                    $opsiClass = 'border-red-400 bg-red-50 text-red-600';
                                    $dotClass  = 'border-red-400 bg-red-400';
                                    $icon      = '✗';
                                } else {
                                    // Salah & tidak dipilih → abu normal
                                    $opsiClass = 'border-gray-200 bg-white text-gray-600';
                                    $dotClass  = 'border-gray-300';
                                    $icon      = '';
                                }
                            @endphp
                            <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border text-sm {{ $opsiClass }}">
                                <span class="w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0 text-xs font-black {{ $dotClass }}">
                                    @if($icon)
                                        <span class="leading-none">{{ $icon }}</span>
                                    @endif
                                </span>
                                <span class="leading-snug">{{ $opsi['text'] }}</span>
                                @if($opsi['benar'])
                                    <span class="ml-auto text-xs font-bold text-green-600 flex-shrink-0">Kunci</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Poin yang diperoleh --}}
                    @if($item['nilai'] > 0)
                        <div class="px-6 pb-3">
                            <span class="text-xs text-green-600 font-semibold">
                                +{{ number_format($item['nilai'], 0) }} poin diperoleh
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── TOMBOL BAWAH ── --}}
    <div class="flex items-center justify-between gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
        <a href="{{ route('kuis.riwayat-kuis') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 font-medium hover:text-purple-700 transition duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Lihat Semua Riwayat
        </a>
        <a href="{{ route('siswa.dashboard') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

</div>