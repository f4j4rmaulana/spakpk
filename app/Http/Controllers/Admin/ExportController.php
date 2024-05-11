<?php

namespace App\Http\Controllers\Admin;

use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use App\Models\UsulanPelatihan;
use App\Exports\UsulanUjikomExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsulanPelatihanExport;

class ExportController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:usulan pelatihan create'])->only('exportUsulanPelatihan');
        $this->middleware(['permission:usulan ujikom create'])->only('exportUsulanUjikom');
    }

    public function exportUsulanPelatihan(Request $request)
    {
        // Validasi input filter tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Lakukan filter data berdasarkan rentang tanggal dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filteredData = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Eksport data menggunakan Laravel Excel
        return Excel::download(new UsulanPelatihanExport($filteredData), 'Laporan_usulan_pelatihan_' . date('Y-m-d_H.i.s') . '.xlsx');
    }

    public function exportUsulanUjikom(Request $request)
    {
        // Validasi input filter tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Lakukan filter data berdasarkan rentang tanggal dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filteredData = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Eksport data menggunakan Laravel Excel
        return Excel::download(new UsulanUjikomExport($filteredData), 'Laporan_usulan_ujikom_' . date('Y-m-d_H.i.s') . '.xlsx');
    }
}
