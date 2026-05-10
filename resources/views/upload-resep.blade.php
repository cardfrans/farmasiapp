<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resep Dokter - Apotek App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Apotek App</h1>
            <div class="space-x-4">
                <a href="/katalog" class="text-gray-600 hover:text-blue-600 font-medium">Katalog</a>
                <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium">Masuk</a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Upload Resep Dokter</h2>
            <p class="text-gray-600 mb-6">Unggah foto resep dokter Anda di sini. Apoteker kami akan memverifikasi dan menyiapkan obat sesuai resep Anda.</p>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div>
                    <label for="foto_resep" class="block text-sm font-medium text-gray-700 mb-2">Foto Resep <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-500 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Pilih file</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG maksimal 5MB</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Misal: Tolong berikan obat versi generiknya saja..."></textarea>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded-md font-medium hover:bg-blue-700 transition shadow-sm">
                        Kirim Resep
                    </button>
                </div>

            </form>
        </div>
    </main>

</body>
</html>