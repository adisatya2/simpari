<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasienPulang extends Model
{
    use HasFactory;

    protected $table = 'pasien_pulang';
    public $keyType = 'string';
    protected $primaryKey = 'id';
    protected $guarded = '';

    public function ruangan_bed(): HasOne
    {
        return $this->hasOne(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }

    public function kelas_bed(): HasOne
    {
        return $this->hasOne(Kelas::class, 'id', 'id_kelas');
    }
    public function dpjp(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function data_pasien(): HasOne
    {
        return $this->hasOne(MasterPasien::class, 'mrn', 'mrn');
    }
    public function data_registrasi(): HasOne
    {
        return $this->hasOne(Registrasirwi::class, 'no_registrasi', 'no_registrasi');
    }
}
