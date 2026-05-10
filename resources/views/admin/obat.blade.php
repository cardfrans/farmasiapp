<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Obat - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-blue-100 selection:text-blue-900">

    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col z-40 flex-shrink-0 hidden md:flex">
        <div class="h-20 flex items-center px-8 border-b border-slate-50">
            <a href="#" class="font-extrabold text-xl tracking-tight text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm shadow-lg shadow-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                FarmasiApp
            </a>
        </div>
        <nav class="flex-1 px-4 py-8 space-y-1.5 overflow-y-auto">
            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Menu Utama</p>
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold transition-all duration-200 text-slate-500 hover:bg-slate-50 hover:text-slate-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="/admin/obat" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold transition-all duration-200 bg-blue-50 text-blue-600 shadow-sm border border-blue-100/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Katalog Obat
            </a>
            <a href="/admin/pesanan" class="flex items-center justify-between px-4 py-3.5 rounded-2xl font-bold transition-all duration-200 text-slate-500 hover:bg-slate-50 hover:text-slate-900">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Pesanan
                </div>
            </a>
        </nav>
        

        <div class="p-6 border-t border-slate-100 bg-white">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold border border-slate-200">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name ?? 'Admin Farmasi' }}</p>
                    <p class="text-xs font-medium text-slate-400">Super Admin</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full bg-slate-50 border border-slate-200 hover:border-red-200 hover:text-red-600 hover:bg-red-50 text-slate-600 px-4 py-3 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative bg-slate-50/50">
        <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200/50 px-8 flex items-center justify-between flex-shrink-0 z-30">
            <div>
                <h1 class="text-xl font-black text-slate-900">Manajemen Katalog Obat</h1>
                <p class="text-xs font-semibold text-slate-400">Kelola stok dan informasi produk apotek</p>
            </div>
            <button onclick="openModal('addMedicineModal')" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all hover:-translate-y-0.5">
                + Tambah Obat Baru
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-[2.5rem] shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest text-slate-400 font-black">
                                <th class="px-8 py-5">Info Produk</th>
                                <th class="px-8 py-5">Kategori</th>
                                <th class="px-8 py-5">Stok</th>
                                <th class="px-8 py-5">Harga</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($medicines as $obat)
                            <tr class="hover:bg-blue-50/30 transition-colors group text-sm font-medium">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-5">
                                        <div class="h-14 w-14 rounded-2xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                            @if($obat->gambar)
                                                <img src="{{ asset('storage/' . $obat->gambar) }}" class="w-full h-full object-cover cursor-pointer" onclick="openImageZoom('{{ asset('storage/' . $obat->gambar) }}')">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900">{{ $obat->nama_obat }}</div>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">ID-{{ str_pad($obat->medicine_id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase border border-slate-200/50">{{ $obat->kategori }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="font-black {{ $obat->stok < 10 ? 'text-red-500' : 'text-slate-700' }}">{{ $obat->stok }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $obat->satuan }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 font-black text-slate-900">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center items-center gap-3">
                                        <button onclick="openEditModal('{{ $obat->medicine_id }}', '{{ addslashes($obat->nama_obat) }}', '{{ $obat->kategori }}', '{{ $obat->harga }}', '{{ $obat->stok }}', '{{ $obat->satuan }}', '{{ addslashes($obat->deskripsi) }}', '{{ $obat->gambar ? asset('storage/' . $obat->gambar) : '' }}')" class="text-blue-600 font-black text-[10px] uppercase tracking-widest hover:text-blue-800 transition-colors">Edit</button>
                                        <span class="text-slate-200">|</span>
                                        <form action="/admin/obat/{{ $obat->medicine_id }}" method="POST" class="m-0" onsubmit="return confirm('Hapus obat ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 font-black text-[10px] uppercase tracking-widest hover:text-red-600 transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="py-20 text-center font-bold text-slate-300 italic tracking-widest">Katalog Kosong</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="addMedicineModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeModal('addMedicineModal')"></div>
        <div class="modal-content relative bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 m-4 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-black text-slate-900 mb-8">Tambah Obat Baru</h2>

            <form action="/admin/obat" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Obat</label>
                        <input type="text" name="nama_obat" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>

                    <div x-data="{ open: false, selected: 'Obat Bebas' }">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori</label>
                        <div class="relative">
                            <input type="hidden" name="kategori" :value="selected">
                            <button @click="open = !open" type="button" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-left focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm flex justify-between items-center">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute z-50 mt-2 w-full bg-white border border-slate-100 rounded-[1.5rem] shadow-2xl py-3 overflow-hidden">
                                <template x-for="item in ['Obat Bebas', 'Obat Resep', 'Vitamin & Suplemen', 'Antibiotik', 'Herbal']">
                                    <button @click="selected = item; open = false" type="button" class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" x-text="item"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Stok</label>
                        <input type="number" name="stok" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>

                    <div x-data="{ open: false, selected: 'Pcs' }">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Satuan</label>
                        <div class="relative">
                            <input type="hidden" name="satuan" :value="selected">
                            <button @click="open = !open" type="button" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-left focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm flex justify-between items-center">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute z-50 mt-2 w-full bg-white border border-slate-100 rounded-[1.5rem] shadow-2xl py-3 overflow-hidden">
                                <template x-for="item in ['Pcs', 'Strip', 'Botol', 'Tablet', 'Tube']">
                                    <button @click="selected = item; open = false" type="button" class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" x-text="item"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full text-xs font-bold text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white cursor-pointer">
                    </div>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal('addMedicineModal')" class="px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Batal</button>
                    <button type="submit" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 shadow-xl shadow-slate-200 transition-all">Simpan Obat</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editMedicineModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeModal('editMedicineModal')"></div>
        <div class="modal-content relative bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 m-4 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-black text-slate-900 mb-8">Perbarui Data Obat</h2>

            <form id="editMedicineForm" action="" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Obat</label>
                        <input type="text" id="edit_nama_obat" name="nama_obat" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>

                    <div x-data="{ open: false, selected: '' }" id="alpine_kategori_edit">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori</label>
                        <div class="relative">
                            <input type="hidden" name="kategori" id="edit_kategori_hidden" :value="selected">
                            <button @click="open = !open" type="button" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-left focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm flex justify-between items-center">
                                <span x-text="selected || 'Pilih Kategori'"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute z-50 mt-2 w-full bg-white border border-slate-100 rounded-[1.5rem] shadow-2xl py-3 overflow-hidden">
                                <template x-for="item in ['Obat Bebas', 'Obat Resep', 'Vitamin & Suplemen', 'Antibiotik', 'Herbal']">
                                    <button @click="selected = item; open = false" type="button" class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" x-text="item"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Harga (Rp)</label>
                        <input type="number" id="edit_harga" name="harga" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Stok</label>
                        <input type="number" id="edit_stok" name="stok" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm">
                    </div>

                    <div x-data="{ open: false, selected: '' }" id="alpine_satuan_edit">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Satuan</label>
                        <div class="relative">
                            <input type="hidden" name="satuan" id="edit_satuan_hidden" :value="selected">
                            <button @click="open = !open" type="button" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-left focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm flex justify-between items-center">
                                <span x-text="selected || 'Pilih Satuan'"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute z-50 mt-2 w-full bg-white border border-slate-100 rounded-[1.5rem] shadow-2xl py-3 overflow-hidden">
                                <template x-for="item in ['Pcs', 'Strip', 'Botol', 'Tablet', 'Tube']">
                                    <button @click="selected = item; open = false" type="button" class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" x-text="item"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="3" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-sm"></textarea>
                    </div>
                    <div class="md:col-span-2 flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div id="edit_gambar_preview_container" class="hidden shrink-0"><img id="edit_gambar_preview" src="" class="h-20 w-20 object-cover rounded-xl shadow-sm"></div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ganti Gambar Produk</label>
                            <input type="file" name="gambar" accept="image/*" class="w-full text-xs font-bold text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 cursor-pointer">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal('editMedicineModal')" class="px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Batal</button>
                    <button type="submit" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="imageZoomModal" class="fixed inset-0 z-[60] flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-md transition-opacity duration-300" onclick="closeImageZoom()"></div>
        <div class="relative z-10 max-w-3xl w-full mx-4 flex flex-col items-center justify-center">
            <button onclick="closeImageZoom()" class="absolute -top-16 right-0 text-white hover:text-red-400 transition-colors"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <img id="zoomedImage" src="" class="w-full h-auto max-h-[80vh] object-contain rounded-3xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.modal-backdrop').classList.remove('opacity-0');
                modal.querySelector('.modal-content').classList.remove('opacity-0', 'scale-95');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.querySelector('.modal-backdrop').classList.add('opacity-0');
            modal.querySelector('.modal-content').classList.add('opacity-0', 'scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        function openEditModal(id, nama, kategori, harga, stok, satuan, deskripsi, gambarUrl) {
            document.getElementById('editMedicineForm').action = '/admin/obat/' + id;
            document.getElementById('edit_nama_obat').value = nama;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_stok').value = stok;
            document.getElementById('edit_deskripsi').value = deskripsi;
            
            // Masukkan nilai ke Custom Dropdown Alpine.js (Edit)
            document.getElementById('alpine_kategori_edit')._x_dataStack[0].selected = kategori;
            document.getElementById('alpine_satuan_edit')._x_dataStack[0].selected = satuan;

            const previewContainer = document.getElementById('edit_gambar_preview_container');
            const previewImg = document.getElementById('edit_gambar_preview');
            if (gambarUrl) { previewImg.src = gambarUrl; previewContainer.classList.remove('hidden'); }
            else { previewContainer.classList.add('hidden'); }
            
            openModal('editMedicineModal');
        }

        function openImageZoom(imgSrc) {
            const zoomedImage = document.getElementById('zoomedImage');
            zoomedImage.src = imgSrc;
            document.getElementById('imageZoomModal').classList.remove('hidden');
            setTimeout(() => { zoomedImage.classList.remove('scale-95', 'opacity-0'); }, 10);
        }

        function closeImageZoom() {
            const img = document.getElementById('zoomedImage');
            img.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { document.getElementById('imageZoomModal').classList.add('hidden'); }, 300);
        }
    </script>
</body>
</html>