@extends('admin.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Master Jenis Uji Kompetensi</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Semua Jenis Uji Kompetensi</h5>
                    <div class="btn-group mb-3" role="group" aria-label="Default button group">
                        <a href="{{ route('admin.jenis-ujikom.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Start Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover my-0" id="tbl_jenis_ujikom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="d-none d-xl-table-cell">Jenis Ujikom</th>
                                    <th class="d-none d-xl-table-cell">Deskripsi</th>
                                    <th class="d-none d-md-table-cell">Status</th>
                                    <th>Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><input id="column1_search" type="text" placeholder="Tampilkan Nama"></th>
                                    <th><input id="column2_search" type="text" placeholder="Tampilkan Deskripsi"></th>
                                    <th>Status</th>
                                    <th>Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(function () {
            var table = $('#tbl_jenis_ujikom').DataTable({
                language: {
                    search: 'Cari:',
                    info: 'Halaman _PAGE_ dari _PAGES_',
                    infoEmpty: 'Data tidak tersedia',
                    infoFiltered: '(filter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ baris per halaman',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: "Tidak ada data yang tersedia dalam tabel",
                },
                lengthMenu: [[10, 100, 1000, -1], [10, 100, 1000, "Semua"]],
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.jenis-ujikom.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'deskripsi', name: 'deskripsi'},
                    {data: 'status', name: 'status'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ]
            });

            // Membuat individual search untuk kolom 'nama' dan 'deskripsi'
            $('#column1_search, #column2_search').on('keyup', function () {
                table
                    .columns([1, 2]) // Indeks kolom 'nama' dan 'deskripsi'
                    .search(this.value)
                    .draw();
            });
                // Menambahkan event listener untuk menangani pembuatan ulang tabel setelah selesai memuat
                table.on('draw', function () {
                // Debugging
                console.log('Tabel diperbarui');
            });
        });
    </script>


@endpush
