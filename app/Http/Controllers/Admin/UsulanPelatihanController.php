<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JenisPelatihan;
use App\Models\UsulanPelatihan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UsulanPelatihanController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:usulan pelatihan view'])->only('index','ajax','ajaxValidasi','ajaxNonValidasi','ajaxGetUsers','ajaxGetJenisPelatihan','ajaxGetPelatihan');
        $this->middleware(['permission:usulan pelatihan create'])->only('create','store');
        $this->middleware(['permission:usulan pelatihan update'])->only('edit','update');
        $this->middleware(['permission:usulan pelatihan delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $titles = 'Usulan Pelatihan';
        return view('admin.usulan-pelatihan.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $titles = 'Tambah Usulan Pelatihan';
        return view('admin.usulan-pelatihan.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.usulan-pelatihan.index');

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
        return view('admin.usulan-pelatihan.edit', compact('titles', 'usulanPelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                // 'user_id' => ['required','exists:users,id'],
                'jenis_pelatihan_id' => ['required','exists:jenis_pelatihans,id'],
                'pelatihan_id' => ['required','exists:pelatihans,id'],
        ]);

        DB::beginTransaction();

        try {

            $decrypted = Crypt::decryptString($id);
            $usulanPelatihan = UsulanPelatihan::findOrFail($decrypted);
            // $usulanPelatihan->user_id = strip_tags($request->user_id);
            $usulanPelatihan->jenis_pelatihan_id = strip_tags($request->jenis_pelatihan_id);
            $usulanPelatihan->pelatihan_id = strip_tags($request->pelatihan_id);
            $usulanPelatihan->usulan_lainnya = strip_tags($request->usulan_lainnya);
            $usulanPelatihan->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.usulan-pelatihan.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.usulan-pelatihan.index');

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
            $namaPengusul = $usulanPelatihan->usulanUser->name;
            $usulanPelatihan->delete();
            DB::commit();
            toast('Usulan pelatihan "'.$namaPengusul.'" berhasil dihapus!','success');
            return redirect()->route('admin.usulan-pelatihan.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('admin.usulan-pelatihan.index');
        }
    }

    public function ajaxGetUsers(Request $request) {
        $users = User::where('name','like','%'.$request->search.'%')->paginate();
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
        $data = UsulanPelatihan::with('usulanUser', 'usulanJenisPelatihan', 'usulanPelatihan')->latest()->get();
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
                $url_edit = route('admin.usulan-pelatihan.edit', Crypt::encryptString($action->id));
                $url_validasi = route('admin.usulan-pelatihan.ajaxValidasi',Crypt::encryptString($action->id));
                $url_nonvalidasi = route('admin.usulan-pelatihan.ajaxNonValidasi', Crypt::encryptString($action->id));
                $url_delete = route('admin.usulan-pelatihan.destroy', Crypt::encryptString($action->id));
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
                        <a href="#" class="btn-validasi" data-url="' . $url_validasi . '" title="Validasi usulan">
                        <span class="material-symbols-outlined">verified</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data??\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="#" class="btn-nonvalidasi" data-url="' . $url_nonvalidasi . '" title="Batalkan validasi usulan">
                        <span class="material-symbols-outlined">pending</span>
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
