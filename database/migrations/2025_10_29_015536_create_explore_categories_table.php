<?php

// Lokasi File: database/migrations/YYYY_MM_DD_HHMMSS_create_explore_categories_table.php

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
        Schema::create('explore_categories', function (Blueprint $table) {
            $table->id();
            // Kolom 'name' akan menyimpan JSON untuk terjemahan EN, NL, ZH
            $table->json('name'); 
            // Slug unik untuk URL, misal: 'diving-spots', 'marine-life'
            $table->string('slug')->unique(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explore_categories');
    }
};