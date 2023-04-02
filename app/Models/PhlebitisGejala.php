<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhlebitisGejala extends Model
{
    use HasFactory;

    protected $table = 'phlebitis_gejala';
    protected $fillable = [
        'gejala',
    ];
}
