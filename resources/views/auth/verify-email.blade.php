<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 max-w-md w-full mx-4 overflow-hidden">

        {{-- Top accent --}}
        <div class="h-1.5 bg-purple-700 w-full"></div>

        <div class="p-10 text-center">
            {{-- Icon --}}
            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h1 class="text-2xl font-black text-gray-900 mb-2">Verifikasi Email ✉️</h1>
            <p class="text-sm text-gray-500 leading-relaxed mb-6">
                Terima kasih sudah mendaftar! Sebelum memulai, cek emailmu dan klik link verifikasi yang sudah kami kirimkan. Jika belum menerima, klik tombol di bawah.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 rounded-xl">
                    <p class="text-sm text-green-700 font-semibold">
                        ✓ Link verifikasi baru telah dikirim ke emailmu.
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <button type="submit"
                    class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 rounded-xl transition duration-200 shadow-sm">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-sm text-gray-500 hover:text-red-500 font-medium transition duration-200">
                    Keluar dari akun ini
                </button>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>