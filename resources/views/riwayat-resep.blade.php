<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Resep - Apotek App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-blue-200 selection:text-blue-900">
    
    @include('navbar')

    <main class="md:pl-64 min-h-screen flex flex-col relative">
        
        <header class="h-20 bg-white/80 backdrop-blur-xl sticky top-0 z-40 border-b border-gray-200 px-6 sm:px-10 flex items-center justify-between shadow-sm">
            <h1 class="text-xl font-extrabold text-gray-900">Riwayat Resep Anda</h1>
            <a href="/katalog" class="text-sm font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-4 py-2 rounded-full transition-colors">
                + Upload Resep Baru
            </a>
        </header>

        <div class="p-6 sm:p-10 flex-1">
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest whitespace-nowrap">Tanggal</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest whitespace-nowrap">File Resep</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest">Catatan</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest whitespace-nowrap">Status</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($riwayatResep as $resep)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="font-bold text-gray-900 text-sm">{{ $resep->created_at->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500 font-medium">{{ $resep->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <a href="{{ asset('storage/prescriptions/' . $resep->foto_resep) }}" target="_blank" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            Lihat File
                                        </a>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm text-gray-600 line-clamp-2 max-w-xs" title="{{ $resep->catatan_verifikasi }}">
                                            {{ $resep->catatan_verifikasi ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider
                                            {{ $resep->status_verifikasi == 'Menunggu' ? 'bg-amber-100 text-amber-700' : '' }}
                                            {{ $resep->status_verifikasi == 'Valid' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                            {{ $resep->status_verifikasi == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                            {{ $resep->status_verifikasi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-center">
                                        <form action="{{ route('resep.destroy', $resep->prescription_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus resep ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" title="Hapus Resep">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-900 mb-1">Tidak ada riwayat resep</h3>
                                        <p class="text-gray-500 text-xs">Anda belum pernah mengunggah resep apapun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>