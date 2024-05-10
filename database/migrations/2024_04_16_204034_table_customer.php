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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('email', 55);
            $table->string('nama', 55);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->foreignId('paket_id')->constrained('paket');
            $table->bigInteger('berat');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            //
        });
    }
};
