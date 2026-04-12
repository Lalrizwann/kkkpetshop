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
        Schema::table('pemeriksaans', function (Blueprint $table) {
            // Menambahkan kolom user_id agar tahu ini pemeriksaan milik siapa
            $table->foreignId('user_id')->after('pemeriksaan_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaans', function (Blueprint $table) {
            //
        });
    }
};
