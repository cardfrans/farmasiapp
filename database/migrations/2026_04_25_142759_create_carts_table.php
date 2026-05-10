<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
    {
        // Tambahkan baris ini untuk berjaga-jaga menghapus tabel carts yang 
        // mungkin "setengah jadi" akibat error sebelumnya
        Schema::dropIfExists('carts');

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Kita simpan ID-nya saja sebagai angka biasa.
            // Ini akan membypass Error 150 MySQL sepenuhnya!
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('medicine_id');
            
            $table->integer('jumlah')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
