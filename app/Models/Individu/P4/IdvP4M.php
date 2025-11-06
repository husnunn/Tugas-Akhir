<?php

namespace App\Models\Individu\P4;

use Illuminate\Database\Eloquent\Model;
use App\Models\Individu\P1\IdvP1M;
use App\Models\Individu\P4\IdvP401M;
use App\Models\Individu\P4\IdvP402M;

class IdvP4M extends Model
{
    protected $table = 'individu_p4';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_individu_p1',
        'tunanetra',
        'tunarungu',
        'tunawicara',
        'tunadaksa',
        'tunagrahita',
        'tunalaras',
        'cacat_eks_sakitkusta',
        'cacat_ganda',
        'dipasung',
        'id_buat',
        'id_update',
        'tgl_buat',
        'tgl_update',
    ];

    public function individuP1()
    {
        return $this->belongsTo(IdvP1M::class, 'id_individu_p1', 'id');
    }

    // Relasi ke tabel penyakit & kesehatan
    public function penyakit()
    {
        return $this->hasMany(IdvP401M::class, 'id_individu_p4', 'id');
    }

    public function kesehatan()
    {
        return $this->hasMany(IdvP402M::class, 'id_individu_p4', 'id');
    }

    // Helper untuk status (1/2)
    public function getStatusText($value)
    {
        return $value == '1' ? 'Ya' : 'Tidak';
    }
}
