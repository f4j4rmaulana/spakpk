<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ujikom;
use Illuminate\View\View;
use App\Models\JenisUjikom;
use App\Models\UsulanUjikom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UsulanUjikomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Usulan Ujikom';
        return view('admin.usulan-ujikom.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Usulan Ujikom';
        return view('admin.usulan-ujikom.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => ['required','exists:users,id'],
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
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.usulan-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.usulan-ujikom.index');

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
        return view('admin.usulan-ujikom.edit', compact('titles', 'usulanUjikom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            $namaPengusul = $usulanUjikom->usulanUser->name;
            $usulanUjikom->delete();
            DB::commit();
            toast('Usulan ujikom "'.$namaPengusul.'" berhasil dihapus!','success');
            return redirect()->route('admin.usulan-ujikom.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('admin.usulan-ujikom.index');
        }
    }

    public function ajaxGetUsers(Request $request) {
        $users = User::where('name','like','%'.$request->search.'%')->paginate();
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
        $usulanUjikom = UsulanUjikom::findOrFail($data);

        $usulanUjikom->update([
            'status' => 'Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxNonValidasi($data) {
        $usulanUjikom = UsulanUjikom::findOrFail($data);

        $usulanUjikom->update([
            'status' => 'Belum Validasi'
        ]);

        return response()->json(['success' => true]);
    }

    // Ajax Datatable
    public function ajax() {
        $data = UsulanUjikom::with('usulanUser', 'usulanJenisUjikom', 'usulanUjikom')->latest()->get();
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
                $url_edit = route('admin.usulan-ujikom.edit', Crypt::encryptString($action->id));
                $url_validasi = route('admin.usulan-ujikom.ajaxValidasi',$action->id);
                $url_nonvalidasi = route('admin.usulan-ujikom.ajaxNonValidasi', $action->id);
                $url_delete = route('admin.usulan-ujikom.destroy', Crypt::encryptString($action->id));
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
            ->rawColumns(['action', 'checkbox', 'status'])
            ->addIndexColumn()
            ->make(true);
    }
}
