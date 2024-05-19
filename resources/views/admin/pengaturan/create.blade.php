@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pengaturan Akses Usulan</h5>
                </div>
                <div class="card-body">
                    <div class="pgUsulanBtn">
                        @foreach ($pgUsulans as $pgUsulan)
                            @if ($pgUsulan->value === 'Open')
                                <label for="{{ $pgUsulan->key }}" class="fw-bolder form-label mb-3">{{ $pgUsulan->key }}</label>
                                <div class="mb-3">
                                    <a href="javascript:void(0)" data-url="{{ route('admin.pengaturan.ajaxClose', Crypt::encryptString($pgUsulan->id)); }}" class="btn btn-danger btnClose">Close</a>
                                </div>
                            @else
                                <label for="{{ $pgUsulan->key }}" class="fw-bolder form-label mb-3">{{ $pgUsulan->key }}</label>
                                <div class="mb-3">
                                    <a href="javascript:void(0)" data-url="{{ route('admin.pengaturan.ajaxOpen', Crypt::encryptString($pgUsulan->id)); }}" class="btn btn-success btnOpen">Open</a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('custom-script')
    <script>
        $(document).on('click', '.btnClose', function (e) {
            e.preventDefault();
            var url = $(this).data('url'); // Mengambil URL dari data-url
            // var token = "{{ csrf_token() }}";

            $.ajax({
                url: url,
                type: 'GET',
                // data: {
                //     _token: token
                // },
                success: function (response) {
                    // Menampilkan pesan sukses dengan nama pengusul
                    alert('Akses Usulan ditutup!');
                    // Refresh
                    // location.reload();
                    $('.pgUsulanBtn').load(location.href + ' .pgUsulanBtn');
                },
                error: function (xhr) {
                    alert('Gagal melakukan perubahan akses!');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btnOpen', function (e) {
            e.preventDefault();
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    alert('Akses Usulan dibuka!');
                    $('.pgUsulanBtn').load(location.href + ' .pgUsulanBtn');
                },
                error: function (xhr) {
                    // Tampilkan pesan error atau lakukan tindakan lain jika diperlukan
                    alert('Gagal melakukan perubahan akses!');
                }
            });
        });
    </script>
@endpush
