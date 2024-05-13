<?php

namespace App\Http\Controllers\Internal;

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
    public function __construct()
    {
        $this->middleware('cek.akses:Akses Usulan Ujikom')->except('index', 'ajax');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = 'Daftar Usulan Uji Kompetensi';
        return view('internal.usulan-ujikom.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Buat Usulan Uji Kompetensi';
        return view('internal.usulan-ujikom.create', compact('titles'));
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
            $usulanUjikom->user_id = strip_tags(auth()->user()->id);
            $usulanUjikom->jenis_ujikom_id = strip_tags($request->jenis_ujikom_id);
            $usulanUjikom->ujikom_id = strip_tags($request->ujikom_id);
            $usulanUjikom->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanUjikom->save();
            DB::commit();
            toast('Usulan ujikom anda berhasil diajukan!','success');
            return to_route('internal.usulan-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error pengajuan data usulan!','error');
            return redirect()->route('internal.usulan-ujikom.index');

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
        $titles = 'Edit Usulan Ujikom';
        return view('internal.usulan-ujikom.edit', compact('titles', 'usulanUjikom'));
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
            return to_route('internal.usulan-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error update data usulan!','error');
            return redirect()->route('internal.usulan-ujikom.index');

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
            return redirect()->route('internal.usulan-ujikom.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('internal.usulan-ujikom.index');
        }
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

    // Ajax Datatable
    public function ajax() {
        $user = Auth::user();
        $data = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')
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
                $url_edit = route('internal.usulan-ujikom.edit', Crypt::encryptString($action->id));
                $url_delete = route('internal.usulan-ujikom.destroy', Crypt::encryptString($action->id));
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
