<?php

// Lokasi File: app/Models/ExploreCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // Import HasTranslations

class ExploreCategory extends Model
{
    use HasFactory, HasTranslations; // Gunakan HasTranslations

    protected $fillable = [
        'name', 
        'slug',
    ];

    // Tentukan kolom mana saja yang bisa diterjemahkan
    public $translatable = ['name'];

    /**
     * Definisikan relasi one-to-many ke ExplorePost.
     * Satu kategori bisa memiliki banyak post.
     */
    public function explorePosts()
    {
        return $this->hasMany(ExplorePost::class);
    }

    /**
     * Menggunakan 'slug' untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}