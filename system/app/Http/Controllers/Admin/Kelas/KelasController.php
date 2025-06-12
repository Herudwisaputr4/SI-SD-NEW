<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $search = request()->query('search');

        $kelass = Kelas::with(['waliKelas', 'tahunAjaran'])
            ->where('sekolah_id', Auth::guard('admin')->user()->sekolah_id)
            ->when(request('search'), function($query) {
                $query->where('nama_kelas', 'like', '%' . request('search') . '%');
            })
            ->paginate(10);

        return view('admin.kelas.index', compact('kelass'));
    }

    public function create()
    {
        $sekolahId = Auth::guard('admin')->user()->sekolah_id;
        $gurus = Guru::where('sekolah_id', $sekolahId)->get();
        $tahunAjarans = TahunAjaran::where('sekolah_id', $sekolahId)->get();

        return view('admin.kelas.create', compact('gurus', 'tahunAjarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkatan' => 'required|numeric',
            'nama_kelas' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $validateData = $request->only([
            'tingkatan',
            'nama_kelas',
            'guru_id',
            'tahun_ajaran_id',
        ]);

        // Tambahkan sekolah_id dari admin yang login
        $validateData['sekolah_id'] = Auth::guard('admin')->user()->sekolah_id;

        Kelas::create($validateData);

        return redirect('admin/kelas')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kelas = Kelas::with(['waliKelas', 'tahunAjaran'])->findOrFail($id);
        return view('admin.kelas.show', compact('kelas')); 
    }

    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();
        $tahunAjarans = TahunAjaran::orderByDesc('tahun_ajar')->get();
        return view('admin.kelas.edit', compact('kelas', 'gurus', 'tahunAjarans')); 
    }

    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'tingkatan' => 'required|in:1,2,3,4,5,6',
            'nama_kelas' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $validateData = $request->only([
            'tingkatan',
            'nama_kelas',
            'guru_id',
            'tahun_ajaran_id',
        ]);

        // Ambil sekolah_id dari admin yang login
        $validateData['sekolah_id'] = Auth::guard('admin')->user()->sekolah_id;

        $kelas->update($validateData);
        return redirect('admin/kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('success', 'Data kelas berhasil dihapus.');
    }
}
