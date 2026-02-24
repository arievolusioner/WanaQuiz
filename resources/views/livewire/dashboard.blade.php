{{-- SATU ROOT ELEMENT (Livewire requirement) --}}
<div>

    {{-- =============================== --}}
    {{-- KONTEN DASHBOARD                --}}
    {{-- =============================== --}}
    <div class="space-y-6">

        {{-- Welcome Banner --}}
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 right-24 w-24 h-24 bg-purple-100 rounded-full translate-y-10"></div>
            <div class="relative z-10">
                <p class="text-sm text-purple-600 font-semibold uppercase tracking-widest mb-1">Selamat Datang 👋</p>
                <h1 class="text-2xl font-black text-gray-900 mb-1">
                    Halo, <span class="text-purple-700">{{ $nama }}</span>!
                </h1>
                <p class="text-gray-500 text-sm">Siap belajar hari ini? Mulai kuis dan tingkatkan nilaimu.</p>
                <button
                    wire:click="bukaModal"
                    class="inline-flex items-center mt-4 px-5 py-2.5 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Mulai Kuis Sekarang
                </button>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Kuis Dikerjakan</p>
                    <p class="text-2xl font-black text-gray-900">{{ $totalKuis }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Rata-rata Nilai</p>
                    <p class="text-2xl font-black text-gray-900">{{ $rataRata }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Nilai Tertinggi</p>
                    <p class="text-2xl font-black text-gray-900">{{ $nilaiTertinggi }}</p>
                </div>
            </div>
        </div>

        {{-- Riwayat Kuis Terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-bold text-gray-800">Riwayat Kuis Terbaru</h3>
                <a href="{{ route('kuis.riwayat-kuis') }}" class="text-xs text-purple-700 font-semibold hover:underline">Lihat Semua →</a>
            </div>

            @if($riwayat->count() > 0)
                <div class="divide-y divide-gray-50">
                    @foreach($riwayat as $item)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition duration-150">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $item->kuis->nama_kuis ?? 'Kuis' }}</p>
                                    <p class="text-xs text-gray-400">
                                        {{ $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y, H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-black
                                    @if(($item->nilai_total ?? 0) >= 80) text-green-600
                                    @elseif(($item->nilai_total ?? 0) >= 60) text-yellow-500
                                    @else text-red-500
                                    @endif">
                                    {{ $item->nilai_total ?? 0 }}
                                </span>
                                <a href="{{ route('kuis.lihat-nilai', $item->id) }}"
                                    class="text-xs text-purple-700 font-medium hover:underline">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-14 px-6 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-purple-50 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Belum ada kuis yang dikerjakan.</p>
                    <p class="text-gray-400 text-xs mt-1">Mulai kuis pertamamu sekarang!</p>
                    <button wire:click="bukaModal"
                        class="mt-4 px-4 py-2 bg-purple-700 text-white text-xs font-semibold rounded-lg hover:bg-purple-800 transition duration-200">
                        Mulai Kuis
                    </button>
                </div>
            @endif
        </div>

    </div>


    {{-- =============================== --}}
    {{-- MODAL MASUK KUIS                --}}
    {{-- =============================== --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center" aria-modal="true" role="dialog">

        {{-- Backdrop --}}
        <div wire:click="tutupModal" class="absolute inset-0 bg-black bg-opacity-40 backdrop-blur-sm"></div>

        {{-- Modal Card --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-black text-gray-900">Masuk Kuis</h2>
                        <p class="text-xs text-gray-400">Gunakan kode atau scan QR</p>
                    </div>
                </div>
                <button wire:click="tutupModal" class="text-gray-400 hover:text-gray-600 transition duration-150 rounded-lg p-1 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Tab Switcher --}}
            <div class="flex mx-6 mt-5 bg-gray-100 rounded-xl p-1 gap-1">
                <button
                    id="tab-kode"
                    onclick="switchTab('kode')"
                    class="flex-1 flex items-center justify-center gap-2 py-2 text-sm font-semibold rounded-lg transition duration-200 bg-white text-purple-700 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    Kode Kuis
                </button>
                <button
                    id="tab-qr"
                    onclick="switchTab('qr')"
                    class="flex-1 flex items-center justify-center gap-2 py-2 text-sm font-semibold rounded-lg transition duration-200 text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                    Scan QR
                </button>
            </div>

            {{-- ── TAB: KODE KUIS ── --}}
            <div id="panel-kode" class="px-6 py-5">

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Kode Kuis</label>
                    <input
                        wire:model="kodeInput"
                        wire:keydown.enter="cekKode"
                        type="text"
                        placeholder="Contoh: HW9P2P"
                        maxlength="10"
                        class="w-full text-center text-2xl font-black tracking-[0.4em] uppercase border-2 border-gray-200 rounded-xl py-4 px-4 text-gray-900 placeholder:text-gray-300 placeholder:text-base placeholder:font-normal placeholder:tracking-normal focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition duration-200"
                    />
                </div>

                {{-- Alert Error --}}
                @if($errorPesan)
                    <div class="mb-4 flex items-start gap-2 bg-red-50 border border-red-200 text-red-600 text-sm font-medium px-4 py-3 rounded-xl">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $errorPesan }}
                    </div>
                @endif

                {{-- Info Kuis --}}
                @if($kuisValid && $kuisInfo)
                    @if(!empty($kuisInfo['is_lanjut']) && $kuisInfo['is_lanjut'])
                        <div class="mb-4 bg-orange-50 border border-orange-200 px-4 py-3 rounded-xl">
                            <div class="flex items-center gap-2 text-orange-700 font-semibold text-sm mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kamu punya kuis yang belum selesai!
                            </div>
                            <p class="text-sm font-black text-gray-900">{{ $kuisInfo['nama_kuis'] }}</p>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2">
                                <span class="text-xs text-gray-500">👤 {{ $kuisInfo['pengajar'] }}</span>
                                <span class="text-xs text-orange-600 font-semibold">⏱ Sisa ± {{ $kuisInfo['sisa_menit'] ?? '?' }} menit</span>
                                <span class="text-xs text-gray-500">🔄 Percobaan ke-{{ $kuisInfo['percobaan_ke'] }}</span>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 bg-green-50 border border-green-200 px-4 py-3 rounded-xl">
                            <div class="flex items-center gap-2 text-green-700 font-semibold text-sm mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kuis ditemukan!
                            </div>
                            <p class="text-sm font-black text-gray-900">{{ $kuisInfo['nama_kuis'] }}</p>
                            @if($kuisInfo['deskripsi'])
                                <p class="text-xs text-gray-500 mt-0.5">{{ $kuisInfo['deskripsi'] }}</p>
                            @endif
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2">
                                <span class="text-xs text-gray-500">👤 {{ $kuisInfo['pengajar'] }}</span>
                                <span class="text-xs text-gray-500">📝 {{ $kuisInfo['total_soal'] }} soal</span>
                                @if($kuisInfo['waktu_pengerjaan'])
                                    <span class="text-xs text-gray-500">⏱ {{ $kuisInfo['waktu_pengerjaan'] }} menit</span>
                                @endif
                                @if($kuisInfo['maks_percobaan'])
                                    <span class="text-xs text-gray-500">🔄 Percobaan ke-{{ $kuisInfo['percobaan_ke'] }} / {{ $kuisInfo['maks_percobaan'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Tombol aksi --}}
                <div class="flex flex-col gap-2">
                    @if(! $kuisValid)
                        <button
                            wire:click="cekKode"
                            wire:loading.attr="disabled"
                            class="w-full flex items-center justify-center gap-2 py-3 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm disabled:opacity-60">
                            <span wire:loading.remove wire:target="cekKode" class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cek Kode Kuis
                            </span>
                            <span wire:loading wire:target="cekKode" class="flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                </svg>
                                Mencari kuis...
                            </span>
                        </button>
                    @endif

                    @if($kuisValid)
                        @if(!empty($kuisInfo['is_lanjut']) && $kuisInfo['is_lanjut'])
                            <button
                                wire:click="bergabungKuis"
                                wire:loading.attr="disabled"
                                class="w-full flex items-center justify-center gap-2 py-3 bg-orange-500 text-white text-sm font-semibold rounded-xl hover:bg-orange-600 transition duration-200 shadow-sm disabled:opacity-60">
                                <span wire:loading.remove wire:target="bergabungKuis" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lanjutkan Kuis
                                </span>
                                <span wire:loading wire:target="bergabungKuis" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                    </svg>
                                    Membuka kuis...
                                </span>
                            </button>
                        @else
                            <button
                                wire:click="bergabungKuis"
                                wire:loading.attr="disabled"
                                class="w-full flex items-center justify-center gap-2 py-3 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 transition duration-200 shadow-sm disabled:opacity-60">
                                <span wire:loading.remove wire:target="bergabungKuis" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Mulai Kerjakan Kuis
                                </span>
                                <span wire:loading wire:target="bergabungKuis" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                    </svg>
                                    Menyiapkan kuis...
                                </span>
                            </button>
                        @endif

                        <button
                            wire:click="resetState"
                            class="w-full py-2.5 text-sm text-gray-500 font-medium hover:text-purple-700 transition duration-200">
                            ← Ganti kode kuis
                        </button>
                    @endif
                </div>
            </div>

            {{-- ── TAB: SCAN QR ── --}}
            <div id="panel-qr" class="px-6 py-5 hidden">
                <div class="flex flex-col items-center text-center">

                    {{-- Area Kamera --}}
                    <div class="relative w-full max-w-xs aspect-square bg-gray-900 rounded-2xl overflow-hidden mb-4" id="qr-container">

                        {{-- Video stream --}}
                        <video id="qr-video" class="w-full h-full object-cover" playsinline></video>

                        {{-- Canvas tersembunyi untuk proses frame --}}
                        <canvas id="qr-canvas" class="hidden"></canvas>

                        {{-- Overlay sudut scanner --}}
                        <div class="absolute inset-4 pointer-events-none">
                            <div class="absolute top-0 left-0 w-8 h-8 border-white rounded-tl-xl" style="border-top-width:3px; border-left-width:3px;"></div>
                            <div class="absolute top-0 right-0 w-8 h-8 border-white rounded-tr-xl" style="border-top-width:3px; border-right-width:3px;"></div>
                            <div class="absolute bottom-0 left-0 w-8 h-8 border-white rounded-bl-xl" style="border-bottom-width:3px; border-left-width:3px;"></div>
                            <div class="absolute bottom-0 right-0 w-8 h-8 border-white rounded-br-xl" style="border-bottom-width:3px; border-right-width:3px;"></div>
                        </div>

                        {{-- Scan line animasi --}}
                        <div id="scan-line" class="absolute left-4 right-4 h-0.5 bg-purple-400 opacity-0" style="top: 20%;"></div>

                        {{-- Placeholder saat kamera belum aktif --}}
                        <div id="qr-placeholder" class="absolute inset-0 flex flex-col items-center justify-center gap-3 bg-gray-900">
                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-sm text-gray-400">Kamera belum aktif</p>
                        </div>

                        {{-- Status scanning --}}
                        <div id="qr-status" class="absolute bottom-3 left-0 right-0 flex justify-center">
                            <span class="hidden bg-black/60 text-white text-xs font-medium px-3 py-1.5 rounded-full" id="qr-status-text">
                                Mencari QR code...
                            </span>
                        </div>

                        {{-- Success overlay --}}
                        <div id="qr-success" class="hidden absolute inset-0 bg-green-600/80 flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-sm font-bold" id="qr-success-text">QR Terdeteksi!</p>
                            </div>
                        </div>
                    </div>

                    {{-- Error kamera --}}
                    <div id="qr-error-msg" class="hidden w-full mb-4 flex items-start gap-2 bg-red-50 border border-red-200 text-red-600 text-sm font-medium px-4 py-3 rounded-xl text-left">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span id="qr-error-text">Tidak dapat mengakses kamera.</span>
                    </div>

                    <p class="text-sm font-semibold text-gray-700 mb-1">Arahkan kamera ke QR Code kuis</p>
                    <p class="text-xs text-gray-400 mb-5">QR Code bisa diminta dari guru atau dipampang di kelas</p>

                    <button
                        id="btn-kamera"
                        onclick="startQrScan()"
                        class="w-full flex items-center justify-center gap-2 py-3 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Aktifkan Kamera
                    </button>

                    <button
                        id="btn-stop-kamera"
                        onclick="stopQrScan()"
                        class="hidden w-full flex items-center justify-center gap-2 py-3 bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-300 transition duration-200 mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                        </svg>
                        Hentikan Kamera
                    </button>
                </div>
            </div>

            {{-- Footer hint --}}
            <div class="px-6 pb-5">
                <p class="text-xs text-gray-400 text-center">Kode kuis didapat dari guru atau papan kelas</p>
            </div>

        </div>
    </div>
    @endif


    {{-- =============================== --}}
    {{-- STYLES & SCRIPTS                --}}
    {{-- =============================== --}}

    <style>
        @keyframes scanLine {
            0%   { top: 15%; opacity: 1; }
            50%  { top: 80%; opacity: 1; }
            100% { top: 15%; opacity: 1; }
        }
        .scanning #scan-line {
            opacity: 1 !important;
            animation: scanLine 2s ease-in-out infinite;
        }
    </style>

    {{-- jsQR: decode QR dari video frame --}}
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>

    <script>
        // =============================================
        // TAB SWITCHING
        // =============================================
        function switchTab(tab) {
            const isKode = tab === 'kode';

            document.getElementById('panel-kode').classList.toggle('hidden', !isKode);
            document.getElementById('panel-qr').classList.toggle('hidden', isKode);

            const tabKode = document.getElementById('tab-kode');
            const tabQr   = document.getElementById('tab-qr');

            if (isKode) {
                tabKode.classList.add('bg-white', 'text-purple-700', 'shadow-sm');
                tabKode.classList.remove('text-gray-500');
                tabQr.classList.remove('bg-white', 'text-purple-700', 'shadow-sm');
                tabQr.classList.add('text-gray-500');
                stopQrScan();
            } else {
                tabQr.classList.add('bg-white', 'text-purple-700', 'shadow-sm');
                tabQr.classList.remove('text-gray-500');
                tabKode.classList.remove('bg-white', 'text-purple-700', 'shadow-sm');
                tabKode.classList.add('text-gray-500');
            }
        }

        // =============================================
        // QR SCANNER
        // =============================================
        let qrStream       = null;
        let qrAnimFrame    = null;
        let qrAlreadyFound = false;

        async function startQrScan() {
            const video       = document.getElementById('qr-video');
            const canvas      = document.getElementById('qr-canvas');
            const placeholder = document.getElementById('qr-placeholder');
            const container   = document.getElementById('qr-container');
            const btnStart    = document.getElementById('btn-kamera');
            const btnStop     = document.getElementById('btn-stop-kamera');
            const errorDiv    = document.getElementById('qr-error-msg');
            const statusText  = document.getElementById('qr-status-text');

            // Reset state
            errorDiv.classList.add('hidden');
            qrAlreadyFound = false;

            try {
                qrStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment',
                        width:  { ideal: 1280 },
                        height: { ideal: 720 },
                    }
                });

                video.srcObject = qrStream;
                await video.play();

                placeholder.style.display = 'none';
                container.classList.add('scanning');
                btnStart.classList.add('hidden');
                btnStop.classList.remove('hidden');
                statusText.classList.remove('hidden');
                statusText.textContent = 'Mencari QR code...';

                scanFrame(video, canvas);

            } catch (err) {
                const errorText = document.getElementById('qr-error-text');
                errorDiv.classList.remove('hidden');
                if (err.name === 'NotAllowedError') {
                    errorText.textContent = 'Izin kamera ditolak. Aktifkan izin kamera di pengaturan browser.';
                } else if (err.name === 'NotFoundError') {
                    errorText.textContent = 'Kamera tidak ditemukan di perangkat ini.';
                } else {
                    errorText.textContent = 'Gagal mengakses kamera: ' + err.message;
                }
            }
        }

        function stopQrScan() {
            if (qrStream) {
                qrStream.getTracks().forEach(track => track.stop());
                qrStream = null;
            }
            if (qrAnimFrame) {
                cancelAnimationFrame(qrAnimFrame);
                qrAnimFrame = null;
            }

            const video       = document.getElementById('qr-video');
            const placeholder = document.getElementById('qr-placeholder');
            const container   = document.getElementById('qr-container');
            const btnStart    = document.getElementById('btn-kamera');
            const btnStop     = document.getElementById('btn-stop-kamera');
            const statusText  = document.getElementById('qr-status-text');
            const successDiv  = document.getElementById('qr-success');

            if (video)       video.srcObject = null;
            if (placeholder) placeholder.style.display = '';
            if (container)   container.classList.remove('scanning');
            if (btnStart)    btnStart.classList.remove('hidden');
            if (btnStop)     btnStop.classList.add('hidden');
            if (statusText)  statusText.classList.add('hidden');
            if (successDiv)  successDiv.classList.add('hidden');
        }

        function scanFrame(video, canvas) {
            // Tunggu video siap
            if (!video.videoWidth) {
                qrAnimFrame = requestAnimationFrame(() => scanFrame(video, canvas));
                return;
            }

            canvas.width  = video.videoWidth;
            canvas.height = video.videoHeight;

            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: 'dontInvert',
            });

            if (code && !qrAlreadyFound) {
                qrAlreadyFound = true;
                onQrFound(code.data);
                return;
            }

            qrAnimFrame = requestAnimationFrame(() => scanFrame(video, canvas));
        }

        function onQrFound(rawData) {
            // QR berisi kode kuis (huruf kapital)
            const kode = rawData.trim().toUpperCase();

            const successDiv  = document.getElementById('qr-success');
            const successText = document.getElementById('qr-success-text');
            const statusText  = document.getElementById('qr-status-text');

            // Tampilkan overlay sukses
            if (successDiv)  successDiv.classList.remove('hidden');
            if (successText) successText.textContent = 'Kode: ' + kode;
            if (statusText)  statusText.classList.add('hidden');

            // Setelah 800ms: stop kamera → pindah ke tab kode → kirim ke Livewire
            setTimeout(() => {
                stopQrScan();
                switchTab('kode');

                // handleQrScan akan mengisi kodeInput & memanggil cekKode() otomatis
                @this.handleQrScan(kode);
            }, 800);
        }

        // =============================================
        // KEYBOARD & NAVIGATION
        // =============================================

        // ESC → tutup modal
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                stopQrScan();
                @this.tutupModal();
            }
        });

        // Stop kamera saat Livewire navigasi (SPA)
        document.addEventListener('livewire:navigating', stopQrScan);
    </script>

</div>