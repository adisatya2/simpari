<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhlebitisBundle extends Model
{
    use HasFactory;

    protected $table = 'phlebitis_bundles';
    protected $fillable = [
        'bundle',
    ];
}
