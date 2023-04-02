<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VapBundle extends Model
{
    use HasFactory;

    protected $table = 'vap_bundles';
    protected $fillable = [
        'bundle',
    ];
}
