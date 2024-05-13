<?php

namespace Database\Seeders;

use App\Models\pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaturans = array(
            array(
                "key" => "Akses Usulan Pelatihan",
                "value" => "Open",
            ),
            array(
                "key" => "Akses Usulan Ujikom",
                "value" => "Open",
            ),
        );

        \DB::table('pengaturans')->insert($pengaturans);
    }
}
