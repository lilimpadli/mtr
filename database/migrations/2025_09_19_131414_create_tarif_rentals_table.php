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
    Schema::create('tarif_rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('motor_id')->constrained('motors')->onDelete('cascade');
        $table->decimal('tarif_harian', 10, 2)->nullable();
        $table->decimal('tarif_mingguan', 10, 2)->nullable();
        $table->decimal('tarif_bulanan', 10, 2)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_rentals');
    }
};
