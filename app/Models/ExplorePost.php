<?php

// Lokasi File: app/Models/ExplorePost.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // Import HasTranslations

class ExplorePost extends Model
{
    use HasFactory, HasTranslations; // Gunakan HasTranslations

    protected $fillable = [
        'explore_category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'is_published',
    ];

    // Tentukan kolom mana saja yang bisa diterjemahkan
    public $translatable = ['title', 'content'];

    /**
     * Definisikan relasi many-to-one ke ExploreCategory.
     * Satu post dimiliki oleh satu kategori.
     */
    public function exploreCategory()
    {
        return $this->belongsTo(ExploreCategory::class);
    }

    /**
     * Cast is_published sebagai boolean.
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

     /**
     * Menggunakan 'slug' untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}