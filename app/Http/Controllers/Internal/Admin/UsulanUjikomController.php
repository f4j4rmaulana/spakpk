<?php

namespace App\Http\Controllers\Internal\Admin;

use App\Models\User;
use App\Models\Ujikom;
use App\Models\JenisUjikom;
use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UsulanUjikomController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = 'Daftar Usulan Ujikom';
        return view('internal.admin.usulan-ujikom.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Buat Usulan Uji ';
        return view('internal.admin.usulan-ujikom.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis_ujikom_id' => ['required','exists:jenis_ujikoms,id'],
                'ujikom_id' => ['required','exists:ujikoms,id'],
        ]);

        DB::beginTransaction();

        try {

            $usulanUjikom = new UsulanUjikom();
            $usulanUjikom->user_id = strip_tags($request->user_id);
            $usulanUjikom->jenis_ujikom_id = strip_tags($request->jenis_ujikom_id);
            $usulanUjikom->ujikom_id = strip_tags($request->ujikom_id);
            $usulanUjikom->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanUjikom->save();
            DB::commit();
            toast('Usulan ujikom anda berhasil diajukan!','success');
            return to_route('internal.admin.usulan-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error pengajuan data usulan!','error');
            return redirect()->route('internal.admin.usulan-ujikom.index');

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
        $usulanUjikom = UsulanUjikom::findOrFail($decrypted);
        $titles = 'Edit Usulan Uji Kompetensi';
        return view('internal.admin.usulan-ujikom.edit', compact('titles', 'usulanUjikom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $data)
    {
        $request->validate(
            [
                'jenis_ujikom_id' => ['required','exists:jenis_ujikoms,id'],
                'ujikom_id' => ['required','exists:ujikoms,id'],
        ]);

        DB::beginTransaction();

        try {

            $decrypted = Crypt::decryptString($data);
            $usulanUjikom = UsulanUjikom::findOrFail($decrypted);
            $usulanUjikom->jenis_ujikom_id = strip_tags($request->jenis_ujikom_id);
            $usulanUjikom->ujikom_id = strip_tags($request->ujikom_id);
            $usulanUjikom->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanUjikom->update();
            DB::commit();
            toast('Usulan ujikom anda berhasil diupdate!','success');
            return to_route('internal.admin.usulan-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error update data usulan!','error');
            return redirect()->route('internal.admin.usulan-ujikom.index');

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
            $usulanUjikom = UsulanUjikom::with('usulanUser')->findOrFail($decrypted);
            $usulanUjikom->delete();
            DB::commit();
            toast('Usulan ujikom berhasil dihapus!','success');
            return redirect()->route('internal.admin.usulan-ujikom.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('internal.admin.usulan-ujikom.index');
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

    public function ajaxGetJenisUjikom(Request $request) {
        $jenisUjikom = JenisUjikom::where('nama', 'like', '%' . $request->q . '%')->where('status', 'aktif')->get();
        return response()->json($jenisUjikom, 200);
    }

    public function ajaxGetUjikom(Request $request) {
        $ujikom = Ujikom::where('nama', 'like', '%' . $request->q . '%')
                                ->where('status', 'aktif')
                                ->get();
        return response()->json($ujikom, 200);
    }

    public function ajaxValidasi($data) {

        $decrypted = Crypt::decryptString($data);
        $usulanUjikom = UsulanUjikom::findOrFail($decrypted);

        $usulanUjikom->update([
            'status' => 'Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxNonValidasi($data) {

        $decrypted = Crypt::decryptString($data);
        $usulanUjikom = UsulanUjikom::findOrFail($decrypted);

        $usulanUjikom->update([
            'status' => 'Belum Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    // Ajax Datatable
    public function ajax() {
        $user = Auth::user();
        $data = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')
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
                $url_edit = route('internal.admin.usulan-ujikom.edit', Crypt::encryptString($action->id));
                $url_validasi = route('internal.admin.usulan-ujikom.ajaxValidasi',Crypt::encryptString($action->id));
                $url_nonvalidasi = route('internal.admin.usulan-ujikom.ajaxNonValidasi', Crypt::encryptString($action->id));
                $url_delete = route('internal.admin.usulan-ujikom.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Validasi') {
                    $btn = '
                    <div class="d-flex flex-row gap-2">
                        <a href="' . $url_edit . '" title="Edit Jenis Ujikom">
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
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Jenis Ujikom">
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
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }
}
