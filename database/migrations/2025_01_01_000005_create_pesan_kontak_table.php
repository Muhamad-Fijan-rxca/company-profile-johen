<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesan_kontak', function (Blueprint $table) {
            $table->id();
            $table->enum('tujuan', ['jual', 'beli', 'cs']);
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            // Jual
            $table->string('nama_game')->nullable();
            $table->string('level_akun')->nullable();
            $table->string('harga_harapan')->nullable();
            $table->text('deskripsi')->nullable();
            // Beli
            $table->string('game_dicari')->nullable();
            $table->string('budget_maksimal')->nullable();
            $table->text('request_khusus')->nullable();
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
    }
};
