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
        Schema::create('kajian_times', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime')->comment('Tanggal pelaksanaan shalat Jumat');
            $table->foreignId('ustadz_id')->constrained('ustadz')->onDelete('cascade')->comment('ID ustadz yang memimpin shalat Jumat');
            $table->string('theme')->comment('Tema kajian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajian_times');
    }
};
