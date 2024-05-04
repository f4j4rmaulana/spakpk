<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Ujikom;
use App\Models\JenisUjikom;
use App\Models\UsulanUjikom;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsulanUjikomImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                // Ambil data pengguna berdasarkan email
                $user = User::where('email', $row['email'])->first();

                // Jika pengguna tidak ditemukan, batalkan impor
                if (!$user) {
                    // Rollback transaksi
                    DB::rollBack();

                    // Kembalikan pesan error
                    throw new \Exception('Pengguna dengan email ' . $row['email'] . ' tidak ditemukan.');
                }

                // Ambil jenis ujikom berdasarkan nama
                $jenisUjikom = JenisUjikom::where('nama', $row['nama_jenis_ujikom'])->first();

                // Jika jenis ujikom tidak ditemukan, batalkan impor
                if (!$jenisUjikom) {
                    // Rollback transaksi
                    DB::rollBack();

                    // Kembalikan pesan error
                    throw new \Exception('Jenis ujikom dengan nama ' . $row['nama_jenis_ujikom'] . ' tidak ditemukan.');
                }

                // Ambil ujikom berdasarkan nama
                $ujikom = Ujikom::where('nama', $row['nama_ujikom'])->first();

                // Jika ujikom tidak ditemukan, batalkan impor
                if (!$ujikom) {
                    // Rollback transaksi
                    DB::rollBack();

                    // Kembalikan pesan error
                    throw new \Exception('Ujikom dengan nama ' . $row['nama_ujikom'] . ' tidak ditemukan.');
                }

                // Simpan record UsulanUjikom
                UsulanUjikom::create([
                    'nama' => $row['nama_ujikom'],
                    // Sesuaikan dengan atribut-atribut lainnya
                    'user_id' => $user->id,
                    'jenis_ujikom_id' => $jenisUjikom->id,
                    'ujikom_id' => $ujikom->id,
                    'usulan_lainnya' => $row['usulan_lainnya'],
                ]);
            }

            // Commit transaksi jika tidak ada kesalahan
            DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan, misalnya log pesan error atau kirim pesan ke pengguna
            // Kemudian hentikan proses impor dengan melempar pengecualian
            logger('error proses cek data import!!');
            throw $e;
        }
    }
}
