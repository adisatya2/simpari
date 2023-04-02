<?php

namespace App\Models;

use App\Models\Ruangan;
use App\Models\IadpDetail;
use App\Models\Registrasirwi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IadpHeader extends Model
{
    use HasFactory;

    protected $table = 'iadp_header';
    public $keyType = 'string';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function detail_list(): HasMany
    {
        return $this->hasMany(IadpDetail::class, 'id_header', 'id');
    }

    public function data_registrasi(): BelongsTo
    {
        return $this->belongsTo(Registrasirwi::class, 'no_registrasi', 'no_registrasi');
    }

    public function data_ruang_pemasangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruang_pemasangan', 'kode_ruangan');
    }

    public function data_ruang_perawatan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruang_perawatan', 'kode_ruangan');
    }
}
