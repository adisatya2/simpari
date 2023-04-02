<?php

namespace App\Models;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registrasirwi extends Model
{
    use HasFactory;

    protected $table = 'registrasirwi';
    public $keyType = 'string';
    protected $primaryKey = 'no_registrasi';
    protected $guarded = '';

    /**
     * Get the user that owns the Bed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dpjp(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function data_kamar(): BelongsTo
    {
        return $this->belongsTo(Bed::class, 'no_kamar', 'no_kamar');
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
}
