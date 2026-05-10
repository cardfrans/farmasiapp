<x-guest-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold tracking-tight text-slate-900">
                Lupa Password?
            </h2>
            <p class="mt-4 text-center text-sm text-slate-500 font-medium px-4">
                {{ __('Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang password yang baru.') }}
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
            <div class="bg-white py-10 px-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 rounded-[2.5rem]">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm font-medium text-slate-700"
                               placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-100 text-sm font-black text-white bg-blue-600 hover:bg-blue-700 transition-all">
                            {{ __('Kirim Tautan Reset') }}
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke halaman masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>