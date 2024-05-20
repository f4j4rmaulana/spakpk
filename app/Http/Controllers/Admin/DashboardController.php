<?php

namespace App\Http\Controllers\Admin;

use GlobalHelper;
use Carbon\Carbon;
use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use App\Models\UsulanPelatihan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Tetapkan nilai default untuk start_date dan end_date
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Validasi hanya ketika ada data yang dikirimkan melalui form
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $request->validate([
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
        }

        $titles = 'Admin Dashboard';
        $tupAll = UsulanPelatihan::whereBetween('created_at', [$startDate, $endDate])->get()->count();
        $tuuAll = UsulanUjikom::whereBetween('created_at', [$startDate, $endDate])->get()->count();
        $tupAllVal = UsulanPelatihan::where('status', 'Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();
        $tuuAllVal = UsulanUjikom::where('status', 'Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();
        $tupAllNonVal = UsulanPelatihan::where('status', 'Belum Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();
        $tuuAllNonVal = UsulanUjikom::where('status', 'Belum Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();
        $tupByUk = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
            ->where('status', 'Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
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
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($item) {
                return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->sortDesc();
        $cupByJp = $usulanPelatihan = UsulanPelatihan::with('usulanJenisPelatihan')
            ->where('status', 'Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy('usulanJenisPelatihan.nama')
            ->map->count();
        $cuuByJp = $usulanUjikom = UsulanUjikom::with('usulanJenisUjikom')
            ->where('status', 'Validasi')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy('usulanJenisUjikom.nama')
            ->map->count();

        // Ambil tanggal awal dan akhir berdasarkan start_date dan end_date
        $startOfLastMonth = Carbon::parse($startDate)->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::parse($startDate)->subMonth()->endOfMonth();

        // Ambil jumlah data untuk bulan lalu berdasarkan start_date dan end_date
        $tupLastMonth = UsulanPelatihan::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $tuuLastMonth = UsulanUjikom::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Ambil jumlah data untuk bulan ini berdasarkan start_date dan end_date
        $tupThisMonth = UsulanPelatihan::whereBetween('created_at', [$startDate, $endDate])->count();
        $tuuThisMonth = UsulanUjikom::whereBetween('created_at', [$startDate, $endDate])->count();

        // Hitung perbedaan antara bulan ini dan bulan lalu
        $tupDiff = $tupThisMonth - $tupLastMonth;
        $tuuDiff = $tuuThisMonth - $tuuLastMonth;

        return view('admin.dashboard.index', compact('titles', 'tupAll', 'tuuAll', 'tupAllVal', 'tupAllNonVal', 'tuuAllNonVal', 'tupDiff', 'tuuDiff', 'tuuAllVal', 'tupByUk', 'tuuByUk' ,'cupByJp', 'cuuByJp'));
    }

}
