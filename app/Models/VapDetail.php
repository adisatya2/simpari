<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VapDetail extends Model
{
    use HasFactory;

    protected $table = 'vap_detail';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function header(): HasOne
    {
        return $this->hasOne(VapHeader::class, 'id', 'id_header');
    }
}
