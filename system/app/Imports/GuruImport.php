<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Guru([
            'username' => $row['Username'],
            'nip' => $row['NIP'],
            'jenis_kelamin' => $row['Jenis Kelamin'],
            'agama' => $row['Agama'],
            'tempat_lahir' => $row['Tempat Lahir'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Tanggal Lahir']),
            'alamat' => $row['Alamat'],
            'no_telepon' => $row['No Telepon'],
            'email' => $row['Email'],
            'mata_pelajaran' => $row['Mata Pelajaran'],
            'jabatan' => $row['Jabatan'],
            'pendidikan_terakhir' => $row['Pendidikan Terakhir'],
            'tahun_masuk' => $row['Tahun Masuk'],
            'password' => bcrypt($row['Password']),
            'foto_profil' => $row['Foto Profil'],
        ]);
    }
}
