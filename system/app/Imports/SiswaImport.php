<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([
            'nisn' => $row['NISN'],
            'nis' => $row['NIS'],
            'nama_siswa' => $row['Nama Siswa'],
            'jenis_pendaftaran' => $row['Jenis Pendaftaran'],
            'jalur_pendaftaran' => $row['Jalur Pendaftaran'],
            'tanggal_masuk' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Tanggal Masuk']),
            'status' => $row['Status'],
            'kebutuhan_khusus' => $row['Kebutuhan Khusus'],
            'email' => $row['Email'],
            'no_kk' => $row['Nomor Kartu Keluarga'],
            'nik' => $row['NIK'],
            'jenis_kelamin' => $row['Jenis Kelamin'],
            'agama' => $row['Agama'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Tanggal Lahir']),
            'tempat_lahir' => $row['Tempat Lahir'],
            'alamat' => $row['Alamat'],
            'rt' => $row['RT'],
            'rw' => $row['RW'],
            'dusun' => $row['Dusun'],
            'desa_kelurahan' => $row['Desa Kelurahan'],
            'provinsi' => $row['Provinsi'],
            'kabupaten' => $row['Kabupaten'],
            'kecamatan' => $row['Kecamatan'],
            'telepon' => $row['Telepon'],
            'password' => bcrypt($row['Password']),
            'foto_siswa' => null,
        ]);
    }
}