<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    use HasFactory;

    protected $table = 'spesialis';

    protected $fillable = [
        'ksm_id',
        'spesialis_name'
    ];

    public function ksm()
    {
        // ksm dari sebuah spesialis asalnya dari tabel KSM
        return $this->belongsTo(Ksm::class, 'ksm_id');
    }

    public function files()
    {
        // 1 spesialis memiliki banyak surat
        return $this->hasMany(Surat::class, 'spesialis_id');
    }
}
