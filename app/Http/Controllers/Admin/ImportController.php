<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsulanPelatihanImport;

class ImportController extends Controller
{
    public function importUsulanPelatihan(Request $request)
    {
        //dd($request->all());
        // Validasi file yang diunggah
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx,xls',
        ]);

        // Mulai proses impor
        try {
            // Ambil file yang diunggah
            $file = $request->file('file_import');

            // Lakukan impor data menggunakan Laravel Excel
            Excel::import(new UsulanPelatihanImport(), $file);

            // Jika berhasil, kembalikan respons dengan pesan sukses
            toast('Import data berhasil!','success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons dengan pesan error
            toast('Error import data!','error');
            return redirect()->back();
        }
    }
}
