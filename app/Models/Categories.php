<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name'
    ];

    public function files()
    {
        // 1 kategori bisa memiliki banyak surat di dalamnya
        return $this->hasMany(Surat::class, 'category_id');
    }
}
