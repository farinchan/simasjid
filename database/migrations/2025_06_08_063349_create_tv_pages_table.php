<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tv_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama halaman TV');
            $table->string('image')->nullable()->comment('Gambar halaman TV');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_pages');
    }
};
