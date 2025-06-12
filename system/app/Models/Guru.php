<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Guru extends Authenticatable
{
    protected $table = 'gurus';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'sekolah_id',
        'username',
        'nip',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'status',
        'no_telepon',
        'email',
        'jabatan',
        'pendidikan_terakhir',
        'tahun_masuk',
        'password',
        'foto_profil',
    ]; 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string) str::uuid();
        });
    }

    // Satu guru bisa menjadi wali untuk banyak kelas
    public function sekolahs()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    public function kelass()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }
}