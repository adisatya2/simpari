<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IadpGejala extends Model
{
    use HasFactory;

    protected $table = 'iadp_gejala';
    protected $fillable = [
        'gejala',
    ];
}
