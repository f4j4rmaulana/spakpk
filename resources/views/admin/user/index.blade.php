@extends('admin.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Master User Role</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Semua User Role</h5>
                    <div class="btn-group mb-3" role="group" aria-label="Default button group">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Start Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover my-0" id="tbl_user">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Id</th>
                                    <th>Instansi</th>
                                    <th>Unit Kerja</th>
                                    <th>Jabatan</th>
                                    <th>Grup</th>
                                    <th>Tipe Akun</th>
                                    <th>Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

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
            var table = $('#tbl_user').DataTable({
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
                ajax: "{{ route('admin.user.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'nomor_id', name: 'nomor_id'},
                    {data: 'instansi', name: 'instansi'},
                    {data: 'unit_kerja', name: 'unit_kerja'},
                    {data: 'jabatan', name: 'jabatan'},
                    {data: 'role', name: 'role'},
                    {data: 'account_type', name: 'account_type'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ]
            });

            // Menambahkan event listener untuk menangani pembuatan ulang tabel setelah selesai memuat
            table.on('draw', function () {
                // Debugging
                console.log('Tabel diperbarui');
            });
        });
    </script>


@endpush
