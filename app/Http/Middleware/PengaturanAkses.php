<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengaturanAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $settingKey): Response
    {
        // Mendapatkan status akses dari tabel pengaturan
        $settings = Pengaturan::pluck('value', 'key')->toArray();

        // Memeriksa status akses Usulan Pelatihan
        if ($settings[$settingKey] === 'Open') {
            return $next($request); // Izinkan akses jika statusnya "Open"
        }

        // Jika statusnya "Close", kembalikan response tertentu
        return redirect()->back();
    }
}
