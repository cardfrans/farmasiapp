<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Apotek App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-blue-200 selection:text-blue-900">

    @include('navbar')

    <main class="md:pl-64 min-h-screen flex flex-col">
        
        <header class="h-20 bg-white/80 backdrop-blur-xl sticky top-0 z-40 border-b border-gray-200 px-6 sm:px-10 flex items-center justify-between">
            <h1 class="text-xl font-extrabold text-gray-900">Keranjang Belanja</h1>
        </header>

        @if(session('success'))
        <div class="px-6 sm:px-10 mt-6">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="p-6 sm:p-10 flex-1">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="flex-1">
                    <div class="bg-white rounded-3xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 overflow-hidden">
                        
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                            <h2 class="font-bold text-gray-800 text-lg">Item Keranjang Anda</h2>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse($carts as $item) 
                                <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center gap-6 hover:bg-gray-50/50 transition-colors group">
                                    
                                    <div class="h-24 w-24 rounded-2xl bg-gray-50 flex items-center justify-center overflow-hidden shrink-0 border border-gray-100">
                                        @if($item->medicine && $item->medicine->gambar)
                                            <img src="{{ asset('storage/' . $item->medicine->gambar) }}" alt="{{ $item->medicine->nama_obat }}" class="object-cover h-full w-full group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="text-xs font-semibold text-gray-400">No Image</div>
                                        @endif
                                    </div>

                                    <div class="flex-1 w-full">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->medicine->nama_obat ?? 'Obat Tidak Diketahui' }}</h3>
                                        <p class="text-sm text-gray-500 mb-2">{{ $item->medicine->kategori ?? '-' }}</p>
                                        <div class="font-extrabold text-blue-600 text-lg">Rp {{ number_format($item->medicine->harga ?? 0, 0, ',', '.') }}</div>
                                    </div>

                                    <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center w-full sm:w-auto gap-4 mt-2 sm:mt-0">
                                        
                                        <div class="flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-xl border border-gray-200">
                                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Qty</span>
                                            <span class="font-bold text-gray-900 text-sm">{{ $item->jumlah ?? $item->quantity ?? 1 }}</span>
                                        </div>

                                        <form action="/keranjang/hapus/{{ $item->cart_id ?? $item->id }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1.5 bg-white border border-gray-200 hover:border-red-200 px-3 py-1.5 rounded-xl shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @empty
                                <div class="p-16 text-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 shadow-sm">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Keranjang Anda Kosong</h3>
                                    <p class="text-gray-500 text-sm">Belum ada obat yang Anda tambahkan ke keranjang.</p>
                                    <a href="/katalog" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors shadow-sm">Mulai Belanja</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                @if(count($carts) > 0)
                <div class="w-full lg:w-96 shrink-0">
                    <div class="bg-white rounded-3xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-6 sticky top-28">
                        <h2 class="font-bold text-gray-900 text-lg mb-6">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-500 text-sm">
                                <span>Total Item</span>
                                <span class="font-semibold text-gray-900">{{ count($carts) }} Barang</span>
                            </div>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="font-bold text-gray-900">Total Harga</span>
                                <span class="text-xl font-extrabold text-blue-600">
                                    Rp {{ number_format($totalHarga ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <form action="/checkout" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-gray-900 hover:bg-blue-600 text-white px-6 py-3.5 rounded-xl font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                Lanjut ke Pembayaran
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                        
                        <a href="/katalog" class="mt-4 block text-center text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors">
                            Tambah Obat Lain
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </main>

</body>
</html>