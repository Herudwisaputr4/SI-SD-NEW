<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuruExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;

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
            'status'              => 'required|in:Aktif, Tidak Aktif',
            'no_telepon'          => 'required|numeric',
            'email'               => 'required|email|unique:gurus,email',
            'jabatan'             => 'required|in:Guru Produktif,Waka Kurikulum,Waka Kesiswaan,Sarpras,Bimbingan Konseling,Kepala Sekolah',
            'pendidikan_terakhir' => 'required|in:Diploma,Sarjana,Megister,Doktor',
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue;

            if (!is_numeric($row[1])) {
                return redirect()->back()->with('error', 'NIP harus berupa angka pada baris ' . ($index + 1));
            }

            if (!is_numeric($row[9])) {
                return redirect()->back()->with('error', 'No telepon harus berupa angka pada baris ' . ($index + 1));
            }

            if (!filter_var($row[10], FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', 'Email tidak valid pada baris ' . ($index + 1));
            }

            $serialDate = (int)$row[5];
            $tanggalLahir = date('Y-m-d', strtotime('1899-12-30 + ' . $serialDate . ' days'));

            $guru = Guru::create([
                'username'            => $row[0],
                'nip'                 => $row[1],
                'jenis_kelamin'       => $row[2] == 'Laki-Laki' ? 'Laki-Laki' : 'Perempuan',
                'agama'               => in_array($row[3], ['Islam', 'Kristen', 'Katolik', 'Buddha', 'Hindu', 'Konghuchu']) ? $row[3] : 'Lainnya',
                'tempat_lahir'        => $row[4],
                'tanggal_lahir'       => $tanggalLahir,
                'alamat'              => $row[6],
                'status'              => $row[7],
                'no_telepon'          => $row[8],
                'email'               => $row[9],
                'jabatan'             => in_array($row[10], ['required|in:Guru Produktif, Waka Kurikulum, Waka Kesiswaan, Sarpras, Bimbingan Konseling, Kepala Sekolah']) ? $row[10] : 'lainnya',
                'pendidikan_terakhir' => in_array($row[11], ['Diploma', 'Sarjana', 'Megister', 'Doktor']) ? $row[11] : 'Lainnya',
                'tahun_masuk'         => $row[12],
                'password'            => bcrypt($row[13]),
                'foto_profil'         => $row[14],
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
            'status'              => 'required|in:Aktif, Tidak Aktif',
            'no_telepon'          => 'required|numeric',
            'email'               => 'required|email|string:gurus,email,' . $guru->id,
            'jabatan'             => 'required|in:Guru Produktif,Waka Kurikulum,Waka Kesiswaan,Sarpras,Bimbingan Konseling,Kepala Sekolah',
            'pendidikan_terakhir' => 'required|in:Diploma,Sarjana,Megister,Doktor',
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