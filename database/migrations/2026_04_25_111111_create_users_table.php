<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kembali ke standar Laravel agar tidak repot
            $table->string('name'); // Ubah 'nama' menjadi 'name'
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Wajib ada untuk bawaan Laravel
            $table->string('password');
            $table->string('no_telp')->nullable(); // nullable() berarti boleh kosong saat register awal
            $table->text('alamat')->nullable();    // Boleh kosong saat register awal
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->enum('role', ['user', 'admin'])->default('user'); // Otomatis jadi 'user' saat mendaftar
            $table->rememberToken(); // Wajib ada untuk fitur "Remember Me" saat login
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};