<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VapGejala extends Model
{
    use HasFactory;

    protected $table = 'vap_gejala';
    protected $fillable = [
        'gejala',
    ];
}
