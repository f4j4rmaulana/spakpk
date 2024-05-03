@extends('admin.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Data Usulan Uji Kompetensi</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Semua Usulan Uji Kompetensi</h5>
                    <div class="btn-group mb-3" role="group" aria-label="Default button group">
                        <a href="{{ route('admin.usulan-ujikom.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Start Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover my-0" id="tbl_usulan_ujikom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengusul</th>
                                    <th>Instansi</th>
                                    <th>Unit Kerja</th>
                                    <th>Jenis Ujikom</th>
                                    <th>Usulan Ujikom</th>
                                    <th>Usulan Lainnya</th>
                                    <th>Status</th>
                                    <th>Tanggal Usul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="th">Pengusul</th>
                                    <th class="th">Instansi</th>
                                    <th class="th">Unit Kerja</th>
                                    <th class="th">Jenis Ujikom</th>
                                    <th class="th">Usulan Ujikom</th>
                                    <th class="th">Usulan Lainnya</th>
                                    <th class="th">Status</th>
                                    <th class="th">Tanggal Usul</th>
                                    <th></th>
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
            var table = $('#tbl_usulan_ujikom').DataTable({
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
                processing: false,
                serverSide: true,
                paging: true,
                ajax: "{{ route('admin.usulan-ujikom.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'usulan_user.name', name: 'usulan_user.name'},
                    {data: 'usulan_user.instansi', name: 'usulan_user.instansi'},
                    {data: 'usulan_user.unit_kerja', name: 'usulan_user.unit_kerja'},
                    {data: 'usulan_jenis_ujikom.nama', name: 'usulan_jenis_ujikom.nama'},
                    {data: 'usulan_ujikom.nama', name: 'usulan_ujikom.nama'},
                    {data: 'usulan_lainnya', name: 'usulan_lainnya'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;
                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                }
            });

            $('#tbl_usulan_ujikom tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control shadow" placeholder="cari" />');
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-validasi', function (e) {
            e.preventDefault();
            var url = $(this).data('url'); // Mengambil URL dari data-url
            var token = "{{ csrf_token() }}";

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: token
                },
                success: function (response) {
                    // Menampilkan pesan sukses dengan nama pengusul
                    alert('Usulan ujikom berhasil divalidasi!');
                    // Refresh data tabel jika diperlukan
                    $('#tbl_usulan_ujikom').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    // Tampilkan pesan error atau lakukan tindakan lain jika diperlukan
                    alert('Gagal melakukan validasi usulan!');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-nonvalidasi', function (e) {
            e.preventDefault();
            var url = $(this).data('url'); // Mengambil URL dari data-url
            var token = "{{ csrf_token() }}";

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: token
                },
                success: function (response) {
                    // Menampilkan pesan sukses dengan nama pengusul
                    alert('Validasi usulan ujikom berhasil dibatalkan!');
                    // Refresh data tabel jika diperlukan
                    $('#tbl_usulan_ujikom').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    // Tampilkan pesan error atau lakukan tindakan lain jika diperlukan
                    alert('Gagal melakukan pembatalan validasi usulan!');
                }
            });
        });
    </script>
@endpush
