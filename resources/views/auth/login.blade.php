<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl w-full mx-4">

        {{-- Kiri: Branding --}}
        <div class="hidden md:flex md:w-5/12 bg-purple-700 flex-col items-center justify-center p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-purple-600 rounded-full -translate-y-16 translate-x-16 opacity-60"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-purple-800 rounded-full translate-y-10 -translate-x-10 opacity-60"></div>
            <div class="relative z-10 text-center">
                <h2 class="text-5xl font-black text-white tracking-tight mb-2">WANAQUIZ</h2>
                <p class="text-purple-200 text-sm leading-relaxed">Platform kuis online untuk pengalaman belajar yang lebih seru</p>
            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full md:w-7/12 p-8 md:p-10 flex flex-col justify-center">
            <div class="mb-7">
                <h1 class="text-2xl font-black text-gray-900 mb-1">Selamat datang!👋</h1>
                <p class="text-sm text-gray-500">Masuk untuk melanjutkan ke WanaQuiz</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5" id="login-form">
                @csrf

                {{-- Email --}}
                <div class="relative">
                    <x-text-input id="email"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer"
                        type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder=" " />
                    <x-input-label for="email"
                        class="absolute text-sm text-gray-500 duration-300 transform
                               -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                               peer-focus:px-2 peer-focus:text-purple-700
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                               peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                               peer-focus:-translate-y-4 left-1"
                        :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                </div>

                {{-- Password --}}
                <div class="relative">
                    <x-text-input id="password"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer pr-10"
                        type="password" name="password" required autocomplete="current-password" placeholder=" " />
                    <x-input-label for="password"
                        class="absolute text-sm text-gray-500 duration-300 transform
                               -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                               peer-focus:px-2 peer-focus:text-purple-700
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                               peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                               peer-focus:-translate-y-4 left-1"
                        :value="__('Kata Sandi')" />
                    <button type="button" onclick="togglePassword('password','eye-login')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-purple-700 transition">
                        <svg id="eye-login" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                </div>

                {{-- Remember + Lupa Sandi --}}
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-purple-700 shadow-sm focus:ring-purple-500"
                            name="remember">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-purple-700 font-semibold hover:underline">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" id="login-btn"
                    class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 rounded-xl transition duration-200 flex items-center justify-center gap-2 shadow-sm">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-purple-700 font-bold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>

<script>
    // Spinner
    document.getElementById('login-form').addEventListener('submit', function () {
        const btn = document.getElementById('login-btn');
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>`;
    });

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a9.956 9.956 0 012.042-3.368M6.223 6.223A9.956 9.956 0 0112 5c4.478 0 8.269 2.944 9.543 7a9.964 9.964 0 01-4.132 5.411M15 12a3 3 0 00-3-3" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
        }
    }
</script>
</x-guest-layout>