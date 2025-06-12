<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // Validasi: minimal 15 kolom harus tersedia
        if (count($row) < 15) {
            return null; // atau log error ke file
        }

        $tanggalLahir = is_numeric($row['tanggal_lahir'])
            ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('d-m-y')
            : $row['tanggal_lahir'];

        return new Guru([
            'username' => $row[1],
            'nip' => $row[2],
            'jenis_kelamin' => $row[3],
            'agama' => $row[4],
            'tempat_lahir' => $row[5],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
            'alamat' => $row[7],
            'no_telepon' => $row[8],
            'email' => $row[9],
            'mata_pelajaran' => $row[10],
            'jabatan' => $row[11],
            'pendidikan_terakhir' => $row[12],
            'tahun_masuk' => $row[13],
            'password' => bcrypt($row[14]),
            'foto_profil' => $row[15],
        ]);
    }
}
