<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienDirawat extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    public $keyType = 'string';
    protected $primaryKey = 'no_kamar';
    protected $guarded = '';
}
