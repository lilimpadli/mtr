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
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penyewaan_id')->constrained('penyewaans')->onDelete('cascade');
        $table->decimal('jumlah', 10, 2);
        $table->enum('metode_pembayaran', ['cash','transfer','ewallet']);
        $table->enum('status', ['pending','berhasil','gagal'])->default('pending');
        $table->timestamp('tanggal')->useCurrent();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
