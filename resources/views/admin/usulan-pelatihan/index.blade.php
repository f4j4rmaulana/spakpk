@extends('admin.layouts.master')

@push('modal-styles')
    <script src="{{ asset('backend/assets/plugin/jquery-modal-master/jquery-3.0.0.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugin/jquery-modal-master/jquery.modal.min.js') }}"></script>
    <link href="{{ asset('backend/assets/plugin/jquery-modal-master/jquery.modal.min.css') }}" rel="stylesheet">
@endpush

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Data Usulan Pelatihan</h1>

    <div class="row">

        {{-- Start Modal Export --}}
            <div id="export_modal" class="modal">
                {{-- Start Report Usulan Pelatihan --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Cetak Laporan Usulan Pelatihan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.usulan-pelatihan.export') }}" method="POST">
                                @csrf
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Tanggal Awal</label>
                                        <input type="date" class="form-control form-control-lg {{ hasError($errors, 'start_date') }}" id="start_date" name="start_date" value="{{old('start_date')}}" required autofocus>
                                        <x-input-error :messages="$errors->get('start_date')" class="mt-1" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                                            <input type="date" class="form-control form-control-lg {{ hasError($errors, 'end_date') }}" id="end_date" name="end_date" value="{{old('end_date')}}" required autofocus>
                                            <x-input-error :messages="$errors->get('end_date')" class="mt-1" />
                                        </div>

                                <button class="btn btn-dark" type="submit">Export Excel</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Report Usulan Pelatihan --}}
            </div>
        {{-- End Modal Export --}}

        {{-- Start Modal Import --}}
            <div id="import_modal" class="modal">
                <form action="{{ route('admin.usulan-pelatihan.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file_import" class="form-label">Unggah File (excel/csv)</label>
                        <input class="form-control form-control-lg {{ hasError($errors, 'file') }}" type="file" name="file_import" accept=".xlsx,.csv">
                        <x-input-error :messages="$errors->get('file_import')" class="mt-1" />
                    </div>
                    <button class="btn btn-dark" type="submit">Proses Import</button>
                </form>
                {{-- <a href="#" rel="modal:close">Close</a> --}}
            </div>
        {{-- End Modal Import --}}

        {{-- Start Data Usulan Pelatihan --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Semua Usulan Pelatihan</h5>

                    <div class="btn-group mb-3 d-flex gap-2" role="group" aria-label="Default button group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="align-middle" data-feather="git-pull-request" >
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item align-middle" href="#export_modal" rel="modal:open">
                                        <i class="align-middle" data-feather="file-text" ></i>&nbsp;&nbsp;Export Excel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item align-middle" href="#import_modal" rel="modal:open">
                                        <i class="align-middle" data-feather="upload" ></i>&nbsp;&nbsp;Import Excel
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('admin.usulan-pelatihan.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>

                </div>
                <div class="card-body">
                    {{-- Start Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover my-0" id="tbl_usulan_pelatihan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengusul</th>
                                    <th>Instansi</th>
                                    <th>Unit Kerja</th>
                                    <th>Jenis Pelatihan</th>
                                    <th>Usulan Pelatihan</th>
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
                                    <th class="th">Jenis Pelatihan</th>
                                    <th class="th">Usulan Pelatihan</th>
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
        {{-- End Data Usulan Pelatihan --}}
    </div>

</div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(function () {
            var table = $('#tbl_usulan_pelatihan').DataTable({
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
                paging: true,
                ajax: "{{ route('admin.usulan-pelatihan.ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'usulan_user.name', name: 'usulan_user.name'},
                    {data: 'usulan_user.instansi', name: 'usulan_user.instansi'},
                    {data: 'usulan_user.unit_kerja', name: 'usulan_user.unit_kerja'},
                    {data: 'usulan_jenis_pelatihan.nama', name: 'usulan_jenis_pelatihan.nama'},
                    {data: 'usulan_pelatihan.nama', name: 'usulan_pelatihan.nama'},
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

            $('#tbl_usulan_pelatihan tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control shadow" placeholder="cari" />');
            });
                // Menambahkan event listener untuk menangani pembuatan ulang tabel setelah selesai memuat
                table.on('draw', function () {
                // Debugging
                console.log('Tabel diperbarui');
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
                    alert('Usulan pelatihan berhasil divalidasi!');
                    // Refresh data tabel jika diperlukan
                    $('#tbl_usulan_pelatihan').DataTable().ajax.reload();
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
                    alert('Validasi usulan pelatihan berhasil dibatalkan!');
                    // Refresh data tabel jika diperlukan
                    $('#tbl_usulan_pelatihan').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    // Tampilkan pesan error atau lakukan tindakan lain jika diperlukan
                    alert('Gagal melakukan pembatalan validasi usulan!');
                }
            });
        });
    </script>
@endpush





