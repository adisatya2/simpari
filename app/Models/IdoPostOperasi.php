<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdoPostOperasi extends Model
{
    use HasFactory;

    protected $table = 'ido_post_operasi';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function header(): BelongsTo
    {
        return $this->belongsTo(IdoHeader::class, 'id_header', 'id');
    }

    public function data_ruang_perawatan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruang_perawatan', 'kode_ruangan');
    }

    public function data_registrasi(): BelongsTo
    {
        return $this->belongsTo(Registrasirwi::class, 'no_registrasi', 'no_registrasi');
    }

}
