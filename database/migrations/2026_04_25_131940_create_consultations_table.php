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
public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('consultation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pharmacist_id')->nullable();
            $table->enum('tipe', ['ai', 'apoteker']);
            $table->text('pesan');
            $table->text('respon')->nullable();
            
            // UBAH 'user_id' MENJADI 'id' PADA BAGIAN references()
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pharmacist_id')->references('pharmacist_id')->on('pharmacists')->onDelete('set null');
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
        Schema::dropIfExists('consultations');
    }
};
