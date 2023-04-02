<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IskGejala extends Model
{
    use HasFactory;

    protected $table = 'isk_gejala';
    protected $fillable = [
        'gejala',
    ];
}
