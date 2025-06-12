<?php

namespace App\Http\Controllers\Admin\TahunAjaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class TahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $admin = Auth::guard('admin')->user(); // Ambil admin yang login

        $tahun_ajarans = TahunAjaran::where('sekolah_id', $admin->sekolah_id) // Filter berdasarkan sekolah
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                    $q->where('', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $search . '%');
                });
        })
        ->paginate(10)->appends(['search' => $search]);

        return view('admin.tahun-ajaran.index', compact('tahun_ajarans', 'search'));
    }

    public function create()
    {
        return view('admin.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolahs,id',
            'tahun_ajar' => 'required|string|max:255',
            'deskripsi' => 'required|in:Semester Genap,Semester Ganjil',
            'status' => 'required|in:aktif,tidak aktif',
            'dokumen' => 'required|file|mimes:pdf|max:4096', // max 4MB
        ]);

        $validateData = $request->only([
            'sekolah_id',
            'tahun_ajar',
            'deskripsi',
            'status',
            'dokumen',
        ]);

        $targetPath = realpath(base_path('../public/app')) . '/data-tahun-ajaran';

        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $dokumenFilename = 'dokumen-' . time() . '.' . $dokumen->getClientOriginalExtension();
            $dokumen->move($targetPath, $dokumenFilename);
            $validateData['dokumen'] = $dokumenFilename;
        }

        TahunAjaran::create($validateData);

        return redirect('admin/tahun-ajaran')->with('success', 'Data Tahun Ajaran berhasil disimpan.');
    }

    public function show(string $id)
    {
        $tahunajaran = TahunAjaran::findOrFail($id);
        return view('admin.tahun-ajaran.show', compact('tahunajaran'));
    }

    public function edit(string $id)
    {
        $tahunajaran = TahunAjaran::findOrFail($id);
        return view('admin.tahun-ajaran.edit', compact('tahunajaran'));
    }

    public function update(Request $request, string $id)
    {
        $tahunajaran = TahunAjaran::findOrFail($id);

        $request->validate([
            'tahun_ajar' => 'required|string|max:255',
            'deskripsi'  => 'required|in:Semester Genap,Semester Ganjil',
            'status'     => 'required|in:Aktif,Tidak Aktif',
            'dokumen'    => 'nullable|file|mimes:pdf,doc,docx|max:4096', // Opsional
        ]);

        $targetPath = public_path('uploads/dokumen');

        $validateData = $request->only([
            'tahun_ajar',
            'deskripsi',
            'status',
        ]);

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = 'dokumen-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($targetPath, $filename);

            // Hapus dokumen lama jika ada
            if ($tahunajaran->dokumen && file_exists($targetPath . '/' . $tahunajaran->dokumen)) {
                unlink($targetPath . '/' . $tahunajaran->dokumen);
            }

            $validateData['dokumen'] = $filename;
        }

        $tahunajaran->update($validateData);

        return redirect('admin/tahun-ajaran')->with('success', 'Data tahun ajaran berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $tahunajaran = TahunAjaran::findOrFail($id);
        $targetPath = realpath(base_path('../public')) . '/app/data-tahun-ajaran/';

        if ($tahunajaran->dokumen && file_exists($targetPath . '/' . $tahunajaran->dokumen)) {
            unlink($targetPath . '/' . $tahunajaran->dokumen);
        }

        $tahunajaran->delete();

        return redirect()->back()->with('success', 'Data tahun ajaran berhasil dihapus.');
    }

}
