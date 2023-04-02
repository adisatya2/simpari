<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiCatheter extends Model
{
    use HasFactory;
    protected $table = 'lokasi_catheter';
    protected $fillable = [
        'lokasi',
        'lokasi2',
    ];
}
