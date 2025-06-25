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
        Schema::create('tv_setups', function (Blueprint $table) {
            $table->id();
            $table->string('iqamah_break')->default('5')->comment('Durasi jeda antar iqamah dalam detik');
            $table->string('page_break')->default('5')->comment('Durasi jeda antar halaman TV dalam detik');
            $table->boolean('show_jumat')->default(true);
            $table->boolean('show_kajian')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_setups');
    }
};
