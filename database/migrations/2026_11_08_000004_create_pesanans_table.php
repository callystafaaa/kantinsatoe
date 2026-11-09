<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_pembeli')->constrained('pembeli', 'id_pembeli')->cascadeOnDelete();
            $table->foreignId('id_kantin')->constrained('kantin', 'id_kantin')->cascadeOnDelete();
            $table->dateTime('tanggal_pesan');
            $table->string('status', 10)->default('menunggu');
            $table->unsignedInteger('total_harga')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};