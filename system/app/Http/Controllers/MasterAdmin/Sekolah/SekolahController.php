<?php

namespace App\Http\Controllers\MasterAdmin\Sekolah;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class SekolahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $sekolahs = Sekolah::when($search, function ($query, $search) {
            return $query
                ->where('nama_sekolah', 'like', '%' . $search . '%')
                ->orWhere('npsn', 'like', '%' . $search . '%')
                ->orWhere('alamat_lengkap', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('master-admin.data-sekolah.index', compact('sekolahs'));
    }

    public function create()
    {
        return view('master-admin.data-sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:20',
            'kepala_sekolah' => 'required|string|max:255',
            'akreditasi' => 'required|string|in:A,B,C,Belum Terakreditasi',
            'kurikulum' => 'required|string|in:Kurikulum Merdeka,Kurikulum K-13,Kurikulum KTSP,Kurikulum Darurat',
            'alamat_lengkap' => 'required|string|max:255',
            'email_sekolah' => 'required|email|max:255',
            'telepon_sekolah' => 'required|string|max:20',
            'status_sekolah' => 'required|string|in:Negeri,Swasta',
            'kepemilikan_sekolah' => 'required|in:Pemerintah,Yayasan',
            'keaktifan_sekolah' => 'required|string|in:Aktif,Tidak Aktif',
            'tahun_berdiri' => 'required|date',
            'jumlah_pengajar' => 'required|integer|min:0',
            'jumlah_siswa' => 'required|integer|min:0',
            'ruang_kelas' => 'required|integer|min:0',
            'ruang_perpustakaan' => 'required|integer|min:0',
            'ruang_laboratorium' => 'required|integer|min:0',
            'ruang_pimpinan' => 'required|integer|min:0',
            'ruang_guru' => 'required|integer|min:0',
            'ruang_ibadah' => 'required|integer|min:0',
            'ruang_UKS' => 'required|integer|min:0',
            'ruang_toilet' => 'required|integer|min:0',
            'ruang_gudang' => 'required|integer|min:0',
            'ruang_olahraga' => 'required|integer|min:0',
            'ruang_tu' => 'required|integer|min:0',
            'ruang_konseling' => 'required|integer|min:0',
            'logo_sekolah' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'foto_sekolah' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $validateData = $request->only([
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
        ]);

        $targetPath = realpath(base_path('../public/app')) . '/data-sekolah';

        if ($request->hasFile('logo_sekolah')) {
            $logo_sekolah = $request->file('logo_sekolah');
            $logoFilename = 'logo-' .time() . '.' . $logo_sekolah->getClientOriginalExtension();
            $logo_sekolah->move($targetPath, $logoFilename);
            $validateData['logo_sekolah'] = $logoFilename;
        }

        if ($request->hasFile('foto_sekolah')) {
            $foto_sekolah = $request->file('foto_sekolah');
            $fotoFilename = 'foto-' . time() . '.' . $foto_sekolah->getClientOriginalExtension();
            $foto_sekolah->move($targetPath, $fotoFilename);
            $validateData['foto_sekolah'] = $fotoFilename;
        }

        Sekolah::create($validateData);

        return redirect('master-admin/data-sekolah')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $sekolah = Sekolah::findOrFail($id);
        return view('master-admin.data-sekolah.show', compact('sekolah'));
    }

    public function showSekolah()
    {
        $sekolahCount = Sekolah::all();
        return view('dashboard', compact('sekolahCount'));
    }

    public function edit(string $id)
    {
        $sekolah = Sekolah::findOrFail($id);
        return view('master-admin.data-sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, string $id)
    {
        $sekolah = Sekolah::findOrFail($id);

        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string',
            'kepala_sekolah' =>'required|string',
            'akreditasi' => 'required|string|in:A,B,C,Belum Terakreditasi',
            'kurikulum' => 'required|string|in:Kurikulum Merdeka,Kurikulum K-13,Kurikulum KTSP,Kurikulum Darurat',
            'alamat_lengkap' => 'required|string',
            'email_sekolah' => 'required|email|max:255',
            'telepon_sekolah' => 'required|string',
            'status_sekolah' => 'required|string',
            'kepemilikan_sekolah' => 'required|string',
            'keaktifan_sekolah' => 'required|string|in:Aktif,Tidak Aktif',
            'jumlah_pengajar' => 'required|integer',
            'jumlah_siswa' => 'required|integer',
            'tahun_berdiri' => 'required|date',
            'ruang_kelas' => 'required|integer',
            'ruang_perpustakaan' => 'required|integer',
            'ruang_laboratorium' => 'required|integer',
            'ruang_praktik' => 'required|integer',
            'ruang_pimpinan' => 'required|integer',
            'ruang_guru' => 'required|integer',
            'ruang_ibadah' => 'required|integer',
            'ruang_UKS' => 'required|integer',
            'ruang_toilet' => 'required|integer',
            'ruang_gudang' => 'required|integer',
            'ruang_olahraga' => 'required|integer',
            'ruang_tu' => 'required|integer',
            'ruang_konseling' => 'required|integer',
            'logo_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'foto_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $targetPath = realpath(base_path('../public/app')) . '/data-sekolah';

        $validateData = $request->only([
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
        ]);

        if ($request->hasFile('logo_sekolah')) {
            $logo = $request->file('logo_sekolah');
            $logoFilename = 'logo-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move($targetPath, $logoFilename);

            if ($sekolah->logo_sekolah && file_exists($targetPath . '/' . $sekolah->logo_sekolah)) {
                unlink($targetPath . '/' . $sekolah->logo_sekolah);
            }

            $validateData['logo_sekolah'] = $logoFilename;
        }

        if ($request->hasFile('foto_sekolah')) {
            $foto = $request->file('foto_sekolah');
            $fotoFilename = 'foto-' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move($targetPath, $fotoFilename);

            if ($sekolah->foto_sekolah && file_exists($targetPath . '/' . $sekolah->foto_sekolah)) {
                unlink($targetPath . '/' . $sekolah->foto_sekolah);
            }

            $validateData['foto_sekolah'] = $fotoFilename;
        }

        $sekolah->update($validateData);

        return redirect('master-admin/data-sekolah')->with('success', 'Data sekolah berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $targetPath = realpath(base_path('../public')) . '/app/data-sekolah/';

        if ($sekolah->logo_sekolah && file_exists($targetPath . '/' . $sekolah->logo_sekolah)) {
            unlink($targetPath . '/' . $sekolah->logo_sekolah);
        }

        if ($sekolah->foto_sekolah && file_exists($targetPath . '/' . $sekolah->foto_sekolah)) {
            unlink($targetPath . '/' . $sekolah->foto_sekolah);
        }

        $sekolah->delete();

        return redirect()->back()->with('success', 'Data sekolah berhasil dihapus.');
    }
}