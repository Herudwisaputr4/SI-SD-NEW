<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $expectedColumns = [
            'nisn', 'nis', 'nama_siswa', 'jenis_pendaftaran', 'jalur_pendaftaran',
            'tanggal_masuk', 'status', 'kebutuhan_khusus', 'email', 'no_kk', 'nik',
            'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'alamat',
            'rt', 'rw', 'dusun', 'desa_kelurahan', 'provinsi', 'kabupaten',
            'kecamatan', 'telepon', 'password', 'foto_siswa'
        ];

        foreach ($expectedColumns as $column) {
            if (!isset($row[$column])) {
                // Jika kolom tidak ada, lewati baris ini
                return null;
            }
        }

        // Konversi tanggal dari serial Excel ke format Y-m-d
        $tanggalMasuk = is_numeric($row['tanggal_masuk'])
            ? Date::excelToDateTimeObject($row['tanggal_masuk'])->format('d-m-y')
            : $row['tanggal_masuk'];
        $tanggalLahir = is_numeric($row['tanggal_lahir'])
            ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('d-m-y')
            : $row['tanggal_lahir'];
            
        return new Siswa([
        'nisn' => $row['nisn'],
        'nis' => $row['nis'],
        'nama_siswa' => $row['nama_siswa'],
        'jenis_pendaftaran' => $row['jenis_pendaftaran'],
        'jalur_pendaftaran' => $row['jalur_pendaftaran'],
        'tanggal_masuk' => is_numeric($row['tanggal_masuk']) ? Date::excelToDateTimeObject($row['tanggal_masuk'])->format('y-m-d') : $row['tanggal_masuk'],
        'status' => $row['status'],
        'kebutuhan_khusus' => $row['kebutuhan_khusus'],
        'email' => $row['email'],
        'no_kk' => $row['no_kk'],
        'nik' => $row['nik'],
        'jenis_kelamin' => $row['jenis_kelamin'],
        'agama' => $row['agama'],
        'tempat_lahir' => $row['tempat_lahir'],
        'tanggal_lahir' => is_numeric($row['tanggal_lahir']) ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('y-m-d') : $row['tanggal_lahir'],
        'alamat' => $row['alamat'],
        'rt' => $row['rt'],
        'rw' => $row['rw'],
        'dusun' => $row['dusun'],
        'desa_kelurahan' => $row['desa_kelurahan'],
        'provinsi' => $row['provinsi'],
        'kabupaten' => $row['kabupaten'],
        'kecamatan' => $row['kecamatan'],
        'telepon' => $row['telepon'],
        'password' => $row['password'],
        'foto_siswa' => $row['foto_siswa'],
        ]);
    }
}