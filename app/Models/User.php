<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // yang benar
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Jabatan\Jabatan;

class User extends Authenticatable // Ubah ini!
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'id',
        'nama',
        'username',
        'hp',
        'id_jabatan',
        'status',
        'password',
        'foto',
        'id_buat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id'); 
    }
}
