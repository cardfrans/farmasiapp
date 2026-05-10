<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FarmasiApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-blue-100 selection:text-blue-900">

@include('admin.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative bg-slate-50/50">
        <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200/50 px-8 flex items-center justify-between flex-shrink-0 z-30">
            <div>
                <h1 class="text-xl font-black text-slate-900">Overview Dashboard</h1>
                <p class="text-xs font-semibold text-slate-400">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </header>

        <div class="flex-1 overflow-x-hidden overflow-y-auto p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-8">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 flex items-center gap-5 relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 z-10 relative">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="z-10 relative">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 flex items-center gap-5 relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 z-10 relative">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="z-10 relative">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Pesanan Menunggu</p>
                            <h3 class="text-2xl font-black text-slate-900">{{ $pesananBaru }}</h3>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 flex items-center gap-5 relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
                        <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center shrink-0 z-10 relative">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <div class="z-10 relative">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Katalog Obat</p>
                            <h3 class="text-2xl font-black text-slate-900">{{ number_format($totalObat, 0, ',', '.') }}</h3>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-red-100 flex items-center gap-5 relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
                        <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center shrink-0 z-10 relative">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="z-10 relative">
                            <p class="text-[11px] font-black text-red-400 uppercase tracking-widest mb-1">Peringatan Stok</p>
                            <h3 class="text-2xl font-black text-red-600">{{ $stokMenipisCount }} Obat</h3>
                            <p class="text-xs font-bold text-red-400 mt-1">Hampir habis (< 10 pcs)</p>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-xl font-black text-slate-900">Pesanan Masuk Terbaru</h2>
                            <a href="/admin/pesanan" class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline">Lihat Semua</a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 text-[11px] uppercase tracking-widest text-slate-400 font-black">
                                        <th class="pb-4">ID Order</th>
                                        <th class="pb-4">User ID</th>
                                        <th class="pb-4">Total Tagihan</th>
                                        <th class="pb-4">Status</th>
                                        <th class="pb-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($pesananTerbaru as $trx)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="py-4 font-bold text-slate-900 text-sm">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td class="py-4 font-semibold text-slate-600 text-sm">User ID: {{ $trx->user_name }}</td>
                                        <td class="py-4 font-black text-slate-900 text-sm">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                        <td class="py-4">
                                            @php
                                                $badgeColor = 'bg-slate-100 text-slate-600 border-slate-200';
                                                if($trx->status == 'Lunas') $badgeColor = 'bg-blue-50 text-blue-600 border-blue-100';
                                                if($trx->status == 'Diproses') $badgeColor = 'bg-orange-50 text-orange-600 border-orange-100';
                                                if($trx->status == 'Selesai') $badgeColor = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                                            @endphp
                                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border {{ $badgeColor }}">
                                                {{ $trx->status ?? 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="py-4 text-right">
                                            <a href="/admin/pesanan" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Proses</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center font-bold text-slate-400">Belum ada pesanan masuk.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8 flex flex-col">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-xl font-black text-slate-900">Perhatian Stok</h2>
                            <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </div>

                        <div class="space-y-4 flex-1">
                            @forelse($stokMenipis as $obat)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-red-50/50 border border-red-100/50">
                                <div>
                                    <p class="font-bold text-slate-900 text-sm mb-0.5 truncate max-w-[120px]">{{ $obat->nama_obat }}</p>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID-{{ str_pad($obat->medicine_id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="font-black text-red-600 text-lg block leading-none">{{ $obat->stok }}</span>
                                    <span class="text-[10px] font-bold text-red-400 uppercase tracking-widest">{{ $obat->satuan ?? 'Sisa' }}</span>
                                </div>
                            </div>
                            @empty
                            <div class="p-8 text-center">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="font-bold text-slate-500 text-sm">Semua stok obat aman!</p>
                            </div>
                            @endforelse
                        </div>

                        <a href="/admin/obat" class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-blue-600 text-white rounded-xl font-bold text-sm transition-colors text-center block shadow-md">
                            Kelola Stok Obat
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </main>
</body>
</html>