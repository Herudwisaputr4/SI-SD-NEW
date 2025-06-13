<?php

namespace App\Http\Controllers\MasterAdmin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\sekolah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search'); 

        $admins = Admin::with('sekolahs')
        ->when($search, function ($query, $search) {
            $query
                ->where('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('master-admin.data-admin.index', compact('admins'));
    }

    public function create()
    {
        $sekolahs = Sekolah::all();
        return view('master-admin.data-admin.create', compact('sekolahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:225',
            'sekolah_id' => 'required|exists:sekolahs,id',
            'email' => 'required|email|max:225',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|max:225',
            'foto_profil' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $validateData = $request->only([
            'username',
            'sekolah_id',
            'email',
            'phone',
            'foto_profil',
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        $targetPath = realpath(base_path('../public/app')) . '/data-admin';

        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $fotoFilename = 'profil-' . time() . '.' . $foto_profil->getClientOriginalExtension();
            $foto_profil->move($targetPath, $fotoFilename);
            $validateData['foto_profil'] = $fotoFilename;
        }

        Admin::create($validateData);

        return redirect('master-admin/data-admin')->with('success', 'Data Admin berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('master-admin.data-admin.show', compact('admin'));
    }

    public function showAdmin()
    {
        $adminCount = Admin::all();
        return view('dashboard', compact('adminCount'));
    }

    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $sekolahs = sekolah::all();
        return view('master-admin.data-admin.edit', compact('admin','sekolahs'));
    }

    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'username'      => 'required|string|max:255',
            'sekolah_id'    => 'required|exists:sekolahs,id',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'password'      => 'nullable|string',
            'foto_profil'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $targetPath = realpath(base_path('../public/app')) . '/data-admin';

        $validateData = $request->only([
            'username',
            'sekolah_id',
            'email',
            'phone',
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        if ($request->hasFile('foto_profil')) {
            $foto = $request->file('foto_profil');
            $fotoFilename = 'foto-' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move($targetPath, $fotoFilename);

            if ($admin->foto_profil && file_exists($targetPath . '/' . $admin->foto_profilh)) {
                unlink($targetPath . '/' . $admin->foto_profil);
            }

            $validateData['foto_profil'] = $fotoFilename;
        }

        $admin->update($validateData);

        return redirect('master-admin/data-admin')->with('success', 'Data admin berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $targetPath = realpath(base_path('../public')) . '/app/data-admin/';

        if ($admin->foto_profil && file_exists($targetPath . '/' . $admin->foto_profil)) {
            unlink($targetPath . '/' . $admin->foto_profil);
        }

        $admin->delete();

        return redirect()->back()->with('success', 'Data admin berhasil dihapus.');
    }
}