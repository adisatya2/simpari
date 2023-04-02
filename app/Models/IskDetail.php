<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IskDetail extends Model
{
    use HasFactory;

    protected $table = 'isk_detail';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function header(): HasOne
    {
        return $this->hasOne(IskHeader::class, 'id', 'id_header');
    }
}
