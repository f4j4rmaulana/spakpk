<?php

namespace App\Http\Controllers\Eksternal;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use App\Models\UsulanPelatihan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): View {
        $titles = 'Eksternal Dashboard';
        $yearNow = Carbon::now()->year;
        $tupAll = UsulanPelatihan::whereYear('created_at', $yearNow)->get()->count();
        $tuuAll = UsulanUjikom::whereYear('created_at', $yearNow)->get()->count();
        $tupAllVal = UsulanPelatihan::where('status', 'Validasi')
            ->whereYear('created_at', $yearNow)
            ->get()
            ->count();
        $tuuAllVal = UsulanUjikom::where('status', 'Validasi')
            ->whereYear('created_at', $yearNow)
            ->get()
            ->count();
        $tupByUk = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
            ->where('status', 'Validasi')
            ->whereYear('created_at', $yearNow)
            ->get()
            ->groupBy(function ($item) {
                return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->sortDesc();
        $tuuByUk = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')
            ->where('status', 'Validasi')
            ->whereYear('created_at', $yearNow)
            ->get()
            ->groupBy(function ($item) {
                return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->sortDesc();

        // Ambil tanggal awal dan akhir berdasarkan saat ini
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Ambil jumlah data untuk bulan lalu berdasarkan saat ini
        $tupLastMonth = UsulanPelatihan::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $tuuLastMonth = UsulanUjikom::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Ambil tanggal awal dan akhir berdasarkan bulan saat ini
        $startOfThisMonth = Carbon::now()->startOfMonth();
        $endOfThisMonth = Carbon::now()->endOfMonth();

        // Mengambil jumlah data untuk bulan ini
        $tupThisMonth = UsulanPelatihan::whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])->count();
        $tuuThisMonth = UsulanUjikom::whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])->count();

        // Hitung perbedaan antara bulan ini dan bulan lalu
        $tupDiff = $tupThisMonth - $tupLastMonth;
        $tuuDiff = $tuuThisMonth - $tuuLastMonth;

        return view('eksternal.dashboard.index', compact('titles', 'yearNow', 'tupAll', 'tuuAll', 'tupAllVal', 'tupDiff', 'tuuDiff', 'tuuAllVal', 'tupByUk', 'tuuByUk' ));
    }
}
