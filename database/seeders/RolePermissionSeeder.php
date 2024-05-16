<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            array(
                "id" => 1,
                "name" => "jenis pelatihan view",
                "guard_name" => "admin",
                "group" => "Jenis Pelatihan",
                "created_at" => "2024-05-05 09:21:09",
                "updated_at" => "2024-05-05 09:21:09",
            ),
            array(
                "id" => 2,
                "name" => "jenis pelatihan create",
                "guard_name" => "admin",
                "group" => "Jenis Pelatihan",
                "created_at" => "2024-05-05 09:21:20",
                "updated_at" => "2024-05-05 09:21:20",
            ),
            array(
                "id" => 3,
                "name" => "jenis pelatihan update",
                "guard_name" => "admin",
                "group" => "Jenis Pelatihan",
                "created_at" => "2024-05-05 09:21:26",
                "updated_at" => "2024-05-05 09:21:26",
            ),
            array(
                "id" => 4,
                "name" => "jenis pelatihan delete",
                "guard_name" => "admin",
                "group" => "Jenis Pelatihan",
                "created_at" => "2024-05-05 09:21:32",
                "updated_at" => "2024-05-05 09:21:32",
            ),
            array(
                "id" => 5,
                "name" => "pelatihan view",
                "guard_name" => "admin",
                "group" => "Pelatihan",
                "created_at" => "2024-05-05 09:23:02",
                "updated_at" => "2024-05-05 09:23:02",
            ),
            array(
                "id" => 6,
                "name" => "pelatihan create",
                "guard_name" => "admin",
                "group" => "Pelatihan",
                "created_at" => "2024-05-05 09:23:03",
                "updated_at" => "2024-05-05 09:23:03",
            ),
            array(
                "id" => 7,
                "name" => "pelatihan update",
                "guard_name" => "admin",
                "group" => "Pelatihan",
                "created_at" => "2024-05-05 09:23:03",
                "updated_at" => "2024-05-05 09:23:03",
            ),
            array(
                "id" => 8,
                "name" => "pelatihan delete",
                "guard_name" => "admin",
                "group" => "Pelatihan",
                "created_at" => "2024-05-05 09:23:06",
                "updated_at" => "2024-05-05 09:23:06",
            ),
            array(
                "id" => 9,
                "name" => "jenis ujikom view",
                "guard_name" => "admin",
                "group" => "Jenis Ujikom",
                "created_at" => "2024-05-05 09:25:44",
                "updated_at" => "2024-05-05 09:25:44",
            ),
            array(
                "id" => 10,
                "name" => "jenis ujikom create",
                "guard_name" => "admin",
                "group" => "Jenis Ujikom",
                "created_at" => "2024-05-05 09:25:45",
                "updated_at" => "2024-05-05 09:25:45",
            ),
            array(
                "id" => 11,
                "name" => "jenis ujikom update",
                "guard_name" => "admin",
                "group" => "Jenis Ujikom",
                "created_at" => "2024-05-05 09:25:46",
                "updated_at" => "2024-05-05 09:25:46",
            ),
            array(
                "id" => 12,
                "name" => "jenis ujikom delete",
                "guard_name" => "admin",
                "group" => "Jenis Ujikom",
                "created_at" => "2024-05-05 09:25:46",
                "updated_at" => "2024-05-05 09:25:46",
            ),
            array(
                "id" => 13,
                "name" => "ujikom view",
                "guard_name" => "admin",
                "group" => "Ujikom",
                "created_at" => "2024-05-05 09:25:47",
                "updated_at" => "2024-05-05 09:25:47",
            ),
            array(
                "id" => 14,
                "name" => "ujikom create",
                "guard_name" => "admin",
                "group" => "Ujikom",
                "created_at" => "2024-05-05 09:25:48",
                "updated_at" => "2024-05-05 09:25:48",
            ),
            array(
                "id" => 15,
                "name" => "ujikom update",
                "guard_name" => "admin",
                "group" => "Ujikom",
                "created_at" => "2024-05-05 09:25:48",
                "updated_at" => "2024-05-05 09:25:48",
            ),
            array(
                "id" => 16,
                "name" => "ujikom delete",
                "guard_name" => "admin",
                "group" => "Ujikom",
                "created_at" => "2024-05-05 09:25:50",
                "updated_at" => "2024-05-05 09:25:50",
            ),
            array(
                "id" => 17,
                "name" => "usulan pelatihan view",
                "guard_name" => "admin",
                "group" => "Usulan Pelatihan",
                "created_at" => "2024-05-05 10:34:04",
                "updated_at" => "2024-05-05 10:34:04",
            ),
            array(
                "id" => 18,
                "name" => "usulan pelatihan create",
                "guard_name" => "admin",
                "group" => "Usulan Pelatihan",
                "created_at" => "2024-05-05 10:34:05",
                "updated_at" => "2024-05-05 10:34:05",
            ),
            array(
                "id" => 19,
                "name" => "usulan pelatihan update",
                "guard_name" => "admin",
                "group" => "Usulan Pelatihan",
                "created_at" => "2024-05-05 10:34:05",
                "updated_at" => "2024-05-05 10:34:05",
            ),
            array(
                "id" => 20,
                "name" => "usulan pelatihan delete",
                "guard_name" => "admin",
                "group" => "Usulan Pelatihan",
                "created_at" => "2024-05-05 10:34:08",
                "updated_at" => "2024-05-05 10:34:08",
            ),
            array(
                "id" => 21,
                "name" => "usulan ujikom view",
                "guard_name" => "admin",
                "group" => "Usulan Ujikom",
                "created_at" => "2024-05-05 10:35:05",
                "updated_at" => "2024-05-05 10:35:05",
            ),
            array(
                "id" => 22,
                "name" => "usulan ujikom create",
                "guard_name" => "admin",
                "group" => "Usulan Ujikom",
                "created_at" => "2024-05-05 10:35:06",
                "updated_at" => "2024-05-05 10:35:06",
            ),
            array(
                "id" => 23,
                "name" => "usulan ujikom update",
                "guard_name" => "admin",
                "group" => "Usulan Ujikom",
                "created_at" => "2024-05-05 10:35:07",
                "updated_at" => "2024-05-05 10:35:07",
            ),
            array(
                "id" => 24,
                "name" => "usulan ujikom delete",
                "guard_name" => "admin",
                "group" => "Usulan Ujikom",
                "created_at" => "2024-05-05 10:35:10",
                "updated_at" => "2024-05-05 10:35:10",
            ),
            array(
                "id" => 25,
                "name" => "manajemen akses",
                "guard_name" => "admin",
                "group" => "Manajemen Akses",
                "created_at" => "2024-05-05 10:39:01",
                "updated_at" => "2024-05-05 10:39:01",
            ),
        );

        \DB::table('permissions')->insert($permissions);

        $roles = array(
            array(
                "id" => 1,
                "name" => "Super Admin",
                "guard_name" => "admin",
                "created_at" => "2024-05-05 16:52:13",
                "updated_at" => "2024-05-05 16:52:13",
            ),
        );

        \DB::table('roles')->insert($roles);

        $role_has_permissions = array(
            array(
                "permission_id" => 1,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 2,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 3,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 4,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 5,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 6,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 7,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 8,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 9,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 10,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 11,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 12,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 13,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 14,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 15,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 16,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 17,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 18,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 19,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 20,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 21,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 22,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 23,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 24,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 25,
                "role_id" => 1,
            ),
        );

        \DB::table('role_has_permissions')->insert($role_has_permissions);

    }
}
