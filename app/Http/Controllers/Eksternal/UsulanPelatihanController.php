<?php

namespace App\Http\Controllers\Eksternal;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pelatihan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JenisPelatihan;
use App\Models\UsulanPelatihan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\UsulanSubmitted;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;

class UsulanPelatihanController extends Controller
{
    public function __construct()
    {
        $this->middleware('cek.akses:Akses Usulan Pelatihan')->except('index', 'ajax');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Daftar Usulan Pelatihan';
        return view('eksternal.usulan-pelatihan.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $titles = 'Buat Usulan Pelatihan';
        return view('eksternal.usulan-pelatihan.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis_pelatihan_id' => ['required','exists:jenis_pelatihans,id'],
                'pelatihan_id' => ['required','exists:pelatihans,id'],
        ]);

        DB::beginTransaction();

        try {

            $usulanPelatihan = new UsulanPelatihan();
            $usulanPelatihan->user_id = strip_tags(auth()->guard('ekt')->user()->id);
            $usulanPelatihan->jenis_pelatihan_id = strip_tags($request->jenis_pelatihan_id);
            $usulanPelatihan->pelatihan_id = strip_tags($request->pelatihan_id);
            $usulanPelatihan->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanPelatihan->save();
            DB::commit();

            // Ambil ID dari usulan yang baru saja disimpan
            $usulanId = $usulanPelatihan->id;
            $createdAt = UsulanPelatihan::where('id', $usulanId)->value('created_at');
            $usulan = Carbon::parse($createdAt)->isoFormat('D MMMM YYYY HH:mm:ss');

            // Ambil current user
            $currentUser = Auth::guard('ekt')->user();
            $namaUser = $currentUser->name;
            $unitKerja = $currentUser->unit_kerja;

            $message = $namaUser . ' telah submit usulan pelatihan pada ' . $usulan . ' WIB';

             // Ambil semua user dengan account_type 'multirole' dan unit_kerja yang sama
            $users = User::where('account_type', 'multirole')
                ->where('unit_kerja', $unitKerja)
                ->get();

            // Ambil semua admin dengan unit_kerja yang sama
            // $admins = Admin::where('unit_kerja', $unitKerja)->get();
            $admins = Admin::all();

            // Gabungkan user dan admin
            $recipients = $users->concat($admins);

            // Kirim notifikasi ke user dan admin
            Notification::send($recipients, new UsulanSubmitted($message, $usulan));


            toast('Usulan pelatihan anda berhasil diajukan!','success');
            return to_route('eksternal.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error pengajuan data usulan!','error');
            return redirect()->route('eksternal.usulan-pelatihan.index');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decrypted = Crypt::decryptString($id);
        $usulanPelatihan = UsulanPelatihan::findOrFail($decrypted);
        $titles = 'Edit Usulan Pelatihan';
        return view('eksternal.usulan-pelatihan.edit', compact('titles', 'usulanPelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $data)
    {
        $request->validate(
            [
                'jenis_pelatihan_id' => ['required','exists:jenis_pelatihans,id'],
                'pelatihan_id' => ['required','exists:pelatihans,id'],
        ]);

        DB::beginTransaction();

        try {

            $decrypted = Crypt::decryptString($data);
            $usulanPelatihan = UsulanPelatihan::findOrFail($decrypted);
            $usulanPelatihan->jenis_pelatihan_id = strip_tags($request->jenis_pelatihan_id);
            $usulanPelatihan->pelatihan_id = strip_tags($request->pelatihan_id);
            $usulanPelatihan->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanPelatihan->update();
            DB::commit();
            toast('Usulan pelatihan anda berhasil diupdate!','success');
            return to_route('eksternal.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error update data usulan!','error');
            return redirect()->route('eksternal.usulan-pelatihan.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $decrypted = Crypt::decryptString($id);
            $usulanPelatihan = UsulanPelatihan::with('usulanUser')->findOrFail($decrypted);

            // Ambil ID dari usulan sebelum dihapus
            $usulanId = $usulanPelatihan->id;
            $createdAt = UsulanPelatihan::where('id', $usulanId)->value('created_at');
            $usulan = Carbon::parse($createdAt)->isoFormat('D MMMM YYYY HH:mm:ss');

            $usulanPelatihan->delete();
            DB::commit();

            // Ambil current user
            $currentUser = Auth::guard('ekt')->user();
            $namaUser = $currentUser->name;
            $unitKerja = $currentUser->unit_kerja;

            $message = $namaUser . ' telah hapus usulan pelatihan tanggal ' . $usulan . ' WIB';

             // Ambil semua user dengan account_type 'multirole' dan unit_kerja yang sama
            $users = User::where('account_type', 'multirole')
                ->where('unit_kerja', $unitKerja)
                ->get();

            // Ambil semua admin dengan unit_kerja yang sama
            // $admins = Admin::where('unit_kerja', $unitKerja)->get();
            $admins = Admin::all();

            // Gabungkan user dan admin
            $recipients = $users->concat($admins);

            // Kirim notifikasi ke user dan admin
            Notification::send($recipients, new UsulanSubmitted($message, $usulan));

            toast('Usulan pelatihan berhasil dihapus!','success');
            return redirect()->route('eksternal.usulan-pelatihan.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('eksternal.usulan-pelatihan.index');
        }
    }

    public function ajaxGetJenisPelatihan(Request $request) {
        $jenisPelatihan = JenisPelatihan::where('nama', 'like', '%' . $request->q . '%')->where('status', 'aktif')->get();
        return response()->json($jenisPelatihan, 200);
    }

    public function ajaxGetPelatihan(Request $request) {
        $pelatihan = Pelatihan::where('nama', 'like', '%' . $request->q . '%')
                                ->where('status', 'aktif')
                                ->get();
        return response()->json($pelatihan, 200);
    }

    // Ajax Datatable
    public function ajax() {
        $user = Auth::guard('ekt')->user();
        $data = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
            ->where('user_id', $user->id) // Menggunakan id pengguna saat ini
            ->latest()
            ->get();
        return DataTables::of($data)
            ->editColumn('created_at', function ($created) {
                return \Carbon\Carbon::parse($created->created_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
            })
            ->editColumn('status', function($status) {
                if ($status->status == 'Validasi') {
                    $info = '<span class="badge bg-success">Validasi</span>';
                } else {
                    $info = '<span class="badge bg-danger">Belum Validasi</span>';
                }
                return $info;
            })
            ->addColumn('action', function ($action) {
                $url_edit = route('eksternal.usulan-pelatihan.edit', Crypt::encryptString($action->id));
                $url_delete = route('eksternal.usulan-pelatihan.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Validasi') {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                    </div>
                    ';
                } else {
                    $btn = '';
                }
                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }
}
