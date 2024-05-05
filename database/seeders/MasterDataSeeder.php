<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_pelatihans = array(
            array(
                "nama" => "Pelatihan Teknis",
                "deskripsi" => "Pelatihan Teknis",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Manajerial",
                "deskripsi" => "Pelatihan Manajerial",
                "status" => "Tidak Aktif",
            ),
            array(
                "nama" => "Pelatihan Sosio Kultural",
                "deskripsi" => "Pelatihan Sosio Kultural",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Sertifikasi",
                "deskripsi" => "Pelatihan Sertifikasi",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Jenis Pelatihan Lainnya",
                "deskripsi" => "Pilih jenis pelatihan ini jika belum terdapat jenis pelatihan yang sesuai pada list",
                "status" => "Aktif",
            ),
        );

        \DB::table('jenis_pelatihans')->insert($jenis_pelatihans);

        $pelatihans = array(
            array(
                "nama" => "Pelatihan Basic Drone",
                "deskripsi" => "Pelatihan mengenai penggunaan basic drone",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Pemetaan",
                "deskripsi" => "Pelatihan tentang seluruh materi mengenai pemetaan",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Anti Korupsi",
                "deskripsi" => "Pelatihan tentang seluruh materi mengenai anti korupsi",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Manajemen ASN",
                "deskripsi" => "Pelatihan tentang seluruh materi mengenai manajemen ASN",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Dasar Menyelam",
                "deskripsi" => "Pelatihan tentang seluruh materi mengenai dasar menyelam",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Dasar Python",
                "deskripsi" => "Pelatihan tentang seluruh materi mengenai dasar python",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Pelatihan Lainnya",
                "deskripsi" => "Pilih pelatihan ini jika belum terdapat pelatihan yang sesuai pada list, kemudian isi usulan pelatihan lainnya",
                "status" => "Aktif",
            ),
        );

        \DB::table('pelatihans')->insert($pelatihans);

        $jenis_ujikoms = array(
            array(
                "nama" => "Uji Kompetensi JF",
                "deskripsi" => "Uji Kompetensi untuk jabatan fungsional pada instansi BIG",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi ASN",
                "deskripsi" => "Uji Kompetensi untuk ASN pada instansi BIG",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Sertifikasi",
                "deskripsi" => "Uji Kompetensi sertifikasi untuk ASN pada instansi BIG",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Keahlian",
                "deskripsi" => "Uji Kompetensi keahlian untuk ASN pada instansi BIG",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Teknis",
                "deskripsi" => "Uji Kompetensi teknis untuk ASN pada instansi BIG",
                "status" => "Aktif",
            ),
        );

        \DB::table('jenis_ujikoms')->insert($jenis_ujikoms);

        $ujikoms = array(
            array(
                "nama" => "Uji Kompetensi Teknis Pemrograman Python",
                "deskripsi" => "Uji Kompetensi teknis pemrograman python",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Sertifikasi Arcgis",
                "deskripsi" => "Uji Kompetensi sertifikasi arcgis",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Teknis Pemetaan",
                "deskripsi" => "Uji Kompetensi teknis pemetaan dasar",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Jf Pranata Humas",
                "deskripsi" => "Uji Kompetensi ini berlaku bagi para JF Pranata Humas",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Jf Pranata Komputer",
                "deskripsi" => "Uji Kompetensi ini berlaku bagi para JF Pranata Komputer",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Jf Asesor SDM",
                "deskripsi" => "Uji Kompetensi ini berlaku bagi para JF Asesor SDM",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Uji Kompetensi Jf Widyaiswara",
                "deskripsi" => "Uji Kompetensi ini berlaku bagi para JF Widyaiswara",
                "status" => "Aktif",
            ),
            array(
                "nama" => "Ujikom Lainnya",
                "deskripsi" => "Pilih uji kompetensi ini jika belum terdapat pelatihan yang sesuai pada list, kemudian isi usulan pelatihan lainnya",
                "status" => "Aktif",
            ),
        );

        \DB::table('ujikoms')->insert($ujikoms);

    }
}
