<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function editProfile()
    {
        // Tampilkan form edit profile
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone' => 'required|string|max:225',
            'asal_sekolah' => 'required|string|max:225',
            'password' => 'nullable|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validateData= [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'asal_sekolah' => $request->input('asal_sekolah'),
        ];

        $targetPath = realpath(base_path('../public/app')) . '/data-admin';

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
        $admin->update($validateData);

        return redirect('/admin')->with('success', 'Profil berhasil diperbarui.');
    }
}
