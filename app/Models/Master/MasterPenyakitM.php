<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterPenyakitM extends Model
{
    protected $table = 'master_penyakit';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'jenis_penyakit',
    ];

    public function p401()
    {
        return $this->hasMany(\App\Models\Individu\P4\IdvP401M::class, 'id_master_penyakit', 'id');
    }
}
