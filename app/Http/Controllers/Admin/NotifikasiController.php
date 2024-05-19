<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class NotifikasiController extends Controller
{
    public function index(): View {
        $titles = 'Admin Notifikasi';
        return view('admin.notifikasi.index', compact('titles'));
    }

    public function ajaxRead($id) {

        $decrypted = Crypt::decryptString($id);
        $notification = auth()->guard('admin')->user()->notifications->find($decrypted);

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function ajaxReadAll() {

        $userNotification = auth()->guard('admin')->user();

        $userNotification->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function ajax() {
        $user = Auth::guard('admin')->user();
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
