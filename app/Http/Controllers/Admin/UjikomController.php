<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ujikom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UjikomController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:ujikom view'])->only('index','ajax','active','nonactive');
        $this->middleware(['permission:ujikom create'])->only('create','store');
        $this->middleware(['permission:ujikom update'])->only('edit','update');
        $this->middleware(['permission:ujikom delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = 'Uji Kompetensi';
        return view('admin.ujikom.index',compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Uji Kompetensi';
        return view('admin.ujikom.create',compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => ['required', 'min:5', 'unique:ujikoms,nama'],
                'deskripsi' => ['required']
        ]);

        DB::beginTransaction();

        try {

            $ujikom = new Ujikom();
            $ujikom->nama = strip_tags($request->nama);
            $ujikom->deskripsi = strip_tags($request->deskripsi);
            $ujikom->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.ujikom.index');

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
        $ujikom = Ujikom::findOrFail($decrypted);
        $titles = 'Edit Ujikom';
        return view('admin.ujikom.edit', compact('titles', 'ujikom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama' => ['required', 'min:5'],
                'deskripsi' => ['required']
        ]);


        DB::beginTransaction();

        try {
            
            $decrypted = Crypt::decryptString($id);
            $ujikom = Ujikom::findOrFail($decrypted);
            $ujikom->nama = strip_tags($request->nama);
            $ujikom->deskripsi = strip_tags($request->deskripsi);
            $ujikom->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            logger($e);
            toast('Error simpan data!','error');
            return redirect()->route('admin.ujikom.index');

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
            $ujikom = Ujikom::findOrFail($decrypted);
            $namaUjikom = $ujikom->nama;
            $ujikom->delete();
            DB::commit();
            toast('Ujikom "'.$namaUjikom.'" berhasil dihapus!','success');
            return redirect()->route('admin.ujikom.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error simpan data!','error');
            return redirect()->route('admin.ujikom.index');
        }
    }

    public function active($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $ujikom = Ujikom::findOrFail($decrypted);

        // Simpan nama jenis ujikom sebelum diubah
        $namaUjikom = $ujikom->nama;

        // Ubah status menjadi "Tidak Aktif"
        $ujikom->update([
            'status' => 'Aktif'
        ]);

        // Tampilkan pesan toast dengan nama jenis ujikom
        toast('Ujikom "'.$namaUjikom.'" telah diaktifkan!', 'success');

        return back();
    }

    public function nonactive($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $ujikom = Ujikom::findOrFail($decrypted);

        // Simpan nama jenis ujikom sebelum diubah
        $namaUjikom = $ujikom->nama;

        // Ubah status menjadi "Tidak Aktif"
        $ujikom->update([
            'status' => 'Tidak Aktif'
        ]);

        // Tampilkan pesan toast dengan nama jenis ujikom
        toast('Ujikom "'.$namaUjikom.'" telah dinonaktifkan!', 'success');

        return back();
    }

    // Ajax Datatable
    public function ajax() {
        $data = Ujikom::latest()->get();
        return DataTables::of($data)
            ->editColumn('updated_at', function ($updated) {
                return \Carbon\Carbon::parse($updated->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
            })
            ->editColumn('status', function($status) {
                if ($status->status == 'Aktif') {
                    $info = '<span class="badge bg-success">Aktif</span>';
                } else {
                    $info = '<span class="badge bg-danger">Tidak Aktif</span>';
                }
                return $info;
            })
            ->addColumn('action', function ($action) {
                $url_edit = route('admin.ujikom.edit', Crypt::encryptString($action->id));
                $url_aktif = route('admin.ujikom.active', Crypt::encryptString($action->id));
                $url_nonaktif = route('admin.ujikom.nonactive', Crypt::encryptString($action->id));
                $url_delete = route('admin.ujikom.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Aktif') {
                    $btn = '
                    <div class="d-flex flex-row gap-2">
                        <a href="' . $url_edit . '" title="Edit Ujikom">
                        <span class="material-symbols-outlined btn btn-primary btn-sm">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined btn btn-warning btn-sm">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_aktif . '" id="btn-aktif" title="Aktifkan Ujikom">
                        <span class="material-symbols-outlined btn btn-success btn-sm">visibility</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row gap-2">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Ujikom">
                        <span class="material-symbols-outlined btn btn-primary btn-sm font-20">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined btn btn-warning btn-sm">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_nonaktif . '" class="mr-1" id="btn-nonaktif" title="Nonaktifkan Ujikom">
                        <span class="material-symbols-outlined btn btn-danger btn-sm font-12">visibility_off</span></a>
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
