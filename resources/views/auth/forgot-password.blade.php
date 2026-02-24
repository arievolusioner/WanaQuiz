<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl w-full mx-4">

        {{-- Kiri: Branding --}}
        <div class="hidden md:flex md:w-5/12 bg-purple-700 flex-col items-center justify-center p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-purple-600 rounded-full -translate-y-16 translate-x-16 opacity-60"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-purple-800 rounded-full translate-y-10 -translate-x-10 opacity-60"></div>
            <div class="relative z-10 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white tracking-tight mb-2">WANAQUIZ</h2>
                <p class="text-purple-200 text-sm leading-relaxed">Kami akan bantu kamu mengatur ulang kata sandi</p>
            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full md:w-7/12 p-8 md:p-10 flex flex-col justify-center">
            <div class="mb-7">
                <h1 class="text-2xl font-black text-gray-900 mb-1">Lupa Kata Sandi?</h1>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Masukkan email akunmu. Kami akan kirimkan link untuk mengatur ulang kata sandi.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="relative">
                    <x-text-input id="email"
                        class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                               border border-gray-300 appearance-none focus:outline-none focus:ring-0
                               focus:border-purple-600 peer"
                        type="email" name="email" :value="old('email')" required autofocus placeholder=" " />
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

                <button type="submit"
                    class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 rounded-xl transition duration-200 shadow-sm">
                    Kirim Link Reset
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Ingat kata sandi?
                <a href="{{ route('login') }}" class="text-purple-700 font-bold hover:underline">Kembali ke login</a>
            </p>
        </div>
    </div>
</div>
</x-guest-layout>