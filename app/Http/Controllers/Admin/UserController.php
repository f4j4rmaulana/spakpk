<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:manajemen akses']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = 'Pengguna';
        return view('admin.user.index',compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Pengguna';
        return view('admin.user.create',compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                    'name' => ['required', 'min:3'],
                    'email' => ['required', 'email', 'lowercase', 'unique:users,email'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    'nomor_id' => ['required', 'unique:users,nomor_id'],
                    'instansi' => ['required'],
                    'unit_kerja' => ['required'],
                    'jabatan' => ['required'],
                    'account_type' => ['required'],
                ]);

        DB::beginTransaction();

        try {

            $pengguna = new User();
            $pengguna->name = strip_tags($request->name);
            $pengguna->email = strip_tags($request->email);
            $pengguna->password = bcrypt($request->password);
            $pengguna->role = 'eksternal';
            $pengguna->nomor_id = strip_tags($request->nomor_id);
            $pengguna->instansi = strip_tags($request->instansi);
            $pengguna->unit_kerja = strip_tags($request->unit_kerja);
            $pengguna->jabatan = strip_tags($request->jabatan);
            $pengguna->account_type = strip_tags($request->account_type);
            $pengguna->save();
            DB::commit();
            toast('Data berhasil tersimpan!','success');
            return to_route('admin.user.index');

        }catch (\Exception $e) {

            DB::rollback();
            toast('Error simpan data!','error');
            return redirect()->route('admin.user.index');

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
        $pengguna = User::findOrFail($decrypted);
        $titles = 'Edit Pengguna';
        return view('admin.user.edit', compact('titles', 'pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decrypted = Crypt::decryptString($id);
        $pengguna = User::findOrFail($decrypted);

        // Atur aturan validasi untuk password jika diperlukan
        $passwordRules = $request->password ? ['confirmed', Rules\Password::defaults()] : [];

        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', Rule::unique('users', 'email')->ignore($pengguna->id)],
            'password' => $passwordRules,
            'nomor_id' => ['required', Rule::unique('users', 'nomor_id')->ignore($pengguna->id)],
            'instansi' => ['required'],
            'unit_kerja' => ['required'],
            'jabatan' => ['required'],
            'account_type' => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $pengguna->name = strip_tags($request->name);
            $pengguna->email = strip_tags($request->email);

            // Perbarui password hanya jika ada input password baru
            if($request->password) {
                $pengguna->password = bcrypt($request->password);
            }

            $pengguna->role = 'eksternal';
            $pengguna->nomor_id = strip_tags($request->nomor_id);
            $pengguna->instansi = strip_tags($request->instansi);
            $pengguna->unit_kerja = strip_tags($request->unit_kerja);
            $pengguna->jabatan = strip_tags($request->jabatan);
            $pengguna->account_type = strip_tags($request->account_type);
            $pengguna->save();

            DB::commit();

            toast('Data berhasil tersimpan!', 'success');
            return redirect()->route('admin.user.index');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Error update data!', 'error');
            return redirect()->route('admin.user.index');
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
            $pengguna = User::findOrFail($decrypted);
            $namaPengguna = $pengguna->name;
            $pengguna->delete();
            DB::commit();
            toast('Pengguna "'.$namaPengguna.'" berhasil dihapus!','success');
            return redirect()->route('admin.user.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('admin.user.index');
        }
    }

    // dari route melempar id dengan nama variable bisa bebas
    public function active($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $pengguna = User::findOrFail($decrypted);

        // Simpan nama user sebelum diubah
        $namaPengguna = $pengguna->name;

        // Ubah tipe akun"
        $pengguna->update([
            'account_type' => 'multirole'
        ]);

        // Tampilkan pesan toast dengan nama juser
        toast('Fitur Multirole Pengguna "'.$namaPengguna.'" telah diaktifkan!', 'success');

        return back();
    }

    // dari route melempar id dengan nama variable bisa bebas
    public function nonactive($data): RedirectResponse {
        $decrypted = Crypt::decryptString($data);
        $pengguna = User::findOrFail($decrypted);

        // Simpan nama user sebelum diubah
        $namaPengguna = $pengguna->name;

        // Ubah tipe akun"
        $pengguna->update([
            'account_type' => 'single'
        ]);

        // Tampilkan pesan toast dengan nama juser
        toast('Fitur Multirole Pengguna "'.$namaPengguna.'" telah dinonaktifkan!', 'success');

        return back();
    }

    // Ajax Datatable
    public function ajax() {
        $data = User::latest()->get();
        return DataTables::of($data)
            ->editColumn('updated_at', function ($updated) {
                return \Carbon\Carbon::parse($updated->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
            })
            ->editColumn('account_type', function($accountType) {
                if ($accountType->account_type == 'multirole') {
                    $info = '<span class="badge bg-success">Multi Role</span>';
                } else {
                    $info = '<span class="badge bg-danger">Single</span>';
                }
                return $info;
            })
            ->addColumn('action', function ($action) {
                $url_edit = route('admin.user.edit', Crypt::encryptString($action->id));
                $url_aktif = route('admin.user.active', Crypt::encryptString($action->id));
                $url_nonaktif = route('admin.user.nonactive', Crypt::encryptString($action->id));
                $url_delete = route('admin.user.destroy', Crypt::encryptString($action->id));
                if ($action->account_type != 'multirole') {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" title="Edit Pengguna">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data?\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_aktif . '" id="btn-aktif" title="Aktifkan Fitur Multirole">
                        <span class="material-symbols-outlined">supervisor_account</span></a>
                    </div>
                    ';
                } else {
                    $btn = '
                    <div class="d-flex flex-row">
                        <a href="' . $url_edit . '" class="mr-1" title="Edit Pengguna">
                        <span class="material-symbols-outlined">edit_square</span></a>
                        <form action="' . $url_delete . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <a href="#" onclick="event.preventDefault(); if(confirm(\'Yakin Hapus Data??\')) { this.closest(\'form\').submit(); }"><span class="material-symbols-outlined">delete</span>
                        </a>
                        </form>
                        <a href="' . $url_nonaktif . '" class="mr-1" id="btn-nonaktif" title="Nonaktifkan Fitur Multirole">
                        <span class="material-symbols-outlined">person</span></a>
                    </div>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['action', 'status','account_type'])
            ->addIndexColumn()
            ->make(true);
    }
}
