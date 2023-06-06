<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangHermina extends Model
{
    use HasFactory;

    protected $table = 'cabang_hermina';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;
}
