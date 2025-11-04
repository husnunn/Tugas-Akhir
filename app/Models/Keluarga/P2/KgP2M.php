<?php

namespace App\Models\Keluarga\P2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Survey\Survey;

class KgP2M extends Model
{
    protected $table = 'kg_p2';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
 
    protected $fillable = [
        'id',
        'id_survey',
        'kode_provinsi',
        'kode_kabupaten',
        'kode_kecamatan',
        'kode_desa',
        'rt',
        'rw',
        'nama_kpl_keluarga',
        'no_kk',
        'alamat',
        'no_hp',
        'telp_rumah',
        'meteran_rumah',
        'no_meteran',
        'daya_meteran_rumah',
        'id_buat',
        'id_update',
        'tgl_buat',
        'tgl_update',
    ];

    /**
     * Relasi ke tabel P3 (Deskripsi Keluarga)
     * Satu lokasi (P2) bisa punya banyak keluarga (P3)
     */
    public function p3()
    {
        return $this->hasMany(\App\Models\Keluarga\P3\KgP3M::class, 'id_kg_p2', 'id');
    }

    /**
     * Scope untuk filter berdasarkan kode wilayah (optional)
     */
    public function scopeWilayah($query, $kodeDesa = null, $kodeKecamatan = null)
    {
        if ($kodeDesa) {
            $query->where('kode_desa', $kodeDesa);
        }
        if ($kodeKecamatan) {
            $query->where('kode_kecamatan', $kodeKecamatan);
        }
        return $query;
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'id_survey');
    }
    
}
