<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            // Cek dulu apakah kolom 'gambar' BELUM ada, baru ditambahkan
            if (!Schema::hasColumn('medicines', 'gambar')) {
                $table->string('gambar')->nullable()->after('nama_obat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
