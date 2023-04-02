<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    public $keyType = 'string';
    protected $primaryKey = 'id_dokter';
    protected $guarded = '';
}
