<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ksm extends Model
{
    use HasFactory;

    protected $table = 'ksms';

    protected $fillable = [
        'ksm_name'
    ];

    public function spesialis()
    {
        // satu KSM memiliki banyak spesialis
        return $this->hasMany(Spesialis::class, 'ksm_id');
    }
}
