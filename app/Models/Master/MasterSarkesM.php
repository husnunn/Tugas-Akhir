<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterSarkesM extends Model
{
    protected $table = 'master_sarkes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_sarkes',
    ];

    public function p402()
    {
        return $this->hasMany(\App\Models\Individu\P4\IdvP402M::class, 'id_master_sarkes', 'id');
    }
}
