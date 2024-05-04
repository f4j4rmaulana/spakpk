<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsulanUjikomExport implements FromCollection, WithMapping, WithHeadings
{

    // from $filteredData ExportController
    protected $usulanUjikoms;

    public function __construct($usulanUjikoms)
    {
        $this->usulanUjikoms = $usulanUjikoms;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->usulanUjikoms;
    }

    public function map($usulanUjikom): array
    {
        return [
            $usulanUjikom->id,
            $usulanUjikom->usulanUser->name,
            $usulanUjikom->usulanUser->instansi,
            $usulanUjikom->usulanUser->unit_kerja,
            $usulanUjikom->usulanUser->jabatan,
            $usulanUjikom->usulanJenisUjikom->nama,
            $usulanUjikom->usulanUjikom->nama,
            $usulanUjikom->status,
            $usulanUjikom->created_at,

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
            'Jenis Ujikom',
            'Nama Ujikom',
            'Status',
            'Tanggal usulan',

        ];
    }
}

