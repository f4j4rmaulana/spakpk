@extends('admin.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Notifikasi</h1>

        <div class="row">
            <div class="col-12">
                <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Semua Notifikasi</h5>
                </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table id="tbl_notifications" class="table border-0 table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Info</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(function () {
            var table = $('#tbl_notifications').DataTable({
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
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.notifikasi.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'data.message', name: 'data.message'},
                    {data: 'created_at', name: 'created_at'},
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
