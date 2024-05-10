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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained('outlet');
            $table->foreignId('customer_id')->constrained('customer');
            $table->date('tanggal');
            $table->date('batas_waktu');
            $table->date('tanggal_bayar');
            $table->bigInteger('biaya_tambahan')->nullable();
            $table->bigInteger('diskon')->nullable();
            $table->bigInteger('pajak')->nullable();
            $table->enum('status',['baru','proses','selesai','diambil']);
            $table->enum('dibayar',['dibayar','belum_dibayar']);
            $table->foreignId('users_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('  transaksi');
    }
};
