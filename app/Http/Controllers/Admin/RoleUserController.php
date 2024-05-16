<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = 'Role User';
        return view('admin.manajemen-akses.role-user.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Admin User';
        $roles = Role::all();
        return view('admin.manajemen-akses.role-user.create', compact('titles', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:admins,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        // Adding permissions via a role
        $admin->assignRole($request->role);

        toast('Data Admin User berhasil tersimpan!','success');
        return to_route('admin.role-user.index');
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
        $titles = 'Edit Admin User';
        $decrypted = Crypt::decryptString($id);
        $admin = Admin::findOrFail($decrypted);
        $roles = Role::all();
        return view('admin.manajemen-akses.role-user.edit', compact('titles', 'roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'lowercase', 'unique:admins,email,'.$id],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $decrypted = Crypt::decryptString($id);
        $admin = Admin::findOrFail($decrypted);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password) $admin->password = bcrypt($request->password);
        $admin->save();

        // Adding permissions via a role
        $admin->syncRoles($request->role);

        toast('Data Admin User berhasil tersimpan!','success');
        return to_route('admin.role-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $decrypted = Crypt::decryptString($id);
            $admin = Admin::findOrFail($decrypted);
            if($admin->getRoleNames()->first() === 'Super Admin') {
                DB::rollback();
                toast('Error tidak bisa hapus Super Admin!','error');
                return redirect()->route('admin.role-user.index');
            };
            $namaAdmin = $admin->name;
            $admin->delete();
            DB::commit();
            toast('Admin "'.$namaAdmin.'" berhasil dihapus!','success');
            return redirect()->route('admin.role-user.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('admin.role-user.index');
        }
    }

    // Ajax Datatable
    public function ajax() {
        $data = Admin::with('roles')->latest()->get();
        return DataTables::of($data)
            // any variable name to pass param datatables
            ->editColumn('role', function ($data) {
                $badges = '';
                foreach ($data->roles as $role) {
                    // Ambil nama peran dari relasi dan tambahkan ke badge
                    $badges .= '<span class="badge bg-info">' . $role->name . '</span> ';
                }
                return $badges;
            })
            ->editColumn('updated_at', function ($updated) {
                return \Carbon\Carbon::parse($updated->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
            })
            ->addColumn('action', function ($action) {
                $url_edit = route('admin.role-user.edit', Crypt::encryptString($action->id));
                $url_delete = route('admin.role-user.destroy', Crypt::encryptString($action->id));
                foreach ($action->roles as $role) {
                    if ($role->name !== 'Super Admin') {
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
                        </div>
                        ';
                    } else {
                        $btn = '';
                    }
                }
                return $btn;
            })
            // permissions add to rawcolumn for html view
            ->rawColumns(['action', 'role'])
            ->addIndexColumn()
            ->make(true);
    }
}
