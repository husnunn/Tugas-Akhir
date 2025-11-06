<?php

namespace App\Models\Individu\P1;

use App\Models\Survey\Survey;

use Illuminate\Database\Eloquent\Model;

class IdvP1M extends Model
{
    protected $table = 'individu_p1';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena id VARCHAR, bukan auto-increment
    protected $keyType = 'string';
    public $timestamps = false; // kolom tgl_buat & tgl_update bukan default Laravel (created_at, updated_at)

    protected $fillable = [
        'id',
        'id_survey',
        'no_kk',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'status_pernikahan',
        'agama',
        'suku_bangsa',
        'warganegara',
        'no_hp',
        'no_wa',
        'url_email_pribadi',
        'url_facebook_pribadi',
        'url_twitter_pribadi',
        'url_instagram_pribadi',
        'id_buat',
        'id_update',
        'tgl_buat',
        'tgl_update',
    ];

    /**
     * Accessor opsional — untuk menampilkan jenis kelamin dalam teks
     */
    public function getJenisKelaminTextAttribute()
    {
        return match ($this->jenis_kelamin) {
            '1' => 'Laki-Laki',
            '2' => 'Perempuan',
            default => '-',
        };
    }

    /**
     * Accessor opsional — untuk menampilkan status pernikahan dalam teks
     */
    public function getStatusPernikahanTextAttribute()
    {
        return match ($this->status_pernikahan) {
            '1' => 'Kawin',
            '2' => 'Tidak Kawin',
            '3' => 'Duda/Janda',
            default => '-',
        };
    }

    /**
     * Accessor opsional — untuk menampilkan agama dalam teks
     */
    public function getAgamaTextAttribute()
    {
        return match ($this->agama) {
            '1' => 'Islam',
            '2' => 'Kristen',
            '3' => 'Katolik',
            '4' => 'Hindu',
            '5' => 'Budha',
            '6' => 'Konghucu',
            default => '-',
        };
    }

    /**
     * Relasi opsional (misal ke tabel survey)
     */
    public function survey()
    {
        return $this->belongsTo(\App\Models\Survey\Survey::class, 'id_survey', 'id');
    }
}
