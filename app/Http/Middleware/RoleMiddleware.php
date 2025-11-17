<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil data user
        $user = Auth::user();

        // Cek apakah role user sesuai dengan yang dibutuhkan route
        if ($user->role !== $role) {
            abort(Response::HTTP_FORBIDDEN, 'Akses Ditolak');
        }

        // Lanjutkan ke halaman berikutnya
        return $next($request);
    }
}
