<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-blue-100 selection:text-blue-900">

    @include('admin.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative bg-slate-50/50">
        
        <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200/50 px-8 flex items-center justify-between flex-shrink-0 z-30">
            <div>
                <h1 class="text-xl font-black text-slate-900">Manajemen Pesanan</h1>
                <p class="text-xs font-semibold text-slate-400">Proses transaksi dan pengiriman pelanggan</p>
            </div>
        </header>

        <div class="flex-1 overflow-x-hidden overflow-y-auto p-6 lg:p-8 relative">
            <div class="max-w-7xl mx-auto">
                
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-[2.5rem] shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 pb-4">
                    <div class="w-full">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest text-slate-400 font-black">
                                    <th class="px-8 py-5 rounded-tl-[2.5rem]">No. Pesanan</th>
                                    <th class="px-8 py-5">Data Pelanggan</th>
                                    <th class="px-8 py-5">Tanggal</th>
                                    <th class="px-8 py-5">Total Bayar</th>
                                    <th class="px-8 py-5 text-right rounded-tr-[2.5rem]">Ubah Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($transactions as $trx)
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-8 py-5">
                                        <span class="font-black text-slate-900 text-sm">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-700 text-sm">User ID: {{ $trx->user_id }}</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Pembeli Terdaftar</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-slate-500 font-semibold text-sm">
                                            {{ $trx->created_at->format('d M Y') }}
                                            <span class="block text-[10px] text-slate-400 uppercase tracking-tighter">{{ $trx->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="font-black text-slate-900 text-sm">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</div>
                                    </td>
                                    
                                    <td class="px-8 py-5 flex justify-end"
                                        x-data="{ 
                                            open: false, 
                                            selected: '{{ $trx->status ?? 'Pending' }}'
                                        }">
                                        
                                        <form action="/admin/pesanan/{{ $trx->id }}" method="POST" class="m-0 w-full" x-ref="statusForm">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="hidden" name="status" :value="selected">

                                            <div class="relative inline-block w-full min-w-[150px] text-left">
                                                
                                                <button @click="open = !open" 
                                                        type="button" 
                                                        class="w-full px-4 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest border flex justify-between items-center transition-all shadow-sm focus:ring-4 focus:ring-blue-500/10"
                                                        :class="{
                                                            'bg-orange-50 text-orange-600 border-orange-100': selected === 'Pending',
                                                            'bg-blue-50 text-blue-600 border-blue-100': selected === 'Diproses',
                                                            'bg-purple-50 text-purple-600 border-purple-100': selected === 'Dikirim',
                                                            'bg-emerald-50 text-emerald-600 border-emerald-100': selected === 'Selesai',
                                                            'bg-slate-50 text-slate-600 border-slate-200': !['Pending', 'Diproses', 'Dikirim', 'Selesai'].includes(selected)
                                                        }">
                                                    <span x-text="selected"></span>
                                                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                                </button>

                                                <div x-show="open" @click.away="open = false" x-cloak x-transition 
                                                     class="absolute top-full mt-2 w-full bg-white border border-slate-100 rounded-xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] py-2 right-0 z-50">
                                                    
                                                    <template x-for="item in ['Pending', 'Diproses', 'Dikirim', 'Selesai']">
                                                        <button @click="
                                                                    selected = item; 
                                                                    open = false; 
                                                                    $nextTick(() => { $refs.statusForm.submit() })
                                                                " 
                                                                type="button" 
                                                                class="w-full text-left px-4 py-2.5 text-[10px] font-black uppercase tracking-wider text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" 
                                                                x-text="item"></button>
                                                    </template>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            <p class="text-slate-400 font-bold">Belum ada pesanan yang masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>