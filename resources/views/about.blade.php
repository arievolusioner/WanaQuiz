<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami — WanaQuiz</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/logo-wq.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo-wq.png') }}?v=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dot-grid {
            background-image: radial-gradient(circle, #c4b5fd 1px, transparent 1px);
            background-size: 28px 28px;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-14px) rotate(2deg); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(10px); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .shape-1 { animation: float-slow 6s ease-in-out infinite; }
        .shape-2 { animation: float-reverse 5s ease-in-out infinite; animation-delay: 1s; }

        .hero-title { animation: slide-up 0.7s ease-out both; }
        .hero-sub   { animation: slide-up 0.7s ease-out 0.15s both; }

        .value-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -12px rgba(124, 58, 237, 0.12);
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    @include('layouts.navigation')

    {{-- ══════════════════════════════════ --}}
    {{-- HERO                              --}}
    {{-- ══════════════════════════════════ --}}
    <section class="relative overflow-hidden bg-white pt-20 pb-24">
        <div class="absolute inset-0 dot-grid opacity-40"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-purple-100 rounded-full opacity-50 blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-50 rounded-full opacity-60 blur-2xl -translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

        {{-- Floating shapes --}}
        <div class="shape-1 absolute top-16 right-16 w-14 h-14 bg-purple-100 rounded-2xl rotate-12 opacity-60 hidden lg:block"></div>
        <div class="shape-2 absolute bottom-16 left-12 w-10 h-10 bg-yellow-100 rounded-xl rotate-6 opacity-80 hidden lg:block"></div>

        <div class="relative max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="hero-title inline-flex items-center gap-2 bg-purple-50 border border-purple-200 text-purple-700 text-xs font-bold px-3.5 py-1.5 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-purple-600 rounded-full"></span>
                Tentang WanaQuiz
            </div>
            <h1 class="hero-title text-5xl lg:text-6xl font-black text-gray-900 leading-tight tracking-tight mb-6">
                Belajar Jadi<br>
                <span class="text-purple-700 relative">
                    Pengalaman
                    <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 12" fill="none">
                        <path d="M2 9C75 4 150 2 298 6" stroke="#c4b5fd" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </span>
                yang Berarti
            </h1>
            <p class="hero-sub text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
                WanaQuiz adalah platform kuis online yang dirancang untuk membuat proses belajar lebih interaktif, menyenangkan, dan efektif — untuk siswa maupun pengajar.
            </p>
        </div>
    </section>

    {{-- ══════════════════════════════════ --}}
    {{-- CERITA KAMI                       --}}
    {{-- ══════════════════════════════════ --}}
    <section class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                {{-- Teks --}}
                <div class="reveal">
                    <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-3">Cerita Kami</p>
                    <h2 class="text-3xl font-black text-gray-900 mb-6 leading-tight">
                        Dibuat untuk Menjawab Tantangan Pembelajaran Modern
                    </h2>
                    <div class="space-y-4 text-gray-500 text-base leading-relaxed">
                        <p>
                            <span class="font-semibold text-purple-700">WanaQuiz</span> lahir dari kesadaran bahwa pembelajaran yang baik memerlukan lebih dari sekadar buku teks. Setiap siswa belajar dengan cara yang berbeda, dan kami percaya teknologi bisa menjembatani perbedaan itu.
                        </p>
                        <p>
                            Dengan dukungan sistem otomatis, kuis dapat dinilai seketika dan siswa mendapat umpan balik langsung — membantu mereka memahami di mana kekuatan dan kelemahan mereka tanpa harus menunggu koreksi manual.
                        </p>
                        <p>
                            Kami percaya bahwa pembelajaran yang baik bukan hanya soal hasil akhir, tapi tentang bagaimana setiap prosesnya memotivasi dan menumbuhkan rasa ingin tahu. WanaQuiz hadir untuk membuat momen belajar lebih bermakna.
                        </p>
                    </div>
                </div>

                {{-- Visual card --}}
                <div class="reveal relative flex justify-center lg:justify-end" style="transition-delay: 0.15s">
                    <div class="relative">
                        {{-- Main card --}}
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 w-72">
                            <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-5">
                                <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Misi Kami</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Menghadirkan pengalaman belajar yang tidak hanya cerdas, tetapi juga menyenangkan dan relevan dengan dunia pendidikan masa kini.</p>
                        </div>

                        {{-- Floating badge 1 --}}
                        {{-- <div class="shape-1 absolute -top-5 -right-5 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Pengguna Aktif</p>
                                <p class="text-sm font-black text-gray-900">10.000+</p>
                            </div>
                        </div> --}}

                        {{-- Floating badge 2 --}}
                        {{-- <div class="shape-2 absolute -bottom-5 -left-5 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Kuis Dibuat</p>
                                <p class="text-sm font-black text-purple-700">50.000+</p>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════ --}}
    {{-- NILAI-NILAI                       --}}
    {{-- ══════════════════════════════════ --}}
    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-3">Nilai Kami</p>
                <h2 class="text-4xl font-black text-gray-900 mb-4">Yang Kami Pegang Teguh</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Setiap keputusan produk kami dilandasi oleh nilai-nilai ini.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                $values = [
                    [
                        'emoji' => '🎯',
                        'color' => 'purple',
                        'title' => 'Fokus pada Belajar',
                        'desc'  => 'Setiap fitur yang kami bangun diarahkan untuk satu tujuan: membuat belajar lebih mudah dan efektif.',
                    ],
                    [
                        'emoji' => '⚡',
                        'color' => 'yellow',
                        'title' => 'Cepat & Akurat',
                        'desc'  => 'Penilaian instan tanpa antrian. Hasil langsung tersedia begitu kuis selesai dikerjakan.',
                    ],
                    [
                        'emoji' => '🔓',
                        'color' => 'green',
                        'title' => 'Terbuka & Gratis',
                        'desc'  => 'Akses penuh tanpa biaya tersembunyi. Kami percaya pendidikan berkualitas harus bisa dijangkau semua orang.',
                    ],
                    [
                        'emoji' => '💡',
                        'color' => 'blue',
                        'title' => 'Terus Berkembang',
                        'desc'  => 'Kami selalu mendengar masukan pengguna dan terus memperbarui platform agar semakin baik.',
                    ],
                ];
                $colorMap = [
                    'purple' => 'bg-purple-50 border-purple-100',
                    'yellow' => 'bg-yellow-50 border-yellow-100',
                    'green'  => 'bg-green-50 border-green-100',
                    'blue'   => 'bg-blue-50 border-blue-100',
                ];
                @endphp

                @foreach($values as $i => $v)
                <div class="value-card reveal bg-white rounded-2xl border border-gray-100 shadow-sm p-6" style="transition-delay: {{ $i * 0.1 }}s">
                    <div class="w-12 h-12 {{ $colorMap[$v['color']] }} rounded-2xl border flex items-center justify-center text-2xl mb-4">
                        {{ $v['emoji'] }}
                    </div>
                    <h3 class="text-base font-black text-gray-900 mb-2">{{ $v['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════ --}}
    {{-- STATS BESAR                       --}}
    {{-- ══════════════════════════════════ --}}
    {{-- <section class="bg-gray-50 py-24">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="reveal text-center mb-14">
                <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-3">Dalam Angka</p>
                <h2 class="text-4xl font-black text-gray-900">WanaQuiz Sampai Saat Ini</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                $stats = [
                    ['angka' => '10K+',  'label' => 'Pengguna Aktif',    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                    ['angka' => '50K+',  'label' => 'Kuis Dibuat',       'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                    ['angka' => '200K+', 'label' => 'Kuis Dikerjakan',   'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664zM21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                    ['angka' => '100%',  'label' => 'Gratis Selamanya',  'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                ];
                @endphp

                @foreach($stats as $i => $s)
                <div class="reveal bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center" style="transition-delay: {{ $i * 0.1 }}s">
                    <div class="w-12 h-12 {{ $s['bg'] }} rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 {{ $s['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}" />
                        </svg>
                    </div>
                    <p class="text-3xl font-black {{ $s['text'] }} mb-1">{{ $s['angka'] }}</p>
                    <p class="text-xs text-gray-400 font-medium">{{ $s['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    {{-- ══════════════════════════════════ --}}
    {{-- CTA                               --}}
    {{-- ══════════════════════════════════ --}}
    <section class="bg-purple-700 py-20 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600 rounded-full opacity-50 translate-x-1/3 -translate-y-1/3 blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-800 rounded-full opacity-60 -translate-x-1/4 translate-y-1/4 blur-xl pointer-events-none"></div>
        <div class="absolute inset-0 dot-grid opacity-10"></div>

        <div class="relative max-w-3xl mx-auto px-6 lg:px-8 text-center reveal">
            <h2 class="text-4xl font-black text-white mb-4">Bergabung Sekarang</h2>
            <p class="text-purple-200 text-lg mb-10">Jadilah bagian dari komunitas pelajar dan pengajar yang sudah membuktikan WanaQuiz.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    @if(auth()->user()->role === 'pengajar')
                        <a href="/pengajar"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                            Panel Pengajar
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                            Ke Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                        Daftar Gratis
                    </a>
                    <a href="/"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-purple-800 text-white font-bold rounded-2xl text-base hover:bg-purple-900 transition duration-200 border border-purple-600">
                        Kembali ke Beranda
                    </a>
                @endauth
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>
</html>