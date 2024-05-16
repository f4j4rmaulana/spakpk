<?php

namespace App\Http\Controllers\Eksternal\Admin;

use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JenisPelatihan;
use App\Models\UsulanPelatihan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UsulanPelatihanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Daftar Usulan Pelatihan';
        return view('eksternal.admin.usulan-pelatihan.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $titles = 'Buat Usulan Pelatihan';
        return view('eksternal.admin.usulan-pelatihan.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => ['required','exists:users,id'],
                'jenis_pelatihan_id' => ['required','exists:jenis_pelatihans,id'],
                'pelatihan_id' => ['required','exists:pelatihans,id'],
        ]);

        DB::beginTransaction();

        try {

            $usulanPelatihan = new UsulanPelatihan();
            $usulanPelatihan->user_id = strip_tags($request->user_id);
            $usulanPelatihan->jenis_pelatihan_id = strip_tags($request->jenis_pelatihan_id);
            $usulanPelatihan->pelatihan_id = strip_tags($request->pelatihan_id);
            $usulanPelatihan->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanPelatihan->save();
            DB::commit();
            toast('Usulan pelatihan anda berhasil diajukan!','success');
            return to_route('eksternal.admin.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error pengajuan data usulan!','error');
            return redirect()->route('eksternal.admin.usulan-pelatihan.index');

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
        return view('eksternal.admin.usulan-pelatihan.edit', compact('titles', 'usulanPelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $data)
    {
        $request->validate(
            [
                'user_id' => ['required','exists:users,id'],
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
            return to_route('eksternal.admin.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error update data usulan!','error');
            return redirect()->route('eksternal.admin.usulan-pelatihan.index');

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
            $usulanPelatihan->delete();
            DB::commit();
            toast('Usulan pelatihan berhasil dihapus!','success');
            return redirect()->route('eksternal.admin.usulan-pelatihan.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('eksternal.admin.usulan-pelatihan.index');
        }
    }

    public function ajaxGetUsers(Request $request) {
        $userAuth = $request->user(); // Mengambil pengguna yang melakukan permintaan

        // Mengambil hanya pengguna yang memiliki unit kerja yang sama dengan pengguna yang melakukan permintaan
        $users = User::where('unit_kerja', $userAuth->unit_kerja)
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate();
        return response()->json($users, 200);
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

    public function ajaxValidasi($data) {

        $decrypted = Crypt::decryptString($data);
        $usulanPelatihan = UsulanPelatihan::findOrFail($decrypted);

        $usulanPelatihan->update([
            'status' => 'Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxNonValidasi($data) {

            $decrypted = Crypt::decryptString($data);
            $usulanPelatihan = UsulanPelatihan::findOrFail($decrypted);

        $usulanPelatihan->update([
            'status' => 'Belum Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    // Ajax Datatable
    public function ajax() {
        $user = Auth::guard('ekt')->user();
        $data = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')
        ->whereHas('usulanUser', function ($query) use ($user) {
            $query->where('unit_kerja', $user->unit_kerja);
        })
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
                $url_edit = route('eksternal.admin.usulan-pelatihan.edit', Crypt::encryptString($action->id));
                $url_validasi = route('eksternal.admin.usulan-pelatihan.ajaxValidasi',Crypt::encryptString($action->id));
                $url_nonvalidasi = route('eksternal.admin.usulan-pelatihan.ajaxNonValidasi', Crypt::encryptString($action->id));
                $url_delete = route('eksternal.admin.usulan-pelatihan.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Validasi') {
                    $btn = '
                    <div class="d-flex flex-row gap-2">
                        <a href="' . $url_edit . '" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined btn btn-primary btn-sm">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined btn btn-warning btn-sm">delete</span>
                        </a>
                        </form>
                        <a href="#" class="btn-validasi" data-url="' . $url_validasi . '" title="Validasi usulan">
                        <span class="material-symbols-outlined btn btn-success btn-sm">verified</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row gap-2">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined btn btn-primary btn-sm font-20">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data??\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined btn btn-warning btn-sm">delete</span>
                        </a>
                        </form>
                        <a href="#" class="btn-nonvalidasi" data-url="' . $url_nonvalidasi . '" title="Batalkan validasi usulan">
                        <span class="material-symbols-outlined btn btn-danger btn-sm">pending</span>
                    </div>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['action', 'checkbox', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

}
