<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhlebitisHeader extends Model
{
    use HasFactory;

    protected $table = 'phlebitis_header';
    public $keyType = 'string';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function detail_list(): HasMany
    {
        return $this->hasMany(PhlebitisDetail::class, 'id_header', 'id')->orderBy('observasi_ke');
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
