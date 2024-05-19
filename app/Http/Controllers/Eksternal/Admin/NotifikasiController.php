<?php

namespace App\Http\Controllers\Eksternal\Admin;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NotifikasiController extends Controller
{
    public function index(): View {
        $titles = 'Eksternal Notifikasi';
        return view('eksternal.admin.notifikasi.index', compact('titles'));
    }

    public function ajax() {
        $user = Auth::guard('ekt')->user();
        $data = $user->notifications;
        return DataTables::of($data)
            ->editColumn('created_at', function ($created) {
                return Carbon::parse($created->created_at)->isoFormat('dddd, DD MMMM Y HH:mm a');
            })
            ->editColumn('message', function ($info) {
                return $info->data['message'];
            })
            ->editColumn('action', function ($action) {
                if ($action->read_at) {
                    $data = '<small class="text-success">Sudah dibaca</small>';
                } else {
                    $data = '<small class="text-muted"><i><u>Belum dibaca</u></i></small>';
                }
                return $data;
            })
            ->rawColumns(['action', 'message'])
            ->addIndexColumn()
            ->make(true);
    }
}
