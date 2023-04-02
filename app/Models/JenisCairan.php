<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCairan extends Model
{
    use HasFactory;

    protected $table = 'jenis_cairan';
    protected $fillable = [
        'nama_cairan',
    ];
}
