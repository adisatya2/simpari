<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IadpBundle extends Model
{
    use HasFactory;

    protected $table = 'iadp_bundles';
    protected $fillable = [
        'bundle',
    ];
}
