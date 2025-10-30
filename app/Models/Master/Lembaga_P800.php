<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Lembaga_P800 extends Model
{
    protected $table = 'master_lembaga_p800';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_lembaga',
        'id_buat',
        'id_update',
        'tgl_buat',
        'tgl_update',
    ];
}
