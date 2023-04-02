<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profilaksis extends Model
{
    use HasFactory;

    protected $table = 'profilaksis';
    protected $fillable = [
        'nama_obat',
        'golongan',
    ];
}
