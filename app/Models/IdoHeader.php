<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdoHeader extends Model
{
    use HasFactory;

    protected $table = 'ido_header';
    public $keyType = 'string';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function data_registrasi(): BelongsTo
    {
        return $this->belongsTo(Registrasirwi::class, 'no_registrasi', 'no_registrasi');
    }

    public function data_ruang_perawatan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruang_perawatan', 'kode_ruangan');
    }
}
