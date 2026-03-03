<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'title',
        'spesialis_id',
        'category_id',
        'file_path'
    ];

    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
