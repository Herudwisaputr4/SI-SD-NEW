<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table='siswas';
    protected $keyType='string';
    public $incrementing=false;

    protected $fillable = [
        'sekolah_id',
        'nisn',
        'nis',
        'nama_siswa',
        'jenis_pendaftaran',
        'jalur_pendaftaran',
        'tanggal_masuk',
        'status',
        'kebutuhan_khusus',
        'email',
        'no_kk',
        'nik',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'desa_kelurahan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'telepon',
        'password',
        'foto_siswa',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string) str::uuid();
        });
    }
    
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}