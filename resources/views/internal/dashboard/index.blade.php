@extends('internal.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dashboard Analisa Tahun <strong>{{ $yearNow }}</strong></h1>

        {{-- Start Usulan Pelatihan Tabel Jumlah by Unit Kerja --}}
        <div class="row">
            <div class="col-12">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                    <h5 class="card-title mb-0">Jumlah Usulan Pelatihan per Unit Kerja</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <table id="tbl_usulan_pelatihan" class="table table-hover table-sm table-responsive overflow-auto">
                                <thead>
                                    <tr>
                                        <th class="d-sm-table-cell">Instansi</th>
                                        <th class="d-xl-table-cell">Unit Kerja</th>
                                        <th class="d-sm-table-cell">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($tupByUk as $key => $count)
                                    @php
                                        [$instansi, $unit_kerja] = explode('|', $key);
                                    @endphp
                                        <tr>
                                            <td class="d-sm-table-cell">{{ $instansi }}</td>
                                            <td class="d-xl-table-cell">{{ $unit_kerja }}</td>
                                            <td class="d-sm-table-cell">{{ $count }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- End Tabel Jumlah by Unit Kerja --}}

    {{-- Start Usulan Ujikom Tabel Jumlah by Unit Kerja --}}
        <div class="row">
            <div class="col-12">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                    <h5 class="card-title mb-0">Jumlah Usulan Ujikom per Unit Kerja</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <table id="tbl_usulan_ujikom" class="table table-hover table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th class="d-sm-table-cell">Instansi</th>
                                        <th class="d-xl-table-cell">Unit Kerja</th>
                                        <th class="d-sm-table-cell">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($tuuByUk as $key => $count)
                                    @php
                                        [$instansi, $unit_kerja] = explode('|', $key);
                                    @endphp
                                        <tr>
                                            <td class="d-sm-table-cell">{{ $instansi }}</td>
                                            <td class="d-xl-table-cell">{{ $unit_kerja }}</td>
                                            <td class="d-sm-table-cell">{{ $count }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- End Tabel Jumlah by Unit Kerja --}}

    </div>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function() {
            var data = {!! $tupByUk->toJson() !!};

            $('#tbl_usulan_pelatihan').DataTable({
                language: {
                    search: 'Cari:',
                    info: 'Halaman _PAGE_ dari _PAGES_',
                    infoEmpty: 'Data tidak tersedia',
                    infoFiltered: '(filter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ baris per halaman',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: "Tidak ada data yang tersedia dalam tabel",
                },
                searching:false,
                lengthMenu: [[10, 100, 1000, -1], [10, 100, 1000, "Semua"]],
                data: Object.entries(data).map(([key, value]) => {
                    var [instansi, unit_kerja] = key.split('|');
                    return { instansi, unit_kerja, jumlah_usulan: value };
                }),
                columns: [
                    { data: 'instansi' },
                    { data: 'unit_kerja' },
                    { data: 'jumlah_usulan' }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var data = {!! $tuuByUk->toJson() !!};

            $('#tbl_usulan_ujikom').DataTable({
                language: {
                    search: 'Cari:',
                    info: 'Halaman _PAGE_ dari _PAGES_',
                    infoEmpty: 'Data tidak tersedia',
                    infoFiltered: '(filter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ baris per halaman',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: "Tidak ada data yang tersedia dalam tabel",
                },
                searching:false,
                lengthMenu: [[10, 100, 1000, -1], [10, 100, 1000, "Semua"]],
                data: Object.entries(data).map(([key, value]) => {
                    var [instansi, unit_kerja] = key.split('|');
                    return { instansi, unit_kerja, jumlah_usulan: value };
                }),
                columns: [
                    { data: 'instansi' },
                    { data: 'unit_kerja' },
                    { data: 'jumlah_usulan' }
                ]
            });
        });
    </script>
@endpush
