@extends('eksternal.layouts.master')

@push('custom-styles')
    <link href="{{ asset('backend/assets/plugin/select2-4.1.0-rc.0/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugin/select2-4.1.0-rc.0/dist/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/plugin/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
@endpush

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Buat Usulan Pelatihan</h5>
                </div>
                <div class="card-body">
                        <form action="{{ route('eksternal.usulan-pelatihan.store') }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="jenis_pelatihan_id"> Pilih Jenis Pelatihan <span class="text-danger ">*</span></label>
                                    <select name="jenis_pelatihan_id" id="jenis_pelatihan_id" class="form-control form-control-lg {{ hasError($errors, 'jenis_pelatihan_id') }}" >
                                    </select>
                                    <x-input-error :messages="$errors->get('jenis_pelatihan_id')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="pelatihan_id"> Pilih Pelatihan <span class="text-danger ">*</span></label>
                                    <select name="pelatihan_id" id="pelatihan_id" class="form-control form-control-lg {{ hasError($errors, 'pelatihan_id') }}" >
                                    </select>
                                    <x-input-error :messages="$errors->get('pelatihan_id')" class="mt-2" />
                                </div>
                                <div id="usulan_lainnya" class="mb-3"></div>
                                <div class="mb-3 d-flex justify-content-end gap-1">
                                    <a href="{{ route('eksternal.usulan-pelatihan.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('custom-script')
<script>
    $(document).ready(function(){
        $('#jenis_pelatihan_id').select2({
            theme: 'bootstrap-5',
            minimumInputLength:0,
            // placeholder:'Pilih Pengusul',
            ajax:{
                url:route('eksternal.usulan-pelatihan.ajaxGetJenisPelatihan'),
                dataType:'json',
                processResults:data=>{
                    return {
                        results:data.map(res=>{
                            return {id:res.id, text:res.nama, deskripsi:res.deskripsi}
                        })
                    }
                }
            },
            language: {
                inputTooShort: function () {
                    return "Ketikkan minimal 2 karakter untuk mencari jenis pelatihan";
                },
                searching: function () {
                return "Sedang mencari...";
                },
                noResults: function () {
                    return "Data tidak ditemukan";
                },
                errorLoading: function() {
                return "Hasil data tidak dapat ditampilkan";
                }
            },
            templateResult: formatJenisPelatihan, // Menentukan bagaimana setiap opsi ditampilkan
            templateSelection: formatJenisPelatihanSelection // Menentukan bagaimana nilai yang dipilih ditampilkan
        });
    });

    // Fungsi untuk menampilkan ID dan instansi sebagai informasi tambahan dalam setiap opsi
    function formatJenisPelatihan (jenisPelatihan) {
        if (!jenisPelatihan.id) { return jenisPelatihan.text; }
        var $jenisPelatihan = $(
            '<span>' + jenisPelatihan.text + ' - ' + jenisPelatihan.deskripsi + '</span>'
        );
        return $jenisPelatihan;
    }

    // Fungsi untuk menampilkan nilai yang dipilih dengan format yang benar
    function formatJenisPelatihanSelection (jenisPelatihan) {
        if (!jenisPelatihan.id) { return jenisPelatihan.text; }
        var $jenisPelatihan = $(
            '<span>' + jenisPelatihan.text + ' - ' + jenisPelatihan.deskripsi + '</span>'
        );
        return $jenisPelatihan;
    }
</script>

<script>
    $(document).ready(function(){
        $('#pelatihan_id').select2({
            theme: 'bootstrap-5',
            minimumInputLength:0,
            // placeholder:'Pilih Pengusul',
            ajax:{
                url:route('eksternal.usulan-pelatihan.ajaxGetPelatihan'),
                dataType:'json',
                processResults:data=>{
                    return {
                        results:data.map(res=>{
                            return {id:res.id, text:res.nama, deskripsi:res.deskripsi}
                        })
                    }
                }
            },
            language: {
                inputTooShort: function () {
                    return "Ketikkan minimal 2 karakter untuk mencari pelatihan";
                },
                searching: function () {
                return "Sedang mencari...";
                },
                noResults: function () {
                    return "Data tidak ditemukan";
                },
                errorLoading: function() {
                return "Hasil data tidak dapat ditampilkan";
                }
            },
            templateResult: formatPelatihan, // Menentukan bagaimana setiap opsi ditampilkan
            templateSelection: formatPelatihanSelection // Menentukan bagaimana nilai yang dipilih ditampilkan
        });
            // Event listener untuk deteksi pemilihan opsi "pelatihan lainnya"
        $('#pelatihan_id').on('select2:select', function (e) {
            var data = e.params.data;
            if (data.text === 'Pelatihan Lainnya') {
                // Tampilkan input teks tambahan
                $('#usulan_lainnya').html('<input type="text" class="form-control form-control-lg" name="usulan_lainnya" placeholder="Masukkan nama pelatihan lainnya">');
            } else {
                // Sembunyikan input teks jika opsi selain "pelatihan lainnya" dipilih
                $('#usulan_lainnya').empty();
            }
        });
    });

    // Fungsi untuk menampilkan ID dan instansi sebagai informasi tambahan dalam setiap opsi
    function formatPelatihan (pelatihan) {
        if (!pelatihan.id) { return pelatihan.text; }
        var $pelatihan = $(
            '<span>' + pelatihan.text + ' - ' + pelatihan.deskripsi + '</span>'
        );
        return $pelatihan;
    }

    // Fungsi untuk menampilkan nilai yang dipilih dengan format yang benar
    function formatPelatihanSelection (pelatihan) {
        if (!pelatihan.id) { return pelatihan.text; }
        var $pelatihan = $(
            '<span>' + pelatihan.text + ' - ' + pelatihan.deskripsi + '</span>'
        );
        return $pelatihan;
    }
</script>
@endpush
