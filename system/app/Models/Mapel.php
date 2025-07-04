<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'sekolah_id',
        'kelompok',
        'tingkatan',
        'nama_mapel',
        'guru_id',
        'keterangan',
    ];

    // Relasi ke sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    // Relasi ke guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
