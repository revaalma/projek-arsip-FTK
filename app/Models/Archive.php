<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    // Tambahkan baris ini untuk mengizinkan penyimpanan data
    protected $fillable = [
        'archive_number', 
        'title', 
        'category_id', 
        'file_path', 
        'archive_date'
    ];

    // Tambahkan blok kode relasi ini:
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}