<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('master-admin')->check() &&
            !auth()->guard('admin')->check() &&
            !auth()->guard('guru')->check() &&
            !auth()->guard('siswa')->check() &&
            !auth()->guard('orang-tua')->check()) {
            
            return redirect('/login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
