<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RolePermissionController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:manajemen akses']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $titles = 'Roles';
        return view('admin.manajemen-akses.role.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = 'Tambah Roles';
        $permissions = Permission::all()->groupBy('group');
        return view('admin.manajemen-akses.role.create', compact('titles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:50', 'unique:roles,name']
        ]);

             /** Create Role */
            $role = Role::create([
                'guard_name' => 'admin',
                'name' => $request->name
            ]);

            /** Assign permissions to role */
            $role->syncPermissions($request->permissions);

            toast('Role berhasil tersimpan!','success');
            return to_route('admin.role.index');

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
        $titles = 'Edit Roles';
        $decrypted = Crypt::decryptString($id);
        $role = Role::findOrFail($decrypted);
        $permissions = Permission::all()->groupBy('group');
        $rolePermissions = $role->permissions;
        $rolePermissions = $rolePermissions->pluck('name')->toArray();

        return view('admin.manajemen-akses.role.edit', compact('titles', 'permissions', 'role', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:50']
        ]);

            $decrypted = Crypt::decryptString($id);
            $role = Role::findOrFail($decrypted);
            $role->update([
                'guard_name' => 'admin',
                'name' => $request->name
            ]);

            /** Assign permissions to role */
            $role->syncPermissions($request->permissions);

            toast('Role berhasil tersimpan!','success');
            return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $decrypted = Crypt::decryptString($id);
            $role = Role::with('permissions')->findOrFail($decrypted);
            $namaRole = $role->name;
            $role->delete();
            DB::commit();
            toast('Role "'.$namaRole.'" berhasil dihapus!','success');
            return redirect()->route('admin.role.index');
        }catch(\Exception $e) {
            DB::rollback();
            logger($e);
            toast('Error hapus data!','error');
            return redirect()->route('admin.role.index');
        }
    }

        // Ajax Datatable
        public function ajax() {
            $data = Role::with('permissions')->latest()->get();
            return DataTables::of($data)
                ->editColumn('permissions', function ($role) {
                    $badges = '';
                    foreach ($role->permissions as $permission) {
                        $badges .= '<span class="badge bg-info">' . $permission->name . '</span> ';
                    }
                    return $badges;
                })
                ->editColumn('updated_at', function ($updated) {
                    return \Carbon\Carbon::parse($updated->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm ' . strtoupper('A'));
                })
                ->addColumn('action', function ($action) {
                    $url_edit = route('admin.role.edit', Crypt::encryptString($action->id));
                    $url_delete = route('admin.role.destroy', Crypt::encryptString($action->id));
                    if ($action->name !== 'Super Admin') {
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
                    return $btn;
                })
                // permissions add to rawcolumn for html view
                ->rawColumns(['action', 'permissions'])
                ->addIndexColumn()
                ->make(true);
        }
}
