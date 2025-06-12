<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuruExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Guru::all();
    }

     public function headings(): array
    {
        return [
             'username',
            'nip',
            'jenis_kelamin',
            'agama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'no_telepon',
            'email',
            'jabatan',
            'pendidikan_terakhir',
            'tahun_masuk',
            'password',
            'foto_profil',
        ];
    }
}