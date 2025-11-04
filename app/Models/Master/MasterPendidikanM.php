<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterPendidikanM extends Model
{
    protected $table = 'master_pendidikan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'jenjang_pendidikan',
    ];


    public function p421()
    {
        return $this->hasMany(\App\Models\Keluarga\P4\KgP421M::class, 'id_master_pendidikan','id');
    }
}
