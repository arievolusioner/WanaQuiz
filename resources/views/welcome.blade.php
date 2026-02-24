<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WanaQuiz</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/logo-wq.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo-wq.png') }}?v=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --purple: #7c3aed;
            --purple-dark: #5b21b6;
            --purple-light: #ede9fe;
        }

        /* Dot grid background */
        .dot-grid {
            background-image: radial-gradient(circle, #c4b5fd 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Animated hero shapes */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-18px) rotate(3deg); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(14px) rotate(-2deg); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes count-up {
            from { opacity: 0; transform: scale(0.8); }
            to   { opacity: 1; transform: scale(1); }
        }

        .shape-1 { animation: float-slow 6s ease-in-out infinite; }
        .shape-2 { animation: float-reverse 5s ease-in-out infinite; animation-delay: 1s; }
        .shape-3 { animation: float-slow 7s ease-in-out infinite; animation-delay: 2s; }

        .hero-title   { animation: slide-up 0.7s ease-out both; }
        .hero-sub     { animation: slide-up 0.7s ease-out 0.15s both; }
        .hero-actions { animation: slide-up 0.7s ease-out 0.3s both; }
        .hero-stats   { animation: slide-up 0.7s ease-out 0.45s both; }
        .hero-visual  { animation: fade-in 1s ease-out 0.2s both; }

        .stat-card { animation: count-up 0.6s ease-out both; }
        .stat-card:nth-child(1) { animation-delay: 0.5s; }
        .stat-card:nth-child(2) { animation-delay: 0.65s; }
        .stat-card:nth-child(3) { animation-delay: 0.8s; }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Feature card hover */
        .feature-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(124, 58, 237, 0.15);
        }

        /* CTA button glow */
        .btn-primary {
            position: relative;
            overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 60%);
            pointer-events: none;
        }
        .btn-primary:hover {
            box-shadow: 0 8px 25px -4px rgba(124, 58, 237, 0.5);
            transform: translateY(-1px);
        }

        /* Step connector line */
        .step-line::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 2.5rem;
            height: calc(100% + 2rem);
            width: 1px;
            background: linear-gradient(to bottom, #c4b5fd, transparent);
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    @include('layouts.navigation')

    {{-- ══════════════════════════════════ --}}
    {{-- HERO                              --}}
    {{-- ══════════════════════════════════ --}}
    <section class="relative overflow-hidden bg-white min-h-screen flex items-center">

        {{-- Dot grid background --}}
        <div class="absolute inset-0 dot-grid opacity-40"></div>

        {{-- Gradient blobs --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-purple-100 rounded-full opacity-50 blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-50 rounded-full opacity-60 blur-2xl -translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-24 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left: copy --}}
                <div>
                    {{-- Eyebrow --}}
                    <div class="hero-title inline-flex items-center gap-2 bg-purple-50 border border-purple-200 text-purple-700 text-xs font-bold px-3.5 py-1.5 rounded-full mb-6 uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 bg-purple-600 rounded-full animate-pulse"></span>
                        Platform Kuis Online
                    </div>

                    <h1 class="hero-title text-5xl lg:text-6xl font-black text-gray-900 leading-[1.05] tracking-tight mb-6">
                        Belajar Lebih<br>
                        <span class="text-purple-700 relative">
                            Seru
                            {{-- Underline accent --}}
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 9C50 4 100 2 198 6" stroke="#c4b5fd" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </span>
                        &amp; Cerdas
                    </h1>

                    <p class="hero-sub text-lg text-gray-500 leading-relaxed mb-8 max-w-lg">
                        WanaQuiz memudahkan guru membuat kuis dan siswa belajar kapan saja.
                        Sistem penilaian otomatis, timer, dan analitik lengkap — semuanya gratis.
                    </p>

                    <div class="hero-actions flex flex-wrap gap-3 mb-12">
                        @auth
                            @if(auth()->user()->role === 'pengajar')
                                <a href="/pengajar"
                                    class="btn-primary inline-flex items-center gap-2 px-6 py-3.5 bg-purple-700 text-white font-bold rounded-2xl text-sm transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Buat Kuis Sekarang
                                </a>
                            @else
                                <a href="{{ route('siswa.dashboard') }}"
                                    class="btn-primary inline-flex items-center gap-2 px-6 py-3.5 bg-purple-700 text-white font-bold rounded-2xl text-sm transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Mulai Kuis
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}"
                                class="btn-primary inline-flex items-center gap-2 px-6 py-3.5 bg-purple-700 text-white font-bold rounded-2xl text-sm transition duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Daftar Gratis
                            </a>
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center gap-2 px-6 py-3.5 bg-white text-gray-700 font-bold rounded-2xl text-sm border border-gray-200 hover:border-purple-300 hover:text-purple-700 transition duration-200">
                                Masuk
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Right: visual illustration --}}
                <div class="hero-visual relative hidden lg:flex items-center justify-center">

                    {{-- Floating geometric shapes background --}}
                    <div class="shape-1 absolute top-8 right-8 w-16 h-16 bg-purple-100 rounded-2xl rotate-12 opacity-70"></div>
                    <div class="shape-2 absolute bottom-12 left-4 w-10 h-10 bg-yellow-200 rounded-xl rotate-6 opacity-80"></div>
                    <div class="shape-3 absolute top-1/2 right-0 w-8 h-8 bg-purple-200 rounded-lg -rotate-12"></div>

                    {{-- Main card visual --}}
                    <div class="relative bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 w-80">
                        {{-- Card header --}}
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900">Kuis Matematika</p>
                                <p class="text-xs text-gray-400">5 soal · 10 menit</p>
                            </div>
                            {{-- Timer pill --}}
                            <div class="ml-auto bg-purple-50 border border-purple-200 text-purple-700 text-xs font-black px-2.5 py-1 rounded-lg font-mono">
                                08:42
                            </div>
                        </div>

                        {{-- Fake question --}}
                        <div class="bg-gray-50 rounded-2xl p-4 mb-4">
                            <p class="text-xs font-semibold text-gray-700 mb-3">Soal 3 dari 5</p>
                            <p class="text-sm font-semibold text-gray-900 leading-snug mb-4">Berapakah hasil dari 12 × 8 − 16 ÷ 4?</p>
                            {{-- Options --}}
                            <div class="space-y-2">
                                <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl border-2 border-purple-600 bg-purple-50">
                                    <span class="w-4 h-4 rounded-full border-2 border-purple-600 bg-purple-600 flex items-center justify-center flex-shrink-0">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                    </span>
                                    <span class="text-xs font-semibold text-purple-700">92</span>
                                </div>
                                <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl border-2 border-gray-200 bg-white">
                                    <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex-shrink-0"></span>
                                    <span class="text-xs text-gray-600">88</span>
                                </div>
                                <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl border-2 border-gray-200 bg-white">
                                    <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex-shrink-0"></span>
                                    <span class="text-xs text-gray-600">100</span>
                                </div>
                            </div>
                        </div>

                        {{-- Progress --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-600 rounded-full" style="width: 60%"></div>
                            </div>
                            <span class="text-xs text-gray-400 font-medium flex-shrink-0">3 / 5</span>
                        </div>
                    </div>

                    {{-- Floating score badge --}}
                    <div class="shape-1 absolute -top-4 -left-4 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 flex items-center gap-2.5" style="animation-delay: 0.5s;">
                        <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Nilai kamu</p>
                            <p class="text-sm font-black text-green-600">95 / 100</p>
                        </div>
                    </div>

                    {{-- Floating streak badge --}}
                    <div class="shape-2 absolute -bottom-4 -right-2 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 flex items-center gap-2" style="animation-delay: 1.2s;">
                        <span class="text-lg">🔥</span>
                        <div>
                            <p class="text-xs text-gray-500">Streak</p>
                            <p class="text-sm font-black text-orange-500">7 hari</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-3">Kenapa WanaQuiz?</p>
                <h2 class="text-4xl font-black text-gray-900 mb-4">Semua yang Kamu Butuhkan</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Dirancang untuk guru yang ingin membuat kuis dengan mudah dan siswa yang ingin belajar lebih efektif.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                @php
                $features = [
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        'color' => 'purple',
                        'title' => 'Timer Otomatis',
                        'desc'  => 'Setiap kuis punya countdown timer. Saat waktu habis, jawaban langsung dikumpulkan otomatis — tidak perlu khawatir.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        'color' => 'green',
                        'title' => 'Penilaian Instan',
                        'desc'  => 'Nilai langsung dihitung begitu kuis selesai. Siswa bisa langsung lihat pembahasan soal mana yang benar dan salah.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>',
                        'color' => 'purple',
                        'title' => 'Kuis Fleksibel',
                        'desc'  => 'Atur batas percobaan, acak soal, acak opsi, dan jadwal buka-tutup kuis. Semua bisa dikustomisasi sesuai kebutuhan.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>',
                        'color' => 'yellow',
                        'title' => 'Kode Akses Unik',
                        'desc'  => 'Setiap kuis punya kode unik 6 karakter. Bagikan ke siswa — masuk langsung tanpa repot pendaftaran panjang.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                        'color' => 'blue',
                        'title' => 'Riwayat Lengkap',
                        'desc'  => 'Siswa bisa melihat semua kuis yang pernah dikerjakan beserta nilai, durasi, dan pembahasan jawaban per soal.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2v-7a2 2 0 00-2-2H8a2 2 0 00-2 2v7a2 2 0 002 2zM12 3v1m0 16v1M4.22 4.22l.707.707M18.364 18.364l.707.707M1 12h1m20 0h1M4.22 19.778l.707-.707M18.364 5.636l.707-.707"/>',
                        'color' => 'green',
                        'title' => 'Mudah Digunakan',
                        'desc'  => 'Antarmuka bersih dan intuitif. Guru bisa membuat kuis lengkap dalam hitungan menit tanpa perlu pelatihan teknis apapun.',
                    ],
                ];
                @endphp

                @foreach($features as $i => $f)
                @php
                    $colors = [
                        'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                        'green'  => ['bg' => 'bg-green-100',  'text' => 'text-green-600'],
                        'yellow' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                        'blue'   => ['bg' => 'bg-blue-100',   'text' => 'text-blue-600'],
                    ];
                    $c = $colors[$f['color']];
                @endphp
                <div class="feature-card reveal bg-white rounded-2xl border border-gray-100 p-6 shadow-sm" style="transition-delay: {{ $i * 0.08 }}s">
                    <div class="w-11 h-11 {{ $c['bg'] }} rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $f['icon'] !!}
                        </svg>
                    </div>
                    <h3 class="text-base font-black text-gray-900 mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-3">Cara Kerja</p>
                <h2 class="text-4xl font-black text-gray-900 mb-4">Mulai dalam 3 Langkah</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                {{-- Connector line (hidden on mobile) --}}
                <div class="hidden md:block absolute top-6 left-1/6 right-1/6 h-px bg-gradient-to-r from-transparent via-purple-200 to-transparent" style="left: 16.67%; right: 16.67%; top: 1.5rem;"></div>

                @php
                $steps = [
                    ['num' => '01', 'title' => 'Daftar Akun', 'desc' => 'Buat akun gratis sebagai siswa atau pengajar. Tidak perlu kartu kredit.', 'emoji' => '👤'],
                    ['num' => '02', 'title' => 'Dapatkan Kode', 'desc' => 'Pengajar membuat kuis dan membagikan kode akses ke siswa.', 'emoji' => '🔑'],
                    ['num' => '03', 'title' => 'Mulai Belajar', 'desc' => 'Masukkan kode, kerjakan kuis, dan lihat nilai serta pembahasannya.', 'emoji' => '🎯'],
                ];
                @endphp

                @foreach($steps as $i => $step)
                <div class="reveal text-center" style="transition-delay: {{ $i * 0.15 }}s">
                    <div class="relative inline-flex mb-5">
                        <div class="w-12 h-12 bg-purple-700 text-white rounded-2xl flex items-center justify-center font-black text-sm shadow-lg shadow-purple-200 mx-auto">
                            {{ $step['num'] }}
                        </div>
                    </div>
                    <div class="text-3xl mb-3">{{ $step['emoji'] }}</div>
                    <h3 class="text-base font-black text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-purple-700 py-24 relative overflow-hidden">

        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600 rounded-full opacity-50 translate-x-1/3 -translate-y-1/3 blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-800 rounded-full opacity-60 -translate-x-1/4 translate-y-1/4 blur-xl pointer-events-none"></div>

        {{-- Dot grid overlay --}}
        <div class="absolute inset-0 dot-grid opacity-10"></div>

        <div class="relative max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="reveal">
                <p class="text-xs font-bold text-purple-200 uppercase tracking-widest mb-4">Sudah siap?</p>
                <h2 class="text-4xl lg:text-5xl font-black text-white leading-tight mb-6">
                    Mulai Pengalaman<br>Belajar yang Berbeda
                </h2>
                <p class="text-lg text-purple-200 mb-10 max-w-2xl mx-auto">
                    Bergabung bersama ribuan pelajar dan pengajar yang sudah membuktikan efektivitas WanaQuiz.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        @if(auth()->user()->role === 'pengajar')
                            <a href="/pengajar"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Panel Pengajar
                            </a>
                        @else
                            <a href="{{ route('siswa.dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ke Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-black rounded-2xl text-base hover:bg-gray-50 transition duration-200 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Daftar Sekarang — Gratis
                        </a>
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-purple-800 text-white font-bold rounded-2xl text-base hover:bg-purple-900 transition duration-200 border border-purple-600">
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>
</html>