<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ongkir - Apotek App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style> 
        body { font-family: 'Inter', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        /* Styling Select2 agar cocok dengan Tailwind */
        .select2-container--default .select2-selection--single {
            border-radius: 0.75rem; border-color: #e2e8f0; height: 45px; display: flex; align-items: center;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    
    @include('navbar')

    <main class="md:pl-64 min-h-screen flex flex-col">
        <header class="glass-effect sticky top-0 z-40 border-b border-slate-200/60 px-6 sm:px-10 py-5 sm:py-6">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <h1 class="text-xl font-extrabold text-slate-900">Kalkulator Ongkos Kirim</h1>
            </div>
        </header>

        <div class="p-6 sm:p-10 max-w-4xl mx-auto w-full">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                <div class="p-6 sm:p-8">
                    <form id="shippingForm" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">Wilayah Asal Pengiriman</label>
                                <select name="origin" id="origin" class="select2-ajax w-full" required></select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">Wilayah Tujuan</label>
                                <select name="destination" id="destination" class="select2-ajax w-full" required></select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Berat Barang (Gram)</label>
                            <input type="number" name="weight" id="weight" value="1000" min="1" 
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                        </div>

                        <button type="submit" id="btnSubmit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-xl font-bold text-sm shadow-lg shadow-blue-100 transition-all flex items-center justify-center gap-2">
                            <span id="btnText">Cek Tarif Sekarang</span>
                            <div id="loading-state" class="hidden animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></div>
                        </button>
                    </form>
                </div>
            </div>

            <div id="resultWrapper" class="hidden space-y-4">
                <h3 class="text-lg font-bold text-slate-900 px-1">Pilihan Kurir Tersedia</h3>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kurir</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Estimasi</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody id="resultTableBody" class="divide-y divide-slate-100">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="errorAlert" class="hidden p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl text-sm font-medium"></div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.select2-ajax').select2({
            placeholder: 'Cari Kota atau Kecamatan...',
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: '/api/search-area',
                dataType: 'json',
                delay: 250,
                data: function (params) { return { q: params.term }; },
                processResults: function (data) { return { results: data }; },
                cache: true
            }
        });

        $('#shippingForm').on('submit', function(e) {
            e.preventDefault();
            $('#btnText').text('Menghitung...');
            $('#loading-state').removeClass('hidden');
            $('#btnSubmit').prop('disabled', true);
            $('#resultWrapper').addClass('hidden');
            $('#errorAlert').addClass('hidden');

            $.ajax({
                url: "{{ url('/cek-ongkir') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#btnText').text('Cek Tarif Sekarang');
                    $('#loading-state').addClass('hidden');
                    $('#btnSubmit').prop('disabled', false);

                    if(response.success) {
                        let html = '';
                        response.pricing.forEach(function(item) {
                            
                            // PERBAIKAN LOGO: Memaksa huruf kecil dan mengambil dari server image biteship
                            let courierCode = item.courier_code.toLowerCase();
                            let logoUrl = `https://biteship.com/images/courier-logo/${courierCode}.png`;
                            
                            html += `
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-5">
                                        <img src="${logoUrl}" 
                                             class="h-10 w-auto object-contain mb-1" 
                                             alt="${item.courier_name}"
                                             onerror="this.src='https://via.placeholder.com/80x40?text=${item.courier_name}'">
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">${item.courier_name}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-slate-900">${item.courier_service_name}</div>
                                        <div class="text-xs text-slate-500">${item.description || ''}</div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                            ${item.duration}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right font-extrabold text-slate-900">
                                        Rp ${item.price.toLocaleString('id-ID')}
                                    </td>
                                </tr>
                            `;
                        });
                        $('#resultTableBody').html(html);
                        $('#resultWrapper').removeClass('hidden');
                    } else {
                        $('#errorAlert').text(response.error).removeClass('hidden');
                    }
                },
                error: function() {
                    $('#btnText').text('Cek Tarif Sekarang');
                    $('#loading-state').addClass('hidden');
                    $('#btnSubmit').prop('disabled', false);
                    $('#errorAlert').text('Terjadi kesalahan koneksi.').removeClass('hidden');
                }
            });
        });
    });
    </script>
</body>
</html>