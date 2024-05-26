<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisPelatihanRequest;
use App\Models\JenisPelatihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class JenisPelatihanController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:jenis pelatihan view'])->only('index', 'ajax', 'active', 'nonactive');
        $this->middleware(['permission:jenis pelatihan create'])->only('create', 'store');
        $this->middleware(['permission:jenis pelatihan update'])->only('edit', 'update');
        $this->middleware(['permission:jenis pelatihan delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Jenis Pelatihan';
        return view('admin.jenis-pelatihan.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $titles = 'Tambah Jenis Pelatihan';
        return view('admin.jenis-pelatihan.create', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisPelatihanRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $jenisPelatihan = new JenisPelatihan;
            $jenisPelatihan->nama = strip_tags($validatedData['nama']);
            $jenisPelatihan->deskripsi = strip_tags($validatedData['deskripsi']);
            $jenisPelatihan->save();
            DB::commit();
            toast('Data berhasil tersimpan!', 'success');
            return to_route('admin.jenis-pelatihan.index');

        } catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.jenis-pelatihan.index');

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
    public function edit(string $id): View
    {
        $decrypted = Crypt::decryptString($id);
        $jenisPelatihan = JenisPelatihan::findOrFail($decrypted);
        $titles = 'Edit Jenis Pelatihan';
        return view('admin.jenis-pelatihan.edit', compact('titles', 'jenisPelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisPelatihanRequest $request, string $id)
    {
        $validatedData = $request->validated(); // Retrieve function validated data not validate

        DB::beginTransaction();

        try {
            $decrypted = Crypt::decryptString($id);
            $jenisPelatihan = JenisPelatihan::findOrFail($decrypted);
            $jenisPelatihan->nama = strip_tags($validatedData['nama']);
            $jenisPelatihan->deskripsi = strip_tags($validatedData['deskripsi']);
            $jenisPelatihan->save();
            DB::commit();
            toast('Update data berhasil!', 'success');
            return to_route('admin.jenis-pelatihan.index');
        } catch (\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.jenis-pelatihan.index');
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
            $jenisPelatihan = JenisPelatihan::findOrFail($decrypted);
            $namaPelatihan = $jenisPelatihan->nama;
            $jenisPelatihan->delete();
            DB::commit();
            toast('Jenis pelatihan "' . $namaPelatihan . '" berhasil dihapus!', 'success');
            return redirect()->route('admin.jenis-pelatihan.index');
        } catch (\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error simpan data!', 'error');
            return redirect()->route('admin.jenis-pelatihan.index');
        }

    }

    // dari route melempar id dengan nama variable bisa bebas
    public function active($data): RedirectResponse
    {
        $decrypted = Crypt::decryptString($data);
        $jenisPelatihan = JenisPelatihan::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaPelatihan = $jenisPelatihan->nama;

        // Ubah status menjadi "Tidak Aktif"
        $jenisPelatihan->update([
            'status' => 'Aktif',
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Jenis pelatihan "' . $namaPelatihan . '" telah diaktifkan!', 'success');

        return back();
    }

    // dari route melempar id dengan nama variable bisa bebas
    public function nonactive($data): RedirectResponse
    {
        $decrypted = Crypt::decryptString($data);
        $jenisPelatihan = JenisPelatihan::findOrFail($decrypted);

        // Simpan nama jenis pelatihan sebelum diubah
        $namaPelatihan = $jenisPelatihan->nama;

        // Ubah status menjadi "Tidak Aktif"
        $jenisPelatihan->update([
            'status' => 'Tidak Aktif',
        ]);

        // Tampilkan pesan toast dengan nama jenis pelatihan
        toast('Jenis pelatihan "' . $namaPelatihan . '" telah dinonaktifkan!', 'success');

        return back();
    }

    // Ajax Datatable
    public function ajax()
    {
        $data = JenisPelatihan::latest()->get();
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
                $url_edit = route('admin.jenis-pelatihan.edit', Crypt::encryptString($action->id));
                $url_aktif = route('admin.jenis-pelatihan.active', Crypt::encryptString($action->id));
                $url_nonaktif = route('admin.jenis-pelatihan.nonactive', Crypt::encryptString($action->id));
                $url_delete = route('admin.jenis-pelatihan.destroy', Crypt::encryptString($action->id));
                if ($action->status != 'Aktif') {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_aktif . '" id="btn-aktif" title="Aktifkan Jenis Pelatihan">
                        <span class="material-symbols-outlined">visibility</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Jenis Pelatihan">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data??\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_nonaktif . '" class="mr-1" id="btn-nonaktif" title="Nonaktifkan Jenis Pelatihan">
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
