<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Obat - Apotek App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-blue-200 selection:text-blue-900">
    
    @include('navbar')

    <main class="md:pl-64 min-h-screen flex flex-col relative">
        
        <header class="h-20 bg-white/80 backdrop-blur-xl sticky top-0 z-40 border-b border-gray-200 px-6 sm:px-10 flex items-center justify-between shadow-sm">
            <h1 class="text-xl font-extrabold text-gray-900 hidden sm:block">Belanja Obat</h1>
            
            <form action="" method="GET" class="w-full sm:w-96 relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari paracetamol, vitamin..." class="w-full pl-11 pr-4 py-2.5 border-none rounded-full bg-gray-100 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm font-medium text-gray-700 placeholder-gray-400">
            </form>
        </header>

        <div class="p-6 sm:p-10 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                @forelse($medicines as $obat)
                    <div class="bg-white rounded-3xl p-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                        
                        <span class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-[10px] font-bold text-blue-600 uppercase tracking-wider shadow-sm z-10">
                            {{ $obat->kategori }}
                        </span>

                        <div class="relative h-48 bg-gray-50/50 rounded-2xl flex items-center justify-center p-6 mb-5 overflow-hidden group-hover:bg-blue-50/30 transition-colors">
                            @if($obat->gambar)
                                <img src="{{ asset('storage/' . $obat->gambar) }}" alt="{{ $obat->nama_obat }}" class="object-contain h-full w-full group-hover:scale-110 transition-transform duration-500 ease-out">
                            @else
                                <div class="text-gray-300 flex flex-col items-center">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 flex flex-col px-2 pb-2">
                            <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1 line-clamp-1" title="{{ $obat->nama_obat }}">{{ $obat->nama_obat }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $obat->deskripsi }}</p>
                            
                            <div class="mt-auto flex items-end justify-between gap-2">
                                <div>
                                    <p class="text-[11px] font-semibold text-gray-400 mb-0.5 uppercase tracking-wide">Harga</p>
                                    <div class="text-xl font-extrabold text-blue-600">
                                        Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                    </div>
                                    <p class="text-xs font-medium mt-1 {{ $obat->stok > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                        Sisa: {{ $obat->stok }} {{ $obat->satuan ?? 'Pcs' }}
                                    </p>
                                </div>
                                
                                @if($obat->stok > 0)
                                    <button type="button" onclick="openCartModal('{{ $obat->medicine_id ?? $obat->id }}', '{{ addslashes($obat->nama_obat) }}')" class="bg-gray-900 hover:bg-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center transition-colors shadow-sm" title="Tambah ke Keranjang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                @else
                                    <button disabled class="bg-gray-100 text-gray-400 w-10 h-10 rounded-xl flex items-center justify-center cursor-not-allowed" title="Stok Habis">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 flex flex-col items-center justify-center text-center bg-white rounded-3xl border border-gray-100 border-dashed">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Obat tidak ditemukan</h3>
                        <p class="text-gray-500 max-w-sm">Coba cari dengan kata kunci lain atau hapus filter pencarian Anda.</p>
                        <a href="/katalog" class="mt-4 text-blue-600 font-semibold hover:text-blue-700 text-sm">Reset Pencarian</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                @if(method_exists($medicines, 'links'))
                    {{ $medicines->withQueryString()->links() }}
                @endif
            </div>

        </div>
    </main>

    <div id="addToCartModal" class="fixed inset-0 z-[60] flex items-center justify-center hidden">
        <div class="modal-backdrop absolute inset-0 bg-gray-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeCartModal()"></div>
        
        <div class="modal-content relative bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 m-4 transform scale-95 opacity-0 transition-all duration-300 text-center">
            
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Konfirmasi Keranjang</h3>
            <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                Apakah Anda yakin ingin menambahkan <br>
                <strong id="modalMedicineName" class="text-gray-900 font-bold text-base"></strong><br>
                ke keranjang belanja?
            </p>
            
            <form id="addToCartForm" action="/keranjang/tambah" method="POST" class="m-0">
                @csrf
                <input type="hidden" name="medicine_id" id="modalMedicineId" value="">
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeCartModal()" class="flex-1 py-3 bg-gray-50 hover:bg-gray-100 text-gray-600 hover:text-gray-800 font-bold rounded-xl transition-colors text-sm border border-gray-100">
                        Tidak, Batal
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                        Ya, Tambahkan
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openCartModal(id, namaObat) {
            const modal = document.getElementById('addToCartModal');
            const backdrop = modal.querySelector('.modal-backdrop');
            const content = modal.querySelector('.modal-content');

            // Set data dinamis ke dalam Modal
            document.getElementById('modalMedicineId').value = id;
            document.getElementById('modalMedicineName').innerText = namaObat;

            // Tampilkan Modal dengan animasi
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'scale-95');
            }, 10);
        }

        function closeCartModal() {
            const modal = document.getElementById('addToCartModal');
            const backdrop = modal.querySelector('.modal-backdrop');
            const content = modal.querySelector('.modal-content');

            // Tutup Modal dengan animasi
            backdrop.classList.add('opacity-0');
            content.classList.add('opacity-0', 'scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                // Bersihkan data setelah modal tertutup
                document.getElementById('modalMedicineId').value = '';
                document.getElementById('modalMedicineName').innerText = '';
            }, 300);
        }
    </script>
</body>
</html>