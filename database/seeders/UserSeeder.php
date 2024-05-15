<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array(
                "id" => 1,
                "name" => "User Eksternal",
                "email" => "usereks@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('password'),
                "remember_token" => NULL,
                "created_at" => "2024-05-07 10:41:05",
                "updated_at" => "2024-05-08 13:34:25",
                "image" => "/gambar/pengguna/media_663b1cf1d6e1f.png",
                "username" => NULL,
                "role" => "eksternal",
                "nomor_id" => "12345678910",
                "instansi" => "BIG",
                "unit_kerja" => "Pusat A",
                "jabatan" => "Kepala Bidang",
                "guid" => NULL,
                "domain" => NULL,
            ),
            array(
                "id" => 2,
                "name" => "User Eksternal A",
                "email" => "usereksa@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('password'),
                "remember_token" => NULL,
                "created_at" => "2024-05-07 10:41:05",
                "updated_at" => "2024-05-08 13:34:25",
                "image" => "/gambar/pengguna/media_663b1cf1d6e1f.png",
                "username" => NULL,
                "role" => "eksternal",
                "nomor_id" => "9999999999",
                "instansi" => "BIG",
                "unit_kerja" => "Pusat A",
                "jabatan" => "Kepala Bidang",
                "guid" => NULL,
                "domain" => NULL,
            ),
            array(
                "id" => 3,
                "name" => "User Eksternal B",
                "email" => "usereksb@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('password'),
                "remember_token" => NULL,
                "created_at" => "2024-05-07 11:44:45",
                "updated_at" => "2024-05-07 11:44:45",
                "image" => "/gambar/pengguna/avatar.png",
                "username" => NULL,
                "role" => "eksternal",
                "nomor_id" => "12121212121",
                "instansi" => "BIG",
                "unit_kerja" => "Pusat B",
                "jabatan" => "Kepala Bidang",
                "guid" => NULL,
                "domain" => NULL,
            ),
            array(
                "id" => 4,
                "name" => "User Eksternal C",
                "email" => "usereksc@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('password'),
                "remember_token" => NULL,
                "created_at" => "2024-05-07 11:56:23",
                "updated_at" => "2024-05-07 11:56:23",
                "image" => "/gambar/pengguna/avatar.png",
                "username" => NULL,
                "role" => "eksternal",
                "nomor_id" => "11111111111",
                "instansi" => "BIG",
                "unit_kerja" => "Pusat C",
                "jabatan" => "Kepala Bidang",
                "guid" => NULL,
                "domain" => NULL,
            ),
            array(
                "id" => 5,
                "name" => "User Eksternal D",
                "email" => "usereksd@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('password'),
                "remember_token" => NULL,
                "created_at" => "2024-05-07 11:56:23",
                "updated_at" => "2024-05-07 11:56:23",
                "image" => "/gambar/pengguna/avatar.png",
                "username" => NULL,
                "role" => "eksternal",
                "nomor_id" => "33333333333",
                "instansi" => "BIG",
                "unit_kerja" => "Pusat D",
                "jabatan" => "Kepala Bidang",
                "guid" => NULL,
                "domain" => NULL,
            ),
        );
        \DB::table('users')->insert($users);
    }
}
