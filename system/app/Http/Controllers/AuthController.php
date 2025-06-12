<?php

namespace App\Http\Controllers;

use App\Models\MasterAdmin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login() {
        return view('login');
    }

    public function LoginProses()
    {
        if (auth()->guard('master-admin')->attempt(['username' => request('username'), 'password' => request('password')])) {
            return redirect('master-admin')->with('success', 'Login Berhasil');
        }
        if (auth()->guard('admin')->attempt(['username' => request('username'), 'password' => request('password')])) {
            return redirect('admin')->with('success', 'Login Berhasil');
        }
        if (auth()->guard('guru')->attempt(['username' => request('username'), 'password' => request('password')])) {
            return redirect('guru')->with('success', 'Login Berhasil');
        }
        //if (auth()->guard('orang-tua')->attempt(['username' => request('username'), 'password' => request('password')])) {
            //return redirect('orang-tua')->with('success', 'Login Berhasil');
        //}
        //if (auth()->guard('siswa')->attempt(['nisn' => request('nisn'), 'password' => request('password')])) {
            //return redirect('siswa')->with('success', 'Login Berhasil');
        //}

        return redirect('/login')->with('error', 'Data tidak ditemukan');
    }

    public function Logout() {
        $guards = [
            'master-admin',
            'admin',
            'guru',
            'orang-tua',
            'siswa',
        ];

        foreach ($guards as $guard)
        {
            auth()->guard($guard)->logout();
        }
        return redirect('/login');
    }

    function add(){
        $user = new MasterAdmin;
        $user->id = '255efd2d-f156-41a4-a417-efb2318bd3ba';
        $user->username = 'MasterAdmin';
        $user->email = 'masteradmin@gmail.com';
        $user->password = bcrypt('admin1234');
        $user->foto_profil = 'bebas';
        $user->save();

        return "Berhasil menambahkan Master Admin";
    }

}