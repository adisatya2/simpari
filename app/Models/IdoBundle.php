<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdoBundle extends Model
{
    use HasFactory;

    protected $table = 'ido_bundles';
    protected $fillable = [
        'waktu',
        'bundle',
    ];
}
