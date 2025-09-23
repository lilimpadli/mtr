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
    Schema::create('motors', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pemilik_id')->constrained('users')->onDelete('cascade');
        $table->string('merk');
        $table->enum('tipe_cc', ['100','125','150']);
        $table->string('no_plat')->unique();
        $table->enum('status', ['tersedia','disewa','perawatan'])->default('tersedia');
        $table->string('photo')->nullable();
        $table->string('dokumen_kepemilikan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
