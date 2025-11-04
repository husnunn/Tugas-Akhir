<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterTenkesM extends Model
{
    protected $table = 'master_tenkes';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tenaga_kesehatan',
    ];


    public function p422()
    {
        return $this->hasMany(\App\Models\Keluarga\P4\KgP423M::class, 'id_master_tenkes', 'id');
    }
}
