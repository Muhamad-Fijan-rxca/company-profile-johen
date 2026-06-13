<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sosmed', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['ig', 'tt']);
            $table->string('name');
            $table->string('username');
            $table->string('followers');
            $table->string('avatar')->nullable();
            $table->text('desc');
            $table->string('url');
            $table->string('btn_text');
            $table->json('thumbnails')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sosmed');
    }
};
