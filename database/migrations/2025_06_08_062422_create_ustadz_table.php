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
        Schema::create('ustadz', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama ustadz');
            $table->string('photo')->nullable()->comment('Foto ustadz');
            $table->text('address')->nullable()->comment('Alamat ustadz');
            $table->string('phone')->nullable()->comment('Nomor telepon ustadz');
            $table->string('email')->nullable()->comment('Email ustadz');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ustadz');
    }
};
