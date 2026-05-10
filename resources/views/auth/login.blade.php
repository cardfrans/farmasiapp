<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - FarmasiApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-white text-slate-900 antialiased selection:bg-blue-100 selection:text-blue-900">

    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 relative">
            
            <a href="/" class="absolute top-8 left-8 sm:left-12 flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <div class="w-full max-w-md mx-auto lg:mx-0 mt-12 lg:mt-0">
                <div class="mb-10">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 font-medium text-lg">Masuk ke akun Anda untuk melanjutkan.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                               class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800 placeholder-slate-400"
                               placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800 placeholder-slate-400"
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div class="flex items-center pt-2">
                        <input id="remember_me" type="checkbox" name="remember" 
                               class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded-lg focus:ring-blue-500 focus:ring-2 transition-all cursor-pointer">
                        <label for="remember_me" class="ml-3 block text-sm font-bold text-slate-600 cursor-pointer">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-2xl shadow-xl shadow-blue-600/20 text-base font-black text-white bg-blue-600 hover:bg-blue-700 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transition-all active:scale-[0.98]">
                            Masuk Ke Akun
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center lg:text-left">
                    <p class="text-base text-slate-500 font-medium">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-black ml-1 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-blue-600 after:scale-x-0 hover:after:scale-x-100 after:origin-left after:transition-transform">Daftar Sekarang</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 relative items-center justify-center p-12 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-[40rem] h-[40rem] bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 transform -translate-x-1/2 translate-y-1/2"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
            </div>

            <div class="relative z-10 w-full max-w-lg text-white">
                <div class="p-10 bg-white/10 backdrop-blur-2xl rounded-[3rem] border border-white/10 shadow-2xl">
                    <div class="flex gap-2 mb-8">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>
                    <h3 class="text-4xl font-black mb-6 leading-tight">Masa depan layanan farmasi ada di sini.</h3>
                    <p class="text-slate-300 font-medium text-lg leading-relaxed mb-8">
                        FarmasiApp memberikan kemudahan ekstra dalam mengelola kesehatan Anda. Pesan obat, cek riwayat resep, hingga konsultasi apoteker—semua dari satu tempat.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <div class="w-10 h-10 rounded-full bg-blue-500 border-2 border-slate-800"></div>
                            <div class="w-10 h-10 rounded-full bg-emerald-500 border-2 border-slate-800"></div>
                            <div class="w-10 h-10 rounded-full bg-purple-500 border-2 border-slate-800"></div>
                        </div>
                        <p class="text-sm font-bold text-slate-300">Bergabung dengan 10.000+ pengguna lainnya.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>