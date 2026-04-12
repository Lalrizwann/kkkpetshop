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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id(); 
            
            // Siapa yang konsul (Pelanggan)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Siapa dokter yang dituju
            $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade');
            
            // Data Medis
            $table->text('keluhan');          // Pesan dari pelanggan
            $table->text('diagnosa')->nullable(); // Balasan dokter (boleh kosong dulu)
            $table->text('saran')->nullable();    // Saran dokter (boleh kosong dulu)
            
            // Status
            $table->enum('status', ['Pending', 'Selesai'])->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
