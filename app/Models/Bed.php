<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bed extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    public $keyType = 'string';
    protected $primaryKey = 'no_kamar';
    protected $guarded = '';

    public function ruangan_bed(): HasOne
    {
        return $this->hasOne(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }

    public function kelas_bed(): HasOne
    {
        return $this->hasOne(Kelas::class, 'id', 'id_kelas');
    }

    // public function dpjp(): HasOne
    // {
    //     return $this->hasOne(Dokter::class, 'id_dokter', 'id_dokter');
    // }

    /**
     * Get the user that owns the Bed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dpjp(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get the dataPasien associated with the Bed
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data_pasien(): HasOne
    {
        return $this->hasOne(MasterPasien::class, 'mrn', 'mrn');
    }
    public function data_registrasi(): HasOne
    {
        return $this->hasOne(Registrasirwi::class, 'no_registrasi', 'no_registrasi');
    }
}
