<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdoGejala extends Model
{
    use HasFactory;

    protected $table = 'ido_gejala';
    protected $fillable = [
        'gejala',
    ];
}
