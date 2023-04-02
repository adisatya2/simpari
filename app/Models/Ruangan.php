<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    public $keyType = 'string';
    protected $primaryKey = 'kode_ruangan';
    protected $guarded = '';

    public function bed_list(): HasMany
    {
        return $this->hasMany(Bed::class, 'kode_ruangan', 'kode_ruangan');
    }
}
