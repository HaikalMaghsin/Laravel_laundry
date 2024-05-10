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
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->ForeignId('outlet_id')->constrained('outlet');
            $table->string('nama_paket',155);
            $table->decimal('harga',8,2);   
            $table->enum('jenis_paket',['kiloan','selimut','bed_cover',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            //
        });
    }
};
