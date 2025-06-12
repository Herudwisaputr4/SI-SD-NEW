<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\sekolah;
use App\Models\MasterAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalAdmin = Admin::count();
        $totalSekolah = sekolah::count();
        return view('master-admin.dashboard', compact('totalAdmin', 'totalSekolah'));
    }

    public function editProfile()
    {
        // Tampilkan form edit profile
        $masterAdmin = Auth::guard('master-admin')->user();
        return view('master-admin.profile', compact('masterAdmin'));
    }

    public function update(Request $request, $id)
    {
        $masterAdmin = MasterAdmin::findOrFail($id);

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:master_admins,email,' . $id,
            'password' => 'nullable|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validateData= [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ];

        $targetPath = realpath(base_path('../public/app')) . '/data-master-admin';

        // Jika password diisi, update
        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        // Jika foto profil diunggah
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time()  . '.' . $file->getClientOriginalExtension();
            $file->move($targetPath, $filename);
           
            $validateData['foto_profil'] = $filename;
        }

        // Simpan perubahan
        $masterAdmin->update($validateData);

        return redirect('/master-admin')->with('success', 'Profil berhasil diperbarui.');
    }
}
