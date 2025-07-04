<?php

namespace App\Http\Controllers\Admin\Mapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mapel;
use App\Models\Guru;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $tingkatan = $request->query('tingkatan');
        $admin = Auth::guard('admin')->user();

        $mapels = Mapel::where('sekolah_id', $admin->sekolah_id)
            ->when($tingkatan, function ($query, $tingkatan) {
                return $query->where('tingkatan', $tingkatan);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_mapel', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('kelompok', 'like', '%' . $search . '%');
                });
            })
            ->with('guru')
            ->paginate(10)
            ->appends(['search' => $search, 'tingkatan' => $tingkatan]);

        return view('admin.mapel.index', compact('mapels', 'search', 'tingkatan'));
    }

    public function create()
    {
        $admin = Auth::guard('admin')->user(); // Ambil admin yang login
        $gurus = Guru::where('sekolah_id', $admin->sekolah_id)->get(); // Ambil guru di sekolah itu

        return view('admin.mapel.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok'   => 'required|in:wajib,pilihan',
            'tingkatan'  => 'required|in:1,2,3,4,5,6',
            'nama_mapel' => 'required|string|max:255',
            'guru_id'    => 'required|exists:gurus,id',
            'keterangan' => 'required|string|max:255',
        ]);

        $validateData = $request->only([
            'kelompok',
            'tingkatan',
            'nama_mapel',
            'guru_id',
            'keterangan',
        ]);

        $validateData['sekolah_id'] = Auth::user()->sekolah_id;

        Mapel::create($validateData);

        return redirect('admin/mapel')->with('success', 'Data Mapel berhasil disimpan.');
    }

    public function show(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.mapel.show', compact('mapel'));
    }

    public function edit(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        $admin = Auth::guard('admin')->user();
        $gurus = Guru::where('sekolah_id', $admin->sekolah_id)->get();
        return view('admin.mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, string $id)
    {
        $mapel = Mapel::findOrFail($id);

        $request->validate([
            'kelompok'   => 'required|in:wajib,pilihan',
            'tingkatan'  => 'required|in:1,2,3,4,5,6',
            'nama_mapel' => 'required|string|max:255',
            'guru_id'    => 'required|exists:gurus,id',
            'keterangan' => 'required|string|max:255',
        ]);

        $validateData = $request->only([
            'nama_mapel',
            'kelompok',
            'tingkatan',
            'nama_mapel',
            'guru_id',
            'keterangan',
        ]);

        $mapel->update($validateData);

        return redirect('admin/mapel')->with('success', 'Data Mapel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->back()->with('success', 'Data Mapel berhasil dihapus.');
    }
}
