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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id('prescription_id');
            $table->unsignedBigInteger('user_id');
            $table->string('foto_resep');
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->string('status_verifikasi');
            $table->text('catatan_verifikasi')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();

            // UBAH 'user_id' MENJADI 'id' PADA BAGIAN references()
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verified_by')->references('admin_id')->on('admins')->onDelete('set null');
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
        Schema::dropIfExists('prescriptions');
    }
};
