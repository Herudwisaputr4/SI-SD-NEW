<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelass'; // ← tambahkan ini

    protected $fillable = [
        'tingkatan',
        'nama_kelas',
        'sekolah_id',
        'guru_id',
        'tahun_ajaran_id',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

}
