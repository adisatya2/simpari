<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';
    protected $primaryKey = 'id_setting';
    protected $guarded = '';
    protected $fillable = [
        'nama_rumahsakit',
        'kode_rumahsakit',
        'alias_rumahsakit',
        'alamat',
        'telepon',
        'path_logo_square',
        'path_logo_login',
    ];
}
