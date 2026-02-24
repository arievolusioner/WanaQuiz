<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QR Code — {{ $kuis->nama_kuis }} | {{ config('app.name', 'WanaQuiz') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Halaman tidak bisa di-scroll */

        /* Wrapper utama: isi ruang antara nav dan footer */
        #qr-wrapper {
            height: calc(100vh - 64px - 57px); /* tinggi nav ≈ 64px, footer bottom bar ≈ 57px */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes pulse-border {
            0%, 100% { box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.3); }
            50%       { box-shadow: 0 0 0 12px rgba(124, 58, 237, 0); }
        }
        .qr-pulse { animation: pulse-border 2.5s ease-in-out infinite; }

        @media print {
            nav, footer, .no-print { display: none !important; }
            html, body { overflow: visible !important; height: auto !important; }
            #qr-wrapper { height: auto !important; overflow: visible !important; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-purple-50 via-white to-indigo-50">

    {{-- ── NAVBAR (dari navigation.blade.php) ── --}}
    @include('layouts.navigation')

    {{-- ── KONTEN UTAMA — tidak bisa discroll ── --}}
    <div id="qr-wrapper">
        <div class="w-full max-w-5xl mx-auto px-4">

            {{-- Grid 2 kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-center">

                {{-- ── KOLOM KIRI: QR CODE ── --}}
                <div class="bg-white rounded-3xl shadow-lg border border-purple-100 p-6 flex flex-col items-center">

                    {{-- Header kuis --}}
                    <div class="text-center mb-4 w-full">
                        <div class="inline-flex items-center gap-1.5 bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full mb-2">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            QR Code Kuis
                        </div>
                        <h1 class="text-xl font-black text-gray-900 leading-tight">{{ $kuis->nama_kuis }}</h1>
                        @if($kuis->deskripsi)
                            <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $kuis->deskripsi }}</p>
                        @endif
                    </div>

                    {{-- Badge status --}}
                    <div class="mb-4">
                        @if($kuis->status === 'aktif')
                            <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                Aktif — Siap Digunakan
                            </span>
                        @elseif($kuis->status === 'draft')
                            <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                Draft — Belum Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                Selesai — Kuis Ditutup
                            </span>
                        @endif
                    </div>

                    {{-- QR Image --}}
                    <div class="qr-pulse p-4 bg-white border-2 border-purple-100 rounded-2xl mb-4">
                        <img
                            src="{{ $qrUrl }}"
                            alt="QR Code {{ $kuis->kode_kuis }}"
                            class="w-52 h-52 block"
                        />
                    </div>

                    {{-- Kode teks --}}
                    <div class="text-center mb-4">
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-widest mb-1.5">Atau masukkan kode</p>
                        <div class="flex items-center gap-2 bg-purple-50 rounded-xl px-5 py-2.5">
                            <span class="text-2xl font-black tracking-[0.4em] text-purple-700 font-mono">
                                {{ $kuis->kode_kuis }}
                            </span>
                            <button onclick="copyKode()" title="Salin kode"
                                class="text-purple-400 hover:text-purple-700 transition p-1 rounded-lg hover:bg-purple-100 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        <p id="copy-toast" class="text-xs text-green-600 font-semibold mt-1 opacity-0 transition-opacity duration-300">
                            ✓ Kode berhasil disalin!
                        </p>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="no-print flex gap-2 w-full">
                        <button onclick="window.print()"
                            class="flex-1 flex items-center justify-center gap-1.5 py-2 bg-gray-100 text-gray-700 text-xs font-semibold rounded-xl hover:bg-gray-200 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak
                        </button>
                        <a href="{{ $qrUrl }}" download="qr-{{ $kuis->kode_kuis }}.svg"
                            class="flex-1 flex items-center justify-center gap-1.5 py-2 bg-purple-700 text-white text-xs font-semibold rounded-xl hover:bg-purple-800 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download SVG
                        </a>
                        <a href="{{ url()->previous() }}"
                            class="flex items-center justify-center gap-1.5 px-3 py-2 bg-white border border-gray-200 text-gray-600 text-xs font-semibold rounded-xl hover:bg-gray-50 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>

                    @if($kuis->status !== 'aktif')
                        <div class="mt-3 w-full bg-yellow-50 border border-yellow-200 rounded-xl p-2.5 flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-xs text-yellow-700">
                                <strong>Kuis belum aktif.</strong> Aktifkan terlebih dahulu agar bisa digunakan siswa.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- ── KOLOM KANAN: DETAIL + CARA PAKAI ── --}}
                <div class="flex flex-col gap-4">

                    {{-- Detail kuis --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Detail Kuis</h2>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-3">

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Pengajar</p>
                                    <p class="text-xs font-bold text-gray-800 truncate max-w-[100px]">{{ $kuis->pengajar?->name ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Jumlah Soal</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $jumlahSoal }} soal</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Durasi</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $kuis->waktu_pengerjaan ?? '-' }} menit</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Maks. Percobaan</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $kuis->maks_percobaan ?? 1 }}x</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Total Peserta</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $jumlahPeserta }} siswa</p>
                                </div>
                            </div>

                            @if($kuis->mulai_dari)
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Mulai</p>
                                    <p class="text-xs font-bold text-gray-800">{{ \Carbon\Carbon::parse($kuis->mulai_dari)->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($kuis->akhir_pada)
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 leading-none mb-0.5">Berakhir</p>
                                    <p class="text-xs font-bold text-gray-800">{{ \Carbon\Carbon::parse($kuis->akhir_pada)->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    {{-- Pengaturan --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Pengaturan</h2>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-2 p-2.5 rounded-xl {{ $kuis->acak_soal ? 'bg-green-50' : 'bg-gray-50' }}">
                                <span class="text-sm">{{ $kuis->acak_soal ? '✅' : '⬜' }}</span>
                                <span class="text-xs font-semibold {{ $kuis->acak_soal ? 'text-green-700' : 'text-gray-400' }}">Acak Soal</span>
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl {{ $kuis->acak_opsi ? 'bg-green-50' : 'bg-gray-50' }}">
                                <span class="text-sm">{{ $kuis->acak_opsi ? '✅' : '⬜' }}</span>
                                <span class="text-xs font-semibold {{ $kuis->acak_opsi ? 'text-green-700' : 'text-gray-400' }}">Acak Opsi</span>
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl {{ $kuis->is_public ? 'bg-green-50' : 'bg-gray-50' }}">
                                <span class="text-sm">{{ $kuis->is_public ? '🌐' : '🔒' }}</span>
                                <span class="text-xs font-semibold {{ $kuis->is_public ? 'text-green-700' : 'text-gray-400' }}">{{ $kuis->is_public ? 'Publik' : 'Privat' }}</span>
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-gray-50">
                                <span class="text-sm">📅</span>
                                <span class="text-xs font-semibold text-gray-500">{{ \Carbon\Carbon::parse($kuis->created_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Cara siswa bergabung --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-3xl p-5">
                        <p class="text-xs font-bold text-blue-700 mb-2.5 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Cara Siswa Bergabung
                        </p>
                        <ol class="text-xs text-blue-600 space-y-1 list-decimal list-inside leading-relaxed">
                            <li>Buka <strong>Dashboard Siswa</strong> di browser</li>
                            <li>Klik tombol <strong>"Mulai Kuis Sekarang"</strong></li>
                            <li>Pilih tab <strong>"Scan QR"</strong> → aktifkan kamera</li>
                            <li>Arahkan ke QR Code ini → kuis langsung terdeteksi!</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ── FOOTER ── --}}
    @include('layouts.footer')

    <script>
        function copyKode() {
            navigator.clipboard.writeText('{{ $kuis->kode_kuis }}').then(() => {
                const toast = document.getElementById('copy-toast');
                toast.style.opacity = '1';
                setTimeout(() => { toast.style.opacity = '0'; }, 2000);
            });
        }
    </script>

</body>
</html>