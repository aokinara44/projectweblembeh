<?php

// Lokasi File: database/migrations/YYYY_MM_DD_HHMMSS_create_explore_posts_table.php

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
        Schema::create('explore_posts', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel explore_categories
            $table->foreignId('explore_category_id')->constrained('explore_categories')->onDelete('cascade'); 
            // Kolom 'title' akan menyimpan JSON untuk terjemahan
            $table->json('title'); 
             // Slug unik untuk URL post
            $table->string('slug')->unique();
            // Kolom 'content' (isi post) akan menyimpan JSON terjemahan, tipe TEXT
            $table->json('content'); 
            // Path ke gambar unggulan (opsional)
            $table->string('featured_image')->nullable(); 
            // Status publikasi (opsional, default tidak terbit)
            $table->boolean('is_published')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explore_posts');
    }
};