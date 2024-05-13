<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class PengaturanController extends Controller
{
    public function index()
    {
        $titles = 'Pengaturan';
        $pgUsulans = Pengaturan::all();
        return view('admin.pengaturan.create',compact('titles', 'pgUsulans'));
    }

    public function ajaxClose($data)
    {
        $decrypted = Crypt::decryptString($data);
        $pengaturan = Pengaturan::findOrFail($decrypted);

        $pengaturan->update([
            'value' => 'Close'
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxOpen($data)
    {
        $decrypted = Crypt::decryptString($data);
        $pengaturan = Pengaturan::findOrFail($decrypted);

        $pengaturan->update([
            'value' => 'Open'
        ]);

        return response()->json(['success' => true]);
    }
}
