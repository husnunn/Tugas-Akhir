<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterApstM extends Model
{
        protected $table = 'master_akses_sarpras';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_akses',
    ];


    public function p421()
    {
        return $this->hasMany(\App\Models\Keluarga\P4\KgP424M::class, 'id_master_akses_sarpras','id');
    }
}
