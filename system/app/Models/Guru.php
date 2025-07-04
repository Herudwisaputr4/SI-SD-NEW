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

    //  Relasi: Guru milik satu sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    //  Relasi: Guru mengajar banyak mapel
    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'guru_id');
    }

    //  Relasi: Guru bisa menjadi wali dari banyak kelas
    public function kelass()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }
}