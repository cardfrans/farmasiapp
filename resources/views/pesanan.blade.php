<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - FarmasiApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-100 selection:text-blue-900">
    
    @include('navbar')

    <main class="md:pl-64 min-h-screen flex flex-col transition-all duration-300">
        
        <header class="glass-effect sticky top-0 z-40 border-b border-slate-200/60 px-6 sm:px-10 py-5 sm:py-6">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Riwayat Pesanan</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Pantau status pengiriman dan riwayat belanja Anda.</p>
                </div>
            </div>
        </header>

        <div class="p-6 sm:p-10 flex-1 w-full max-w-4xl mx-auto">
            
            <div class="w-full">
                @forelse($transactions as $pesanan)
                    <div style="margin-bottom: 32px;" class="bg-white rounded-[2rem] p-6 sm:p-8 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 hover:shadow-[0_10px_30px_-10px_rgba(0,0,0,0.08)] transition-all duration-300 group">
                        
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-6 pb-6 border-b border-slate-100 border-dashed">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-lg font-black text-slate-900">#ORD-{{ str_pad($pesanan->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-xs font-bold text-slate-300">•</span>
                                    <span class="text-sm font-semibold text-slate-500">
                                        {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-500 flex items-start gap-2 max-w-md leading-relaxed">
                                    <svg class="w-5 h-5 shrink-0 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $pesanan->alamat_pengiriman ?? 'Alamat tidak tersedia' }}
                                </p>
                            </div>

                            @php
                                $statusRaw = $pesanan->status ?? 'Pending';
                                $status = strtolower($statusRaw);
                                $badgeColor = 'bg-slate-50 text-slate-600 border-slate-200'; // Default abu-abu
                                
                                if($status == 'pending') {
                                    $badgeColor = 'bg-orange-50 text-orange-600 border-orange-100';
                                } elseif(in_array($status, ['lunas', 'diproses'])) {
                                    $badgeColor = 'bg-blue-50 text-blue-600 border-blue-100';
                                } elseif($status == 'dikirim') {
                                    $badgeColor = 'bg-purple-50 text-purple-600 border-purple-100';
                                } elseif($status == 'selesai') {
                                    $badgeColor = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                                } elseif(in_array($status, ['batal', 'dibatalkan'])) {
                                    $badgeColor = 'bg-red-50 text-red-600 border-red-100';
                                }
                            @endphp
                            
                            <div class="px-4 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest shadow-sm border w-fit {{ $badgeColor }}">
                                {{ $statusRaw }}
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="w-full sm:w-auto text-left">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Total Tagihan</span>
                                <div class="text-2xl font-black text-slate-900">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-3">

                                @if($status == 'pending')
                                    <a href="/bayar/{{ $pesanan->id }}" class="w-full sm:w-auto px-6 py-3 rounded-xl font-bold text-sm bg-slate-900 text-white hover:bg-blue-600 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 text-center flex items-center justify-center gap-2">
                                        Bayar Sekarang
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>

                                @elseif(in_array($status, ['lunas', 'diproses']))
                                    <div class="w-full sm:w-auto px-6 py-3 rounded-xl font-bold text-sm bg-blue-50 border border-blue-100 text-blue-600 text-center flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Sedang Disiapkan
                                    </div>

                                @elseif($status == 'dikirim')
                                    <form action="/pesanan/selesai/{{ $pesanan->id }}" method="POST" class="w-full sm:w-auto m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="w-full px-6 py-3 rounded-xl font-bold text-sm bg-emerald-500 text-white hover:bg-emerald-600 transition-all shadow-md text-center">
                                            Pesanan Diterima
                                        </button>
                                    </form>
                                
                                @elseif($status == 'selesai')
                                    <div class="w-full sm:w-auto px-6 py-3 rounded-xl font-bold text-sm bg-emerald-50 border border-emerald-100 text-emerald-600 text-center flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="py-24 flex flex-col items-center justify-center text-center bg-white rounded-[3rem] border border-slate-100 border-dashed shadow-sm">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 border border-slate-100 shadow-inner">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">Belum Ada Riwayat Pesanan</h3>
                        <p class="text-slate-400 text-sm max-w-sm mb-8 leading-relaxed font-medium">Anda belum melakukan pemesanan apa pun. Jelajahi katalog kami untuk menemukan produk kesehatan yang Anda butuhkan.</p>
                        <a href="/katalog" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-200 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                            Mulai Belanja Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </main>

</body>
</html>