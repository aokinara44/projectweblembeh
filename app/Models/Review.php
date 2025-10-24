<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // <-- TAMBAHKAN IMPORT INI

class Review extends Model
{
    use HasFactory;
    use HasTranslations; // <-- TAMBAHKAN TRAIT INI

    // Tentukan field yang bisa diterjemahkan
    public $translatable = ['reviewer_name', 'review_text']; // <-- TAMBAHKAN INI

    protected $fillable = [
        'reviewer_name',
        'review_text',
        'rating',
    ];
}