@extends('admin.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Master Roles</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Semua Roles</h5>
                        <div class="btn-group mb-3" role="group" aria-label="Default button group">
                            <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Start Table --}}
                        <div class="table-responsive">
                            <table class="table table-hover my-0" id="tbl_roles">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="d-none d-xl-table-cell">Role</th>
                                        <th class="d-none d-xl-table-cell">Permissions</th>
                                        <th class="d-none d-xl-table-cell">Tanggal Update</th>
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
            var table = $('#tbl_roles').DataTable({
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
                ajax: "{{ route('admin.role.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'permissions', name: 'permissions'},
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
