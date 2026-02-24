<x-app-layout>
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- ── HEADER ── --}}
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 right-24 w-24 h-24 bg-purple-100 rounded-full translate-y-10"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 bg-purple-700 text-white rounded-2xl flex items-center justify-center text-xl font-black flex-shrink-0 shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-purple-600 font-bold uppercase tracking-widest mb-0.5">Pengaturan Akun</p>
                    <h1 class="text-xl font-black text-gray-900">{{ Auth::user()->name }}</h1>
                    <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- ── UPDATE PROFIL ── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-gray-900">Informasi Profil</h2>
                    <p class="text-xs text-gray-400">Perbarui nama dan alamat email akunmu</p>
                </div>
            </div>

            <div class="p-6">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    {{-- Nama --}}
                    <div class="relative">
                        <x-text-input id="name" name="name" type="text"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder=" " />
                        <x-input-label for="name"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-purple-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Nama')" />
                        <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
                    </div>

                    {{-- Email --}}
                    <div class="relative">
                        <x-text-input id="email" name="email" type="email"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            :value="old('email', $user->email)" required autocomplete="username" placeholder=" " />
                        <x-input-label for="email"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-purple-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Email')" />
                        <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 flex items-center gap-2 px-3 py-2.5 bg-yellow-50 border border-yellow-200 rounded-xl">
                                <svg class="w-4 h-4 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <p class="text-xs text-yellow-700">
                                    Email belum diverifikasi.
                                    <button form="send-verification" class="font-semibold underline hover:text-yellow-900">
                                        Kirim ulang verifikasi.
                                    </button>
                                </p>
                            </div>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-xs text-green-600 font-semibold">Link verifikasi baru telah dikirim.</p>
                            @endif
                        @endif
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                            class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white font-bold text-sm rounded-xl transition duration-200 shadow-sm">
                            Simpan Perubahan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-xs text-green-600 font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Tersimpan!
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- ── UPDATE PASSWORD ── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-gray-900">Perbarui Kata Sandi</h2>
                    <p class="text-xs text-gray-400">Gunakan kata sandi yang kuat agar akunmu tetap aman</p>
                </div>
            </div>

            <div class="p-6">
                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    {{-- Current Password --}}
                    <div class="relative">
                        <x-text-input id="update_password_current_password" name="current_password" type="password"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-blue-600 peer"
                            autocomplete="current-password" placeholder=" " />
                        <x-input-label for="update_password_current_password"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-blue-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Kata Sandi Saat Ini')" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
                    </div>

                    {{-- New Password --}}
                    <div class="relative">
                        <x-text-input id="update_password_password" name="password" type="password"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-blue-600 peer"
                            autocomplete="new-password" placeholder=" " />
                        <x-input-label for="update_password_password"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-blue-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Kata Sandi Baru')" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="relative">
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-blue-600 peer"
                            autocomplete="new-password" placeholder=" " />
                        <x-input-label for="update_password_password_confirmation"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-blue-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Konfirmasi Kata Sandi')" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition duration-200 shadow-sm">
                            Simpan Kata Sandi
                        </button>
                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-xs text-green-600 font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Tersimpan!
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- ── HAPUS AKUN ── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-red-50 bg-red-50/40">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-gray-900">Hapus Akun</h2>
                    <p class="text-xs text-gray-400">Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-3 px-4 py-3.5 bg-red-50 border border-red-100 rounded-xl mb-5">
                    <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-xs text-red-700 leading-relaxed">
                        Setelah akun dihapus, semua data akan dihapus secara permanen. Pastikan kamu sudah menyimpan data yang dibutuhkan sebelum melanjutkan.
                    </p>
                </div>

                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition duration-200 shadow-sm">
                    Hapus Akun Saya
                </button>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h2 class="text-base font-black text-gray-900">Yakin ingin menghapus akun?</h2>
                        </div>

                        <p class="text-sm text-gray-500 mb-5 leading-relaxed">
                            Semua data akunmu akan dihapus secara permanen dan tidak bisa dipulihkan. Masukkan kata sandimu untuk konfirmasi.
                        </p>

                        <div class="relative mb-5">
                            <x-text-input id="del-password" name="password" type="password"
                                class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-xl
                                       border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                       focus:border-red-500 peer"
                                placeholder=" " />
                            <x-input-label for="del-password"
                                class="absolute text-sm text-gray-500 duration-300 transform
                                       -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                       peer-focus:px-2 peer-focus:text-red-600
                                       peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                       peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                       peer-focus:-translate-y-4 left-1"
                                value="Kata Sandi" />
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" x-on:click="$dispatch('close')"
                                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm rounded-xl transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition duration-200">
                                Ya, Hapus Akun
                            </button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>

    </div>
</div>
</x-app-layout>