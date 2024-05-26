<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PelatihanRequest;
use App\Models\Pelatihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PelatihanController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:pelatihan view'])->only('index', 'ajax', 'active', 'nonactive');
        $this->middleware(['permission:pelatihan create'])->only('create', 'store');
        $this->middleware(['permission:pelatihan update'])->only('edit', 'update');
        $this->middleware(['permission:pelatihan delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Pelatihan';
        return view('admin.pelatihan.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Pelatihan';
        return view('admin.pelatihan.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelatihanRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {

            $pelatihan = new Pelatihan();
            $pelatihan->nama = strip_tags($validatedData['nama']);
            $pelatihan->deskripsi = strip_tags($validatedData['deskripsi']);
            $pelatihan->save();
            DB::commit();
            toast('Data berhasil tersimpan!', 'success');
            return to_route('admin.pelatihan.index');

        } catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.pelatihan.index');

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
        $pelatihan = Pelatihan::findOrFail($decrypted);
        $titles = 'Edit Pelatihan';
        return view('admin.pelatihan.edit', compact('titles', 'pelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelatihanRequest $request, string $id)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {

            $decrypted = Crypt::decryptString($id);
            $pelatihan = Pelatihan::findOrFail($decrypted);
            $pelatihan->nama = strip_tags($validatedData['nama']);
            $pelatihan->deskripsi = strip_tags($validatedData['deskripsi']);
            $pelatihan->save();
            DB::commit();
            toast('Data berhasil tersimpan!', 'success');
            return to_route('admin.pelatihan.index');

        } catch (\Exception $e) {

            DB::rollback();
            logger($e);
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.pelatihan.index');

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
            $pelatihan = Pelatihan::findOrFail($decrypted);
            $namaPelatihan = $pelatihan->nama;
            $pelatihan->delete();
            DB::commit();
            toast('Pelatihan "' . $namaPelatihan . '" berhasil dihapus!', 'success');
            return redirect()->route('admin.pelatihan.index');
        } catch (\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.pelatihan.index');
        }
    }

    public function active($data): RedirectResponse
    {
        $decrypted = Crypt::decryptString($data);
        $pelatihan = Pelatihan::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaPelatihan = $pelatihan->nama;

        // Ubah status menjadi "Tidak Aktif"
        $pelatihan->update([
            'status' => 'Aktif',
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Pelatihan "' . $namaPelatihan . '" telah diaktifkan!', 'success');

        return back();
    }

    public function nonactive($data): RedirectResponse
    {
        $decrypted = Crypt::decryptString($data);
        $pelatihan = Pelatihan::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaPelatihan = $pelatihan->nama;

        // Ubah status menjadi "Tidak Aktif"
        $pelatihan->update([
            'status' => 'Tidak Aktif',
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Pelatihan "' . $namaPelatihan . '" telah dinonaktifkan!', 'success');

        return back();
    }

    // Ajax Datatable
    public function ajax()
    {
        $data = Pelatihan::latest()->get();
        return DataTables::of($data)
            ->editColumn('updated_at', function ($updated) {
                return \Carbon\Carbon::parse($updated->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
            })
            ->editColumn('status', function ($status) {
                if ($status->status == 'Aktif') {
                    $info = '<span class="badge bg-success">Aktif</span>';
                } else {
                    $info = '<span class="badge bg-danger">Tidak Aktif</span>';
                }
                return $info;
            })
            ->addColumn('action', function ($action) {
                $url_edit = route('admin.pelatihan.edit', Crypt::encryptString($action->id));
                $url_aktif = route('admin.pelatihan.active', Crypt::encryptString($action->id));
                $url_nonaktif = route('admin.pelatihan.nonactive', Crypt::encryptString($action->id));
                $url_delete = route('admin.pelatihan.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Aktif') {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" title="Edit Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_aktif . '" id="btn-aktif" title="Aktifkan Pelatihan">
                        <span class="material-symbols-outlined">visibility</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_nonaktif . '" class="mr-1" id="btn-nonaktif" title="Nonaktifkan Pelatihan">
                        <span class="material-symbols-outlined">visibility_off</span></a>
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
