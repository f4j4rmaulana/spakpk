<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\JenisUjikom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class JenisUjikomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Jenis Uji Kompetensi';
        return view('admin.jenis-ujikom.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $titles = 'Tambah Jenis Uji Kompetensi';
        return view('admin.jenis-ujikom.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'nama' => ['required', 'min:5', 'unique:jenis_ujikoms,nama'],
                'deskripsi' => ['required']
        ]);

        DB::beginTransaction();

        try {

            $jenisUjikom = new JenisUjikom();
            $jenisUjikom->nama = ucwords(strtolower(strip_tags($request->nama)));
            $jenisUjikom->deskripsi = strip_tags($request->deskripsi);
            $jenisUjikom->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.jenis-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.jenis-ujikom.index');

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
        $jenisUjikom = JenisUjikom::findOrFail($decrypted);
        $titles = 'Edit Jenis Ujikom';
        return view('admin.jenis-ujikom.edit', compact('titles', 'jenisUjikom'));
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

            $jenisUjikom = new JenisUjikom();
            $jenisUjikom->nama = ucwords(strtolower(strip_tags($request->nama)));
            $jenisUjikom->deskripsi = strip_tags($request->deskripsi);
            $jenisUjikom->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.jenis-ujikom.index');

        }catch (\Exception $e) {

            DB::rollback();
            logger($e);
            toast('Error simpan data!','error');
            return redirect()->route('admin.jenis-ujikom.index');

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
            $jenisUjikom = JenisUjikom::findOrFail($decrypted);
            $namaUjikom = $jenisUjikom->nama;
            $jenisUjikom->delete();
            DB::commit();
            toast('Jenis ujikom "'.$namaUjikom.'" berhasil dihapus!','success');
            return redirect()->route('admin.jenis-ujikom.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error simpan data!','error');
            return redirect()->route('admin.jenis-ujikom.index');
        }
    }


    public function active($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $jenisUjikom = JenisUjikom::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaUjikom = $jenisUjikom->nama;

        // Ubah status menjadi "Tidak Aktif"
        $jenisUjikom->update([
            'status' => 'Aktif'
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Jenis ujikom "'.$namaUjikom.'" telah diaktifkan!', 'success');

        return back();
    }


    public function nonactive($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $jenisUjikom = JenisUjikom::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaUjikom = $jenisUjikom->nama;

        // Ubah status menjadi "Tidak Aktif"
        $jenisUjikom->update([
            'status' => 'Tidak Aktif'
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Jenis ujikom "'.$namaUjikom.'" telah dinonaktifkan!', 'success');

        return back();
    }

    // Ajax Datatable
    public function ajax() {
        $data = JenisUjikom::latest()->get();
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
                $url_edit = route('admin.jenis-ujikom.edit', Crypt::encryptString($action->id));
                $url_aktif = route('admin.jenis-ujikom.active', Crypt::encryptString($action->id));
                $url_nonaktif = route('admin.jenis-ujikom.nonactive', Crypt::encryptString($action->id));
                $url_delete = route('admin.jenis-ujikom.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Aktif') {
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
                        <a href="' . $url_aktif . '" id="btn-aktif" title="Aktifkan Jenis Ujikom">
                        <span class="material-symbols-outlined btn btn-success btn-sm">visibility</span></a>
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
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined btn btn-warning btn-sm">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_nonaktif . '" class="mr-1" id="btn-nonaktif" title="Nonaktifkan Jenis Ujikom">
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
