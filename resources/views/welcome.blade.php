<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmasiApp - Solusi Kesehatan Digital Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden">

    <nav class="glass-nav fixed w-full z-50 border-b border-slate-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-slate-900">FarmasiApp</span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-semibold text-sm text-slate-500">
                <a href="#beranda" class="hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#fitur" class="hover:text-blue-600 transition-colors">Keunggulan</a>
                <a href="#cara-kerja" class="hover:text-blue-600 transition-colors">Cara Kerja</a>
                <a href="/katalog" class="hover:text-blue-600 transition-colors">Katalog Obat</a>
            </div>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-md">Dashboard Admin</a>
                        @else
                            <a href="{{ url('/katalog') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-md">Lanjut Belanja</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 text-slate-600 font-bold text-sm hover:text-blue-600 transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-blue-600 transition-all shadow-md">Daftar Sekarang</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section id="beranda" class="pt-32 pb-20 sm:pt-40 sm:pb-28 px-6 sm:px-10 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-7xl mx-auto relative z-10 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="flex-1 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Apotek Digital Terpercaya
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-6 tracking-tight">
                    Kesehatan Anda, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Kini Dalam Genggaman.</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-500 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Pesan obat resep, vitamin, dan kebutuhan kesehatan lainnya dengan mudah. Pengiriman instan, aman, dan langsung sampai ke depan pintu rumah Anda.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="/katalog" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold text-base hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 hover:-translate-y-1 flex items-center justify-center gap-2">
                        Jelajahi Katalog Obat
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#cara-kerja" class="w-full sm:w-auto px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold text-base hover:border-slate-300 hover:bg-slate-50 transition-all flex items-center justify-center">
                        Lihat Cara Kerja
                    </a>
                </div>
            </div>
            
            <div class="flex-1 w-full max-w-lg lg:max-w-none">
                <div class="bg-white p-6 sm:p-8 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 relative">
                    <div class="absolute -top-6 -left-6 bg-emerald-500 text-white p-4 rounded-2xl shadow-lg transform -rotate-6 z-20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    
                    <div class="aspect-[4/3] bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-center overflow-hidden relative group">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Dokter FarmasiApp" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/10 to-transparent"></div>
                        
                        <div class="absolute bottom-6 left-6 right-6 text-white z-10 text-left">
                            <h3 class="text-xl font-bold shadow-sm">Layanan Terpercaya</h3>
                            <p class="text-sm text-slate-200 mt-1 font-medium">Apoteker & Dokter Resmi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-20 sm:py-32 bg-white px-6 sm:px-10 border-y border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 sm:mb-24">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mb-4">Mengapa Memilih FarmasiApp?</h2>
                <p class="text-slate-500 max-w-2xl mx-auto font-medium text-lg">Kami mendesain ulang pengalaman pergi ke apotek menjadi lebih cepat, aman, dan 100% transparan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-12">
                <div class="p-8 rounded-[2.5rem] bg-slate-50 hover:bg-blue-50 hover:-translate-y-2 transition-all duration-300 group border border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Akses Cepat 24/7</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Sakit tidak mengenal waktu. Katalog kami terbuka 24 jam sehari untuk memenuhi kebutuhan darurat Anda.</p>
                </div>

                <div class="p-8 rounded-[2.5rem] bg-slate-50 hover:bg-emerald-50 hover:-translate-y-2 transition-all duration-300 group border border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4L19 7m-9 5l-2-2m-4 2l2-2m5-5v18"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">100% Produk Original</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Semua obat disuplai langsung dari distributor resmi dan diawasi ketat oleh apoteker berlisensi.</p>
                </div>

                <div class="p-8 rounded-[2.5rem] bg-slate-50 hover:bg-purple-50 hover:-translate-y-2 transition-all duration-300 group border border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pengiriman Instan</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Pesan sekarang, sampai hari ini juga. Tidak perlu repot antre, biarkan kami yang mengantarkannya.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-20 sm:py-32 px-6 sm:px-10">
        <div class="max-w-7xl mx-auto">
            <div class="bg-slate-900 rounded-[3rem] p-10 sm:p-20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 rounded-full blur-[100px] opacity-50"></div>
                
                <div class="relative z-10 text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-black text-white mb-4">Cara Kerja yang Sederhana</h2>
                    <p class="text-slate-400 font-medium text-lg max-w-2xl mx-auto">3 langkah mudah untuk mendapatkan obat yang Anda butuhkan tanpa perlu meninggalkan rumah.</p>
                </div>

                <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                    <div class="relative">
                        <div class="w-20 h-20 mx-auto bg-slate-800 border border-slate-700 rounded-full flex items-center justify-center text-2xl font-black text-white mb-6 z-10 relative">1</div>
                        <h3 class="text-xl font-bold text-white mb-2">Pilih Obat</h3>
                        <p class="text-slate-400">Cari obat di katalog kami atau unggah resep dokter Anda.</p>
                    </div>
                    <div class="relative">
                        <div class="hidden md:block absolute top-10 -left-[50%] w-full h-0.5 bg-slate-700 -z-0"></div>
                        <div class="w-20 h-20 mx-auto bg-blue-600 border border-blue-500 rounded-full flex items-center justify-center text-2xl font-black text-white mb-6 z-10 relative shadow-lg shadow-blue-600/30">2</div>
                        <h3 class="text-xl font-bold text-white mb-2">Selesaikan Pembayaran</h3>
                        <p class="text-slate-400">Checkout dengan aman menggunakan metode pembayaran pilihan.</p>
                    </div>
                    <div class="relative">
                        <div class="hidden md:block absolute top-10 -left-[50%] w-full h-0.5 bg-slate-700 -z-0"></div>
                        <div class="w-20 h-20 mx-auto bg-slate-800 border border-slate-700 rounded-full flex items-center justify-center text-2xl font-black text-white mb-6 z-10 relative">3</div>
                        <h3 class="text-xl font-bold text-white mb-2">Tunggu di Rumah</h3>
                        <p class="text-slate-400">Kurir kami akan mengantarkan pesanan langsung ke pintu Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-slate-200 pt-20 pb-10 px-6 sm:px-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="md:col-span-2">
                <a href="#" class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">FarmasiApp</span>
                </a>
                <p class="text-slate-500 max-w-sm font-medium leading-relaxed">
                    Sistem informasi apotek modern untuk memudahkan Anda mendapatkan akses layanan kesehatan terbaik di mana saja.
                </p>
            </div>
            
            <div>
                <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-wider text-sm">Layanan Kami</h4>
                <ul class="space-y-4">
                    <li><a href="/katalog" class="text-slate-500 hover:text-blue-600 font-medium transition-colors">Beli Obat</a></li>
                    <li><a href="/login" class="text-slate-500 hover:text-blue-600 font-medium transition-colors">Upload Resep Dokter</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-blue-600 font-medium transition-colors">Konsultasi Apoteker</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-slate-500 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        cs@farmasiapp.com
                    </li>
                    <li class="flex items-center gap-3 text-slate-500 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        0800-1234-5678
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm font-medium text-slate-400">
                &copy; {{ date('Y') }} FarmasiApp. Hak Cipta Dilindungi Undang-Undang.
            </p>
            <div class="flex items-center gap-6 text-sm font-medium text-slate-400">
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>
</html>