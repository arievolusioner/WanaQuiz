<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl w-full mx-4">

        {{-- Kiri: Branding --}}
        <div class="hidden md:flex md:w-5/12 bg-purple-700 flex-col items-center justify-center p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-purple-600 rounded-full -translate-y-16 translate-x-16 opacity-60"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-purple-800 rounded-full translate-y-10 -translate-x-10 opacity-60"></div>
            <div class="relative z-10 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white tracking-tight mb-2">WANAQUIZ</h2>
                <p class="text-purple-200 text-sm leading-relaxed">Buat akun dan mulai perjalanan belajar yang lebih interaktif</p>
            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full md:w-7/12 p-8 md:p-10 flex flex-col justify-center">
            <div class="mb-6">
                <h1 class="text-2xl font-black text-gray-900 mb-1">Buat Akun Baru</h1>
                <p class="text-sm text-gray-500">Daftar gratis dan langsung mulai</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5" id="register-form">
                @csrf

                {{-- Role Toggle --}}
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Daftar sebagai</p>
                    <input type="hidden" name="role" id="role-input" value="{{ old('role', 'siswa') }}">
                    <div class="flex rounded-xl border border-gray-200 overflow-hidden">
                        <button type="button"
                            id="btn-siswa"
                            onclick="setRole('siswa')"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-bold transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7zm0 0a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                            Siswa
                        </button>
                        <button type="button"
                            id="btn-pengajar"
                            onclick="setRole('pengajar')"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-bold transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            Pengajar
                        </button>
                    </div>
                </div>

                {{-- Nama --}}
                <div class="relative">
                    <x-text-input id="name"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer"
                        type="text" name="name" :value="old('name')" required autocomplete="name" placeholder=" " />
                    <x-input-label for="name"
                        class="absolute text-sm text-gray-500 duration-300 transform
                               -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                               peer-focus:px-2 peer-focus:text-purple-700
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                               peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                               peer-focus:-translate-y-4 left-1"
                        :value="__('Nama Lengkap')" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                </div>

                {{-- Email --}}
                <div class="relative">
                    <x-text-input id="email"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer"
                        type="email" name="email" :value="old('email')" required autocomplete="username" placeholder=" " />
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
                        type="password" name="password" required autocomplete="new-password" placeholder=" " />
                    <x-input-label for="password"
                        class="absolute text-sm text-gray-500 duration-300 transform
                               -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                               peer-focus:px-2 peer-focus:text-purple-700
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                               peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                               peer-focus:-translate-y-4 left-1"
                        :value="__('Kata Sandi')" />
                    <button type="button" onclick="togglePassword('password','eye-pass')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-purple-700 transition">
                        <svg id="eye-pass" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                </div>

                {{-- Konfirmasi Password --}}
                <div class="relative">
                    <x-text-input id="password_confirmation"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer pr-10"
                        type="password" name="password_confirmation" required autocomplete="new-password" placeholder=" " />
                    <x-input-label for="password_confirmation"
                        class="absolute text-sm text-gray-500 duration-300 transform
                               -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                               peer-focus:text-purple-700 peer-focus:px-2
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                               peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                               peer-focus:-translate-y-4 left-1"
                        :value="__('Konfirmasi Kata Sandi')" />
                    <button type="button" onclick="togglePassword('password_confirmation','eye-confirm')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-purple-700 transition">
                        <svg id="eye-confirm" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                </div>

                {{-- Submit --}}
                <button type="submit" id="register-btn"
                    class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 rounded-xl transition duration-200 flex items-center justify-center gap-2 shadow-sm">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-purple-700 font-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<script>
    // Role toggle
    const activeClass   = 'bg-purple-700 text-white';
    const inactiveClass = 'bg-white text-gray-500 hover:bg-gray-50';

    function setRole(role) {
        document.getElementById('role-input').value = role;
        ['siswa', 'pengajar'].forEach(r => {
            const btn = document.getElementById('btn-' + r);
            btn.className = btn.className.replace(activeClass, '').replace(inactiveClass, '').trim();
            btn.className += ' flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-bold transition duration-200 ' + (r === role ? activeClass : inactiveClass);
        });
    }

    // Init default
    document.addEventListener('DOMContentLoaded', () => {
        setRole('{{ old("role", "siswa") }}');

        // Spinner
        document.getElementById('register-form').addEventListener('submit', function () {
            const btn = document.getElementById('register-btn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>`;
        });
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