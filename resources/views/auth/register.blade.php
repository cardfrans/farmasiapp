<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - FarmasiApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-white text-slate-900 antialiased selection:bg-blue-100 selection:text-blue-900">

    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 py-12 relative overflow-y-auto">
            
            <a href="/" class="absolute top-8 left-8 sm:left-12 flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <div class="w-full max-w-md mx-auto lg:mx-0 mt-12 lg:mt-0">
                <div class="mb-10">
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-2">Buat Akun</h2>
                    <p class="text-slate-500 font-medium text-lg">Mulai perjalanan sehat Anda bersama kami.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800"
                               placeholder="Contoh: Budi Santoso">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800"
                               placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800"
                               placeholder="Minimal 8 karakter">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base font-medium text-slate-800"
                               placeholder="Ulangi password di atas">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-2xl shadow-xl shadow-blue-600/20 text-base font-black text-white bg-blue-600 hover:bg-blue-700 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transition-all active:scale-[0.98]">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center lg:text-left">
                    <p class="text-base text-slate-500 font-medium">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-black ml-1 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-blue-600 after:scale-x-0 hover:after:scale-x-100 after:origin-left after:transition-transform">Masuk di sini</a>
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
                    <h3 class="text-4xl font-black mb-6 leading-tight">Jaminan Obat Asli 100%.</h3>
                    <p class="text-slate-300 font-medium text-lg leading-relaxed mb-8">
                        Kami bekerja sama dengan distributor resmi bersertifikat BPOM untuk memastikan setiap produk yang Anda terima aman dan terpercaya.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-300">Sertifikasi Keamanan Data & Privasi Pasien</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>