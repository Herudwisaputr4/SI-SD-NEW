<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolahs';
    public $incrementing = false;
    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'kepala_sekolah',
        'akreditasi',
        'kurikulum',
        'alamat_lengkap',
        'email_sekolah',
        'telepon_sekolah',
        'status_sekolah',
        'kepemilikan_sekolah',
        'keaktifan_sekolah',
        'jumlah_pengajar',
        'jumlah_siswa',
        'tahun_berdiri',
        'ruang_kelas',
        'ruang_perpustakaan',
        'ruang_laboratorium',
        'ruang_praktik',
        'ruang_pimpinan',
        'ruang_guru',
        'ruang_ibadah',
        'ruang_UKS',
        'ruang_toilet',
        'ruang_gudang',
        'ruang_olahraga',
        'ruang_tu',
        'ruang_konseling',
        'logo_sekolah',
        'foto_sekolah',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'sekolah_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id');
    }

    public function tahunAjaran()
    {
        return $this->hasMany(TahunAjaran::class, 'id');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'sekolah_id');
    }
}
