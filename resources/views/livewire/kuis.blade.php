<div
    x-data="kuisTimer({{ $sisaDetik }}, {{ $totalSoal }})"
    x-init="init()"
    class="relative">

    {{-- ============================== --}}
    {{-- HEADER BAR — sticky atas       --}}
    {{-- ============================== --}}
    <div class="sticky top-0 z-30 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

            {{-- Info kuis --}}
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-black text-gray-900 truncate">{{ $namaKuis }}</p>
                    <p class="text-xs text-gray-400">👤 {{ $pengajar }} · 📝 {{ $totalSoal }} soal</p>
                </div>
            </div>

            {{-- Timer --}}
            <div
                class="flex items-center gap-2 px-4 py-2 rounded-xl font-mono font-black text-base transition-colors duration-300"
                :class="sisaDetik <= 60
                    ? 'bg-red-50 text-red-600 border border-red-200'
                    : sisaDetik <= 300
                        ? 'bg-yellow-50 text-yellow-600 border border-yellow-200'
                        : 'bg-purple-50 text-purple-700 border border-purple-200'">
                <svg class="w-4 h-4 flex-shrink-0" :class="sisaDetik <= 60 ? 'animate-pulse' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-text="formatWaktu(sisaDetik)">{{ gmdate('H:i:s', $sisaDetik) }}</span>
            </div>

            {{-- Progress --}}
            <div class="hidden sm:flex items-center gap-2 text-xs text-gray-500 font-medium flex-shrink-0">
                <span x-text="terjawab"></span>/<span>{{ $totalSoal }}</span> dijawab
                <div class="w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-600 rounded-full transition-all duration-300"
                        :style="`width: ${(terjawab / {{ $totalSoal }}) * 100}%`"></div>
                </div>
            </div>

        </div>
    </div>

    {{-- ============================== --}}
    {{-- KONTEN UTAMA                   --}}
    {{-- ============================== --}}
    <div class="max-w-4xl mx-auto px-4 py-6 space-y-5">

        {{-- Info banner (deskripsi kuis) --}}
        @if($deskripsi)
        <div class="bg-purple-50 border border-purple-100 rounded-2xl px-5 py-4 flex items-start gap-3">
            <svg class="w-4 h-4 text-purple-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xs text-purple-700 font-medium">{{ $deskripsi }}</p>
        </div>
        @endif

        {{-- ── NAVIGASI SOAL (grid dot) ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Navigasi Soal</p>
            <div class="flex flex-wrap gap-2">
                @foreach($soalList as $i => $soal)
                    <button
                        wire:click="goToSoal({{ $i }})"
                        x-on:click="soalAktif = {{ $i }}"
                        class="w-9 h-9 rounded-xl text-xs font-bold transition duration-150 border-2"
                        :class="
                            soalAktif === {{ $i }}
                                ? 'bg-purple-700 text-white border-purple-700 shadow-sm'
                                : (jawaban[{{ $soal['id'] }}] !== null && jawaban[{{ $soal['id'] }}] !== undefined
                                    ? 'bg-green-50 text-green-700 border-green-200'
                                    : 'bg-gray-50 text-gray-500 border-gray-200 hover:border-purple-300 hover:text-purple-700')
                        ">
                        {{ $i + 1 }}
                    </button>
                @endforeach
            </div>
            <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-purple-700 inline-block"></span> Aktif</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-green-100 border border-green-200 inline-block"></span> Terjawab</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-gray-100 border border-gray-200 inline-block"></span> Belum</span>
            </div>
        </div>

        {{-- ── KARTU SOAL ── --}}
        @foreach($soalList as $i => $soal)
        <div x-show="soalAktif === {{ $i }}" x-cloak class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- Nomor soal --}}
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                <span class="w-7 h-7 rounded-lg bg-purple-100 text-purple-700 text-xs font-black flex items-center justify-center flex-shrink-0">
                    {{ $i + 1 }}
                </span>
                <span class="text-xs text-gray-400 font-medium">Soal {{ $i + 1 }} dari {{ $totalSoal }}</span>
                @if($soal['bobot'] > 1)
                    <span class="ml-auto text-xs bg-yellow-50 text-yellow-600 font-semibold px-2 py-0.5 rounded-lg border border-yellow-100">
                        {{ $soal['bobot'] }} poin
                    </span>
                @endif
            </div>

            {{-- Teks soal --}}
            <div class="px-6 py-5">
                <p class="text-gray-900 font-semibold text-base leading-relaxed">{{ $soal['teks'] }}</p>
            </div>

            {{-- Opsi jawaban --}}
            <div class="px-6 pb-6 space-y-2.5">
                @foreach($soal['opsi'] as $opsi)
                    <button
                        wire:click="pilihJawaban({{ $soal['id'] }}, {{ $opsi['id'] }})"
                        x-on:click="pilihJawaban({{ $soal['id'] }}, {{ $opsi['id'] }})"
                        class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl border-2 text-left text-sm font-medium transition duration-150 group"
                        :class="jawaban[{{ $soal['id'] }}] === {{ $opsi['id'] }}
                            ? 'border-purple-600 bg-purple-50 text-purple-700'
                            : 'border-gray-200 bg-white text-gray-700 hover:border-purple-300 hover:bg-purple-50/50'">
                        <span
                            class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition duration-150"
                            :class="jawaban[{{ $soal['id'] }}] === {{ $opsi['id'] }}
                                ? 'border-purple-600 bg-purple-600'
                                : 'border-gray-300 group-hover:border-purple-400'">
                            <span
                                class="w-2 h-2 rounded-full bg-white"
                                x-show="jawaban[{{ $soal['id'] }}] === {{ $opsi['id'] }}">
                            </span>
                        </span>
                        <span>{{ $opsi['text'] }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Navigasi prev/next --}}
            <div class="flex items-center justify-between px-6 pb-5 gap-3">
                <button
                    @if($i === 0) disabled @endif
                    wire:click="goToSoal({{ $i - 1 }})"
                    x-on:click="soalAktif = {{ max(0, $i - 1) }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl border border-gray-200 text-gray-600 hover:border-purple-300 hover:text-purple-700 transition duration-150 disabled:opacity-30 disabled:cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Sebelumnya
                </button>

                @if($i === $totalSoal - 1)
                    {{-- Tombol kirim di soal terakhir --}}
                    <button
                        wire:click="kirimJawaban"
                        wire:confirm="Yakin ingin mengumpulkan jawaban? Jawaban yang belum dijawab akan dianggap kosong."
                        wire:loading.attr="disabled"
                        class="flex items-center gap-2 px-5 py-2 text-sm font-semibold rounded-xl bg-green-600 text-white hover:bg-green-700 transition duration-150 shadow-sm disabled:opacity-60">
                        <span wire:loading.remove wire:target="kirimJawaban" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Kirim Jawaban
                        </span>
                        <span wire:loading wire:target="kirimJawaban" class="flex items-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                @else
                    <button
                        wire:click="goToSoal({{ $i + 1 }})"
                        x-on:click="soalAktif = {{ $i + 1 }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-purple-700 text-white hover:bg-purple-800 transition duration-150 shadow-sm">
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
        @endforeach

        {{-- ── TOMBOL KIRIM GLOBAL (selalu tampil di bawah) ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center justify-between gap-4">
            <div class="text-sm text-gray-500">
                <span class="font-semibold text-gray-800" x-text="terjawab">0</span>
                dari <span class="font-semibold">{{ $totalSoal }}</span> soal terjawab
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden mt-1.5">
                    <div class="h-full bg-purple-600 rounded-full transition-all duration-300"
                        :style="`width: ${(terjawab / {{ $totalSoal }}) * 100}%`"></div>
                </div>
            </div>
            <button
                wire:click="kirimJawaban"
                wire:confirm="Yakin ingin mengumpulkan jawaban? Jawaban yang belum dijawab akan dianggap kosong."
                wire:loading.attr="disabled"
                class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-green-600 text-white hover:bg-green-700 transition duration-150 shadow-sm disabled:opacity-60">
                <span wire:loading.remove wire:target="kirimJawaban" class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Kumpulkan Jawaban
                </span>
                <span wire:loading wire:target="kirimJawaban" class="flex items-center gap-2">
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    Mengirim...
                </span>
            </button>
        </div>

    </div>


    {{-- ============================== --}}
    {{-- MODAL WAKTU HABIS              --}}
    {{-- Tidak bisa ditutup dengan X    --}}
    {{-- ============================== --}}
    @if($waktuHabis || $sudahKirim)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">

            {{-- Dekorasi atas --}}
            <div class="h-2 bg-gradient-to-r from-purple-600 to-purple-400"></div>

            <div class="px-6 py-8 text-center">

                @if($waktuHabis && !$sudahKirim)
                    {{-- Sedang memproses --}}
                    <div class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-500 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-1">Waktu Habis!</h3>
                    <p class="text-sm text-gray-500">Sedang mengumpulkan jawaban secara otomatis...</p>

                @elseif($sudahKirim)
                    {{-- Sudah selesai --}}
                    <div class="w-16 h-16 rounded-2xl bg-{{ $waktuHabis ? 'red' : 'green' }}-50 flex items-center justify-center mx-auto mb-4">
                        @if($waktuHabis)
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>

                    <h3 class="text-lg font-black text-gray-900 mb-1">
                        {{ $waktuHabis ? '⏰ Waktu Habis!' : '✅ Jawaban Terkirim!' }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">
                        {{ $waktuHabis
                            ? 'Waktu pengerjaan telah habis. Jawaban kamu sudah dikumpulkan secara otomatis.'
                            : 'Jawaban kamu berhasil dikumpulkan. Semangat!' }}
                    </p>

                    {{-- Tombol aksi --}}
                    <div class="flex flex-col gap-2">

                        {{-- Tombol Kembali ke Dashboard --}}
                        <button
                            wire:click="kembaliDashboard"
                            class="w-full flex items-center justify-center gap-2 py-3 bg-purple-700 text-white text-sm font-semibold rounded-xl hover:bg-purple-800 transition duration-200 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Dashboard
                        </button>

                        {{-- Tombol Coba Lagi —  disabled jika sudah habis percobaan --}}
                        @php
                            // Status 'selesai' sesuai enum peserta_kuis: ['belum_mulai','mengerjakan','selesai']
                            $percobaan = \App\Models\PesertaKuis::where('kuis_id', $peserta->kuis_id)
                                ->where('user_id', auth()->id())
                                ->where('status', 'selesai')
                                ->count();
                            $bisaCoba = $maksPercobaan <= 0 || $percobaan < $maksPercobaan;
                        @endphp

                        <button
                            @if(!$bisaCoba) disabled @endif
                            wire:click="kembaliDashboard"
                            class="w-full flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition duration-200 border
                                @if($bisaCoba)
                                    border-purple-200 text-purple-700 hover:bg-purple-50
                                @else
                                    border-gray-200 text-gray-400 cursor-not-allowed
                                @endif">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            @if($bisaCoba)
                                Coba Lagi ({{ $percobaan }}/{{ $maksPercobaan }})
                            @else
                                Batas Percobaan Tercapai ({{ $percobaan }}/{{ $maksPercobaan }})
                            @endif
                        </button>

                    </div>
                @endif

            </div>
        </div>
    </div>
    @endif


    {{-- ============================== --}}
    {{-- ALPINE.JS — Timer & State      --}}
    {{-- ============================== --}}
   <script>
    function kuisTimer(sisaDetikAwal, totalSoal) {
        return {
            sisaDetik: sisaDetikAwal,
            soalAktif: 0,
            jawaban: {},
            terjawab: 0,
            interval: null,

            init() {
                @foreach($soalList as $soal)
                this.jawaban[{{ $soal['id'] }}] = @json($jawaban[(string)$soal['id']] ?? null);
                @endforeach

                this.hitungTerjawab();

                // ✅ FIX: clear interval lama sebelum buat baru
                // mencegah dobel interval jika Alpine reinit karena Livewire re-render
                if (this.interval) clearInterval(this.interval);

                this.interval = setInterval(() => {
                    if (this.sisaDetik > 0) {
                        this.sisaDetik--;
                    } else {
                        clearInterval(this.interval);
                        this.interval = null;
                        @this.kirimOtomatis();
                    }
                }, 1000);
            },

            pilihJawaban(soalId, opsiId) {
                this.jawaban[soalId] = opsiId;
                this.hitungTerjawab();
            },

            hitungTerjawab() {
                this.terjawab = Object.values(this.jawaban)
                    .filter(v => v !== null && v !== undefined).length;
            },

            formatWaktu(detik) {
                if (detik <= 0) return '00:00';
                const j = Math.floor(detik / 3600);
                const m = Math.floor((detik % 3600) / 60);
                const s = detik % 60;
                if (j > 0) {
                    return String(j).padStart(2,'0') + ':'
                         + String(m).padStart(2,'0') + ':'
                         + String(s).padStart(2,'0');
                }
                return String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
            }
        }
    }
</script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

</div>