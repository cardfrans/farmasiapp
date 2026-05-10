<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Obat Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Obat Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Oops! Ada masalah:</p>
                <ul class="list-disc ml-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/obat" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Obat</label>
                <input type="text" name="nama_obat" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Obat Bebas">Obat Bebas</option>
                        <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                        <option value="Obat Keras">Obat Keras</option>
                        <option value="Antibiotik">Antibiotik</option>
                        <option value="Vitamin & Suplemen">Vitamin & Suplemen</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Satuan</label>
                    <input type="text" name="satuan" placeholder="Contoh: Strip, Botol, Box" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" name="harga" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok Awal</label>
                    <input type="number" name="stok" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi Obat</label>
                <textarea name="deskripsi" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Gambar Obat</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-4 py-2" accept="image/*">
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="/admin/obat" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-300">Batal</a>
                <button type="submit" class="bg-blue-600 text-dark px-4 py-2 rounded-md font-medium hover:bg-blue-700">Simpan Obat</button>
            </div>

        </form>
    </div>

</body>
</html>