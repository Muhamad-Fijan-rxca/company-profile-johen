<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('konten_digital');

        Schema::create('konten_digital', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('role')->nullable();
            $table->string('followers')->nullable();
            $table->string('gambar')->nullable();
            $table->string('mascot_influencer')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('unggulan')->default(false);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_digital');
    }
};
