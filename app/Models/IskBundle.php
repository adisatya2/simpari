<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IskBundle extends Model
{
    use HasFactory;

    protected $table = 'isk_bundles';
    protected $fillable = [
        'bundle',
    ];
}
