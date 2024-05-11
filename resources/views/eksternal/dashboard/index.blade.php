@extends('eksternal.layouts.master')

@section('contents')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dashboard Analisa Tahun <strong>{{ $yearNow }}</strong></h1>

        <div class="row">
            <div class="col-12 d-flex flex-wrap gap-2 justify-content-between">
                <div class="card flex-grow-1">
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
                <div class="card flex-grow-1">
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
                    </div>
                </div>
                <div class="card flex-grow-1">
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
                <div class="card flex-grow-1">
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
                    </div>
                </div>
            </div>
        </div>

        {{-- Start Tabel Jumlah by Unit Kerja --}}
            <div class="row">
                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                        <h5 class="card-title mb-0">Jumlah Usulan Pelatihan per Unit Kerja</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <table class="table table-hover table-sm table-responsive overflow-auto">
                                    <thead>
                                        <tr>
                                            <th class="d-sm-table-cell">Instansi</th>
                                            <th class="d-xl-table-cell">Unit Kerja</th>
                                            <th class="d-sm-table-cell">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tupByUk as $key => $count)
                                        @php
                                            [$instansi, $unit_kerja] = explode('|', $key);
                                        @endphp
                                            <tr>
                                                <td class="d-sm-table-cell">{{ $instansi }}</td>
                                                <td class="d-xl-table-cell">{{ $unit_kerja }}</td>
                                                <td class="d-sm-table-cell">{{ $count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                        <h5 class="card-title mb-0">Jumlah Usulan Ujikom per Unit Kerja</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <table class="table table-hover table-sm table-responsive overflow-auto">
                                    <thead>
                                        <tr>
                                            <th class="d-sm-table-cell">Instansi</th>
                                            <th class="d-xl-table-cell">Unit Kerja</th>
                                            <th class="d-sm-table-cell">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tuuByUk as $key => $count)
                                        @php
                                            [$instansi, $unit_kerja] = explode('|', $key);
                                        @endphp
                                            <tr>
                                                <td class="d-sm-table-cell">{{ $instansi }}</td>
                                                <td class="d-xl-table-cell">{{ $unit_kerja }}</td>
                                                <td class="d-sm-table-cell">{{ $count }}</td>
                                            </tr>
                                        @endforeach
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
