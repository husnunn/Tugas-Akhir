<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterPenghasilanM extends Model
{
    protected $table = 'master_penghasilan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_komoditas',
    ];
    public function p421()
    {
        return $this->hasMany(\App\Models\Individu\P2\IdvP204M::class, 'id_master_penghasilan', 'id');
    }
}
