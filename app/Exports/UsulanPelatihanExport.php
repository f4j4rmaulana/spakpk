<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsulanPelatihanExport implements FromCollection, WithMapping, WithHeadings
{

    // from $filteredData ExportController
    protected $usulanPelatihans;

    public function __construct($usulanPelatihans)
    {
        $this->usulanPelatihans = $usulanPelatihans;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->usulanPelatihans;
    }

    public function map($usulanPelatihan): array
    {
        // usulanUser, UsulanJenisPelatihan, usulanPelatihan function from relationship on UsulanPelatihan model
        return [
            $usulanPelatihan->id,
            $usulanPelatihan->usulanUser->name,
            $usulanPelatihan->usulanUser->instansi,
            $usulanPelatihan->usulanUser->unit_kerja,
            $usulanPelatihan->usulanUser->jabatan,
            $usulanPelatihan->usulanJenisPelatihan->nama,
            $usulanPelatihan->usulanPelatihan->nama,
            $usulanPelatihan->status,
            $usulanPelatihan->created_at,

        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pengusul',
            'Instansi',
            'Unit Kerja',
            'Jabatan',
            'Jenis Pelatihan',
            'Nama Pelatihan',
            'Status',
            'Tanggal usulan',

        ];
    }
}
