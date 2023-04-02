<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatInvasif extends Model
{
    use HasFactory;

    protected $table = 'alat_invasif';
    protected $fillable = [
        'nama_alat',
    ];
}
