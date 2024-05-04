<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Pelatihan;
use App\Models\JenisPelatihan;
use App\Models\UsulanPelatihan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsulanPelatihanImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
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

                // Ambil jenis pelatihan berdasarkan nama
                $jenisPelatihan = JenisPelatihan::where('nama', $row['nama_jenis_pelatihan'])->first();

                // Jika jenis pelatihan tidak ditemukan, batalkan impor
                if (!$jenisPelatihan) {
                    // Rollback transaksi
                    DB::rollBack();

                    // Kembalikan pesan error
                    throw new \Exception('Jenis pelatihan dengan nama ' . $row['nama_jenis_pelatihan'] . ' tidak ditemukan.');
                }

                // Ambil pelatihan berdasarkan nama
                $pelatihan = Pelatihan::where('nama', $row['nama_pelatihan'])->first();

                // Jika pelatihan tidak ditemukan, batalkan impor
                if (!$pelatihan) {
                    // Rollback transaksi
                    DB::rollBack();

                    // Kembalikan pesan error
                    throw new \Exception('Pelatihan dengan nama ' . $row['nama_pelatihan'] . ' tidak ditemukan.');
                }

                // Simpan record UsulanPelatihan
                UsulanPelatihan::create([
                    'nama' => $row['nama_pelatihan'],
                    // Sesuaikan dengan atribut-atribut lainnya
                    'user_id' => $user->id,
                    'jenis_pelatihan_id' => $jenisPelatihan->id,
                    'pelatihan_id' => $pelatihan->id,
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

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
