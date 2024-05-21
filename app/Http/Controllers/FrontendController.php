<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use App\Models\UsulanPelatihan;

class FrontendController extends Controller
{
    public function index() {
    $yearNow = Carbon::now()->year;
    $yearNext = Carbon::now()->addYears(1)->year;
    $userCount = User::count();
    $upInternal = UsulanPelatihan::whereHas('usulanUser', function ($query) {
        $query->where('role', 'internal');
        })->whereYear('created_at', $yearNow)->count();
    $upEksternal = UsulanPelatihan::whereHas('usulanUser', function ($query) {
        $query->where('role', 'eksternal');
        })->whereYear('created_at', $yearNow)->count();
    $upYear = UsulanPelatihan::whereYear('created_at', $yearNow)
        ->count();
    // $tupByUk = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
    // ->where('status', 'Validasi')
    // ->whereYear('created_at', $yearNow)
    // ->get()
    // ->groupBy(function ($item) {
    //     return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
    // })
    // ->map(function ($group) {
    //     return $group->count();
    // });

    // $data = $tupByUk->toArray();

    // $chartData = [];
    // foreach ($data as $key => $value) {
    //     $parts = explode('|', $key);
    //     $chartData[] = [
    //         'name' => $parts[0] . ' - ' . $parts[1],
    //         'y' => $value
    //     ];
    // }

    $tupByUk = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
    ->whereYear('created_at', $yearNow)
    ->get()
    ->groupBy(function ($item) {
        return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
    })
    ->map(function ($group) {
        return [
            'Validasi' => $group->where('status', 'Validasi')->count(),
            'Belum Validasi' => $group->where('status', 'Belum Validasi')->count(),
        ];
    });

    $data = $tupByUk->toArray();

    $pelCategories = [];
    $pelValidasiData = [];
    $pelbelumValidasiData = [];

    foreach ($data as $key => $counts) {
        $parts = explode('|', $key);
        $pelCategories[] = $parts[0] . ' - ' . $parts[1];
        $pelValidasiData[] = $counts['Validasi'];
        $pelBelumValidasiData[] = $counts['Belum Validasi'];
    }

    // // Chart by Usulan Pelatihan dan Usulan Ujikom Validasi dan Belum Validasi
    // $tupByUk = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
    // ->whereYear('created_at', $yearNow)
    // ->get()
    // ->groupBy(function ($item) {
    //     return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
    // })
    // ->map(function ($group) {
    //     return [
    //         'Validasi' => $group->where('status', 'Validasi')->count(),
    //         'Belum Validasi' => $group->where('status', 'Belum Validasi')->count(),
    //     ];
    // })
    // ->toArray();

    // // Fetch and process data for UsulanUjikom
    // $tuuByUk = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')
    // ->whereYear('created_at', $yearNow)
    // ->get()
    // ->groupBy(function ($item) {
    //     return $item->usulanUser->instansi . '|' . $item->usulanUser->unit_kerja;
    // })
    // ->map(function ($group) {
    //     return [
    //         'Validasi' => $group->where('status', 'Validasi')->count(),
    //         'Belum Validasi' => $group->where('status', 'Belum Validasi')->count(),
    //     ];
    // })
    // ->toArray();

    // // Prepare data for Highcharts
    // $categories = array_unique(array_merge(array_keys($tupByUk), array_keys($tuuByUk)));
    // $pelatihanValidasi = [];
    // $pelatihanBelumValidasi = [];
    // $ujikomValidasi = [];
    // $ujikomBelumValidasi = [];

    // foreach ($categories as $category) {
    // $pelatihanValidasi[] = isset($tupByUk[$category]) ? $tupByUk[$category]['Validasi'] : 0;
    // $pelatihanBelumValidasi[] = isset($tupByUk[$category]) ? $tupByUk[$category]['Belum Validasi'] : 0;
    // $ujikomValidasi[] = isset($tuuByUk[$category]) ? $tuuByUk[$category]['Validasi'] : 0;
    // $ujikomBelumValidasi[] = isset($tuuByUk[$category]) ? $tuuByUk[$category]['Belum Validasi'] : 0;
    // }

    // Fetch and process data
    $cupByJp = UsulanPelatihan::with('usulanJenisPelatihan')
    ->where('status', 'Validasi')
    ->whereYear('created_at', $yearNow)
    ->get()
    ->groupBy('usulanJenisPelatihan.nama')
    ->map->count()
    ->toArray();

        // Calculate total count for percentage calculation
        $totalCount = array_sum($cupByJp);

        // Prepare data for Highcharts
        $chartCupByJp = [];
        foreach ($cupByJp as $jenisPelatihan => $count) {
        $chartCupByJp[] = [
            'name' => $jenisPelatihan,
            'y' => ($count / $totalCount) * 100
        ];
    }

    // Fetch and process data
    $cuuByJp = UsulanUjikom::with('usulanJenisUjikom')
    ->where('status', 'Validasi')
    ->whereYear('created_at', $yearNow)
    ->get()
    ->groupBy('usulanJenisUjikom.nama')
    ->map->count()
    ->toArray();

        // Calculate total count for percentage calculation
        $totalCount = array_sum($cuuByJp);

        // Prepare data for Highcharts
        $chartCuuByJp = [];
        foreach ($cuuByJp as $jenisUjikom => $count) {
        $chartCuuByJp[] = [
            'name' => $jenisUjikom,
            'y' => ($count / $totalCount) * 100
        ];
    }


    // Pass the data to the view (assuming you're using Blade)
    return view('frontend.layouts.master', compact('chartCupByJp', 'chartCuuByJp', 'pelCategories', 'pelValidasiData', 'pelBelumValidasiData',  'yearNow', 'yearNext', 'userCount', 'upInternal', 'upEksternal', 'upYear'));

    }
}
