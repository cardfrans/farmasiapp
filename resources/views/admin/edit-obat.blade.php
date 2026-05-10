<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Obat</h1>

        <form action="/admin/obat/{{ $obat->medicine_id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nama Obat</label>
                <input type="text" name="nama_obat" value="{{ $obat->nama_obat }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                <input type="text" name="kategori" value="{{ $obat->kategori }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ $obat->harga }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Stok</label>
                <input type="number" name="stok" value="{{ $obat->stok }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Gambar Obat</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-4 py-2" accept="image/*">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="/admin/obat" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>