<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PhlebitisDetail extends Model
{
    use HasFactory;

    protected $table = 'phlebitis_detail';
    protected $primaryKey = 'id';
    protected $guarded = '';
    public $timestamps = true;

    public function header(): HasOne
    {
        return $this->hasOne(PhlebitisHeader::class, 'id', 'id_header');
    }
}
