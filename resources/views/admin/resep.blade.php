<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Resep - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-blue-100 selection:text-blue-900">

    @include('admin.sidebar')

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-xl font-black text-slate-900 tracking-tight">Kelola Resep Pasien</h1>
        </header>

        <div class="p-8 space-y-8">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Resep</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($prescriptions as $resep)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-slate-900">{{ $resep->created_at->format('d M Y') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">{{ $resep->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="font-black text-slate-900">{{ $resep->user->name ?? 'User' }}</div>
                                    <div class="text-xs font-bold text-blue-600/70">{{ $resep->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/prescriptions/' . $resep->foto_resep) }}" 
                                        class="w-12 h-12 rounded-lg object-cover border border-slate-100 shadow-sm"
                                        onerror="this.src='https://ui-avatars.com/api/?name=Resep&background=f1f5f9&color=64748b'">
                                    
                                    <a href="{{ asset('storage/prescriptions/' . $resep->foto_resep) }}" target="_blank" 
                                    class="text-blue-600 hover:text-blue-700 font-bold text-xs bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                        Lihat Full
                                    </a>
                                </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter
                                        {{ $resep->status_verifikasi == 'Menunggu' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $resep->status_verifikasi == 'Valid' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $resep->status_verifikasi == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ $resep->status_verifikasi }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <form action="{{ route('admin.resep.update', $resep->prescription_id) }}" method="POST" class="flex items-center justify-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status_verifikasi" onchange="this.form.submit()" class="text-xs font-black border-slate-100 rounded-xl bg-slate-50 focus:ring-blue-600 focus:border-blue-600 py-2 px-4 cursor-pointer">
                                            <option value="Menunggu" {{ $resep->status_verifikasi == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="Valid" {{ $resep->status_verifikasi == 'Valid' ? 'selected' : '' }}>Valid</option>
                                            <option value="Ditolak" {{ $resep->status_verifikasi == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="font-bold text-slate-400 text-sm">Belum ada resep yang masuk hari ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>