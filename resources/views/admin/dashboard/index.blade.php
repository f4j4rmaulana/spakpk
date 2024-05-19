@extends('admin.layouts.master')

@push('custom-styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('backend/assets/plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/plugin/DataTables/datatables.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Dashboard</strong> Analisa</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Dashboard</h5>
            </div>
                <div class="card-body py-3">
                        <form action="{{ route('admin.dashboard') }}" method="GET">
                            @csrf
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control form-control-lg {{ hasError($errors, 'start_date') }}" id="start_date" name="start_date" value="{{ old('start_date', Carbon\Carbon::now()->startOfMonth()->toDateString()) }}" required autofocus>
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-1" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control form-control-lg {{ hasError($errors, 'end_date') }}" id="end_date" name="end_date" value="{{ old('end_date', Carbon\Carbon::now()->endOfMonth()->toDateString()) }}" required autofocus>
                                        <x-input-error :messages="$errors->get('end_date')" class="mt-1" />
                                    </div>
                                    <div class="d-flex align-items-end flex-column">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                        <h5 class="card-title">Usulan Pelatihan</h5>
                        </div>

                        <div class="col-auto">
                        <div class="stat text-primary">
                            <i
                            class="align-middle"
                            data-feather="truck"
                            ></i>
                        </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $tupAll }}</h1>
                        @if ($tupDiff > 0)
                            <div class="mb-0">
                                <span class="text-success">
                                <i class="mdi mdi-arrow-up-right"></i>+ {{ $tupDiff }}
                                </span>
                                <span class="text-muted">Sejak bulan lalu</span>
                            </div>
                        @else
                            <div class="mb-0">
                                <span class="text-danger">
                                <i class="mdi mdi-arrow-up-right"></i>- {{ $tupDiff }}
                                </span>
                                <span class="text-muted">Sejak bulan lalu</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                        <h5 class="card-title">Validasi Usulan Pelatihan</h5>
                        </div>

                        <div class="col-auto">
                        <div class="stat text-primary">
                            <i
                            class="align-middle"
                            data-feather="users"
                            ></i>
                        </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $tupAllVal }}</h1>
                        <div class="mb-0">
                            <span class="text-danger">
                            <i class="mdi mdi-arrow-up-right"></i>{{ $tupAllNonVal }}
                            </span>
                            <span class="text-muted">Belum validasi</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                        <h5 class="card-title">Usulan Ujikom</h5>
                        </div>

                        <div class="col-auto">
                        <div class="stat text-primary">
                            <i
                            class="align-middle"
                            data-feather="dollar-sign"
                            ></i>
                        </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $tuuAll }}</h1>
                        @if ($tuuDiff >= 0)
                            <div class="mb-0">
                                <span class="text-success">
                                <i class="mdi mdi-arrow-up-right"></i>+ {{ $tuuDiff }}
                                </span>
                                <span class="text-muted">Sejak bulan lalu</span>
                            </div>
                        @else
                            <div class="mb-0">
                                <span class="text-danger">
                                <i class="mdi mdi-arrow-up-right"></i>- {{ $tuuDiff }}
                                </span>
                                <span class="text-muted">Sejak bulan lalu</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                        <h5 class="card-title">Validasi Usulan Ujikom</h5>
                        </div>

                        <div class="col-auto">
                        <div class="stat text-primary">
                            <i
                            class="align-middle"
                            data-feather="shopping-cart"
                            ></i>
                        </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $tuuAllVal }}</h1>
                        <div class="mb-0">
                            <span class="text-danger">
                            <i class="mdi mdi-arrow-up-right"></i>{{ $tuuAllNonVal }}
                            </span>
                            <span class="text-muted">Belum validasi</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

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

    {{-- Start Chart --}}
        <div class="row">
            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                    <h5 class="card-title mb-0">Grafik Persentase Usulan per Jenis Pelatihan</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="jenisPelatihanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                    <h5 class="card-title mb-0">Grafik Persentase Usulan per Uji Kompetensi</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="jenisUjikomChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- End Chart --}}

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
        var ctx = document.getElementById('jenisPelatihanChart').getContext('2d');
        var jenisPelatihanChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($cupByJp->keys()) !!},
                datasets: [{
                    label: 'Jumlah Usulan per Jenis Pelatihan',
                    data: {!! json_encode($cupByJp->values()) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return percentage + "%";
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('jenisUjikomChart').getContext('2d');
        var jenisUjikomChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($cuuByJp->keys()) !!},
                datasets: [{
                    label: 'Jumlah Usulan per Jenis Ujikom',
                    data: {!! json_encode($cuuByJp->values()) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return percentage + "%";
                        }
                    }
                }
            }
        });
    </script>
@endpush
