<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Exports\GuruExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $query = Guru::where('sekolah_id', $admin->sekolah_id);

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%')
                ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        $gurus = $query->paginate(10); // sesuaikan jumlah per halaman

        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sekolah_id'          => 'required|exists:sekolahs,id',  
            'username'            => 'required|string|max:255',
            'nip'                 => 'required|numeric|unique:gurus,nip',
            'jenis_kelamin'       => 'required|in:Laki-Laki,Perempuan',
            'agama'               => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghuchu',
            'tempat_lahir'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'alamat'              => 'required|string',
            'status'              => 'required|in:Aktif,Tidak Aktif',
            'no_telepon'          => 'required|numeric',
            'email'               => 'required|email|unique:gurus,email',
            'jabatan'             => 'required|in:Guru Produktif,Waka Kurikulum,Waka Kesiswaan,Sarpras,Bimbingan Konseling,Kepala Sekolah',
            'pendidikan_terakhir' => 'required|in:Diploma,Sarjana,Magister,Doktor',
            'tahun_masuk'         => 'required|integer',
            'password'            => 'required|string|min:8',
            'foto_profil'         => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $validateData = $request->only([
            'sekolah_id',
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
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        $targetPath = realpath(base_path('../public/app')) . '/data-guru';

        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $fotoFilename = 'profil-' . time() . '.' . $foto_profil->getClientOriginalExtension();
            $foto_profil->move($targetPath, $fotoFilename);
            $validateData['foto_profil'] = $fotoFilename;
        }

        Guru::create($validateData);

        return redirect('admin/guru')->with('success', 'Data guru berhasil ditambahkan.');
    }

    private function formatTanggal($value) {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue;
            $data = array_slice($row, 1);

             $jenis_kelamin = null;
            // Validasi jenis kelamin
                        if (isset($row[11])) {
                $value = strtolower(trim($row[11]));
                if ($value === 'laki-laki' || $value === 'l') {
                    $jenis_kelamin = 'Laki-Laki';
                } elseif ($value === 'perempuan' || $value === 'p') {
                    $jenis_kelamin = 'Perempuan';
                }
            }
            
            if (is_null($jenis_kelamin)) {
                continue;
            }

            $existing = Guru::where('nisn', $row[0])->first();
            if ($existing) {
                continue;
            }

            $guru = Guru::create([
                'sekolah_id' => auth('admin')->user()->sekolah_id,
                'username' => $row[0],
                'nip' => $row[1],
                'nama_guru' => $row[2],
                'jenis_kelamin' => in_array($row[3], ['Laki-Laki', 'Perempuan']) ? $row[3] : 'Laki-Laki',
                'agama' => in_array($row[4], ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']) ? $row[4] : 'Islam',
                'tempat_lahir' => $row[5],
                'tanggal_lahir' => $this->formatTanggal($row[6]),
                'alamat' => $row[7],
                'telepon' => $row[8],
                'email' => $row[9],
                'status' => $row[10] == 'Aktif' ? 'Aktif' : 'Tidak Aktif',
                'jabatan' => in_array($row[11], [ 'Guru Produktif','Waka Kurikulum','Waka Kesiswaan','Sarpras','Bimbingan Konseling','Kepala Sekolah']) ? $row[11] : 'Guru Produktif',
                'pendidikan_terakhir' => in_array($row[12], ['Diploma','Sarjana','Magister','Doktor']) ? $row[12] : 'Sarjana',
                'tahun_masuk' => is_numeric($row[13]) ? $row[13] : now()->year,
                'password' => isset($row[14]) ? bcrypt($row[14]) : null,
                'foto_profil' => isset($row[15]) && !empty($row[15]) ? $row[15] : 'belum ada foto',
            ]);

        }

        return redirect('admin/guru')->with('success', 'Data guru berhasil diimpor.');
    }

    public function export()
    {
        return Excel::download(new GuruExport, 'guru.xlsx');
    }

    public function show(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.show', compact('guru'));
    }

    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);
        $request->validate([
            'username'            => 'required|string|max:255',
            'nip'                 => 'required|numeric|unique:gurus,nip,' . $guru->id,
            'jenis_kelamin'       => 'required|in:Laki-Laki,Perempuan',
            'agama'               => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghuchu',
            'tempat_lahir'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'alamat'              => 'required|string',
            'status'              => 'required|in:Aktif,Tidak Aktif',
            'no_telepon'          => 'required|numeric',
            'email'               => 'required|email|string:gurus,email,' . $guru->id,
            'jabatan'             => 'required|in:Guru Produktif,Waka Kurikulum,Waka Kesiswaan,Sarpras,Bimbingan Konseling,Kepala Sekolah',
            'pendidikan_terakhir' => 'required|in:Diploma,Sarjana,Magister,Doktor',
            'tahun_masuk'         => 'required|integer',
            'password'            => 'nullable|string|min:8',
            'foto_profil'         => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $targetPath = realpath(base_path('../public/app')) . '/data-guru';

        $validateData = $request->only([
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
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }
        if ($request->hasFile('foto_profil')) {
            $foto = $request->file('foto_profil');
            $fotoFilename = 'foto-' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move($targetPath, $fotoFilename);
                if ($guru->foto_profil && file_exists($targetPath . '/' . $guru->foto_profil)) {
                    unlink($targetPath . '/' . $guru->foto_profil);
                }

            $validateData['foto_profil'] = $fotoFilename;
        }


        $guru->update($validateData);

        return redirect('admin/guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);
        $targetPath = realpath(base_path('../public')) . '/app/data-guru/';

        if ($guru->foto_profil && file_exists($targetPath . '/' . $guru->foto_profil)) {
            unlink($targetPath . '/' . $guru->foto_profil);
        }

        $guru->delete();

        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
    }
}