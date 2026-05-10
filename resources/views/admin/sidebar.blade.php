<aside class="w-64 bg-white border-r border-slate-100 flex flex-col z-40 flex-shrink-0 hidden md:flex">
    <div class="h-20 flex items-center px-8 border-b border-slate-50">
        <a href="{{ route('dashboard') }}" class="font-extrabold text-xl tracking-tight text-slate-900 flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm shadow-lg shadow-blue-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 7l4 2-4 2m0 6l4-2-4-2m-8-6l4 2-4 2m0 6l4-2-4-2"></path></svg>
            </div>
            <span>FarmasiApp<span class="text-blue-600">App</span></span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} rounded-xl transition-all duration-200 group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="font-bold text-sm">Dashboard</span>
        </a>

        <a href="/admin/obat" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/obat*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} rounded-xl transition-all duration-200 group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.423 15.641l-4.49-4.49c.563-.563.877-1.328.877-2.151 0-1.68-1.361-3.041-3.041-3.041s-3.041 1.361-3.041 3.041c0 .823.314 1.588.877 2.151l-4.49 4.49c-.563.563-.877 1.328-.877 2.151 0 1.68 1.361 3.041 3.041 3.041s3.041-1.361 3.041-3.041c0-.823-.314-1.588-.877-2.151l4.49-4.49c.563-.563.877-1.328.877-2.151 0-1.68-1.361-3.041-3.041-3.041s-3.041 1.361-3.041 3.041c0 .823.314 1.588.877 2.151l4.49 4.49z"></path></svg>
            <span class="font-bold text-sm">Katalog Obat</span>
        </a>

        <a href="{{ route('admin.resep.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.resep.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} rounded-xl transition-all duration-200 group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="font-bold text-sm">Kelola Resep</span>
        </a>

        <a href="/admin/pesanan" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/pesanan*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} rounded-xl transition-all duration-200 group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <span class="font-bold text-sm">Pesanan Masuk</span>
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

    <div class="p-4 border-t border-slate-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-bold text-sm">Keluar Panel</span>
            </button>
        </form>
    </div>
</aside>