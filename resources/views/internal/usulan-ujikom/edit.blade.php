@extends('internal.layouts.master')

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
                    <h5 class="card-title mb-0">Edit Usulan Uji Kompetensi</h5>
                </div>
                <div class="card-body">
                        <form action="{{ route('internal.usulan-ujikom.update', Crypt::encryptstring($usulanUjikom->id)) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label for="jenis_ujikom_id"> Pilih Jenis Uji Kompetensi <span class="text-danger ">*</span></label>
                                    <select name="jenis_ujikom_id" id="jenis_ujikom_id" class="form-control form-control-lg {{ hasError($errors, 'jenis_ujikom_id') }}" >
                                    </select>
                                    <x-input-error :messages="$errors->get('jenis_ujikom_id')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="ujikom_id"> Pilih Uji Kompetensi <span class="text-danger ">*</span></label>
                                    <select name="ujikom_id" id="ujikom_id" class="form-control form-control-lg {{ hasError($errors, 'ujikom_id') }}" >
                                    </select>
                                    <x-input-error :messages="$errors->get('ujikom_id')" class="mt-2" />
                                </div>
                                <div id="usulan_lainnya" class="mb-3"></div>
                                <div class="mb-3 d-flex justify-content-end gap-1">
                                    <a href="{{ route('internal.usulan-ujikom.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
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
        $('#jenis_ujikom_id').select2({
            theme: 'bootstrap-5',
            minimumInputLength:2,
            // placeholder:'Pilih Pengusul',
            ajax:{
                url:route('internal.usulan-ujikom.ajaxGetJenisUjikom'),
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
                    return "Ketikkan minimal 2 karakter untuk mencari jenis ujikom";
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
            templateResult: formatJenisUjikom, // Menentukan bagaimana setiap opsi ditampilkan
            templateSelection: formatJenisUjikomSelection // Menentukan bagaimana nilai yang dipilih ditampilkan
        });
    });

    // Fungsi untuk menampilkan ID dan instansi sebagai informasi tambahan dalam setiap opsi
    function formatJenisUjikom (jenisUjikom) {
        if (!jenisUjikom.id) { return jenisUjikom.text; }
        var $jenisUjikom = $(
            '<span>' + jenisUjikom.text + ' - ' + jenisUjikom.deskripsi + '</span>'
        );
        return $jenisUjikom;
    }

    // Fungsi untuk menampilkan nilai yang dipilih dengan format yang benar
    function formatJenisUjikomSelection (jenisUjikom) {
        if (!jenisUjikom.id) { return jenisUjikom.text; }
        var $jenisUjikom = $(
            '<span>' + jenisUjikom.text + ' - ' + jenisUjikom.deskripsi + '</span>'
        );
        return $jenisUjikom;
    }
</script>

<script>
    $(document).ready(function(){
        $('#ujikom_id').select2({
            theme: 'bootstrap-5',
            minimumInputLength:2,
            // placeholder:'Pilih Pengusul',
            ajax:{
                url:route('internal.usulan-ujikom.ajaxGetUjikom'),
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
                    return "Ketikkan minimal 2 karakter untuk mencari ujikom";
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
            templateResult: formatUjikom, // Menentukan bagaimana setiap opsi ditampilkan
            templateSelection: formatUjikomSelection // Menentukan bagaimana nilai yang dipilih ditampilkan
        });
            // Event listener untuk deteksi pemilihan opsi "ujikom lainnya"
        $('#ujikom_id').on('select2:select', function (e) {
            var data = e.params.data;
            if (data.text === 'Ujikom Lainnya') {
                // Tampilkan input teks tambahan
                $('#usulan_lainnya').html('<input type="text" class="form-control form-control-lg" name="usulan_lainnya" placeholder="Masukkan nama ujikom lainnya">');
            } else {
                // Sembunyikan input teks jika opsi selain "ujikom lainnya" dipilih
                $('#usulan_lainnya').empty();
            }
        });
    });

    // Fungsi untuk menampilkan ID dan instansi sebagai informasi tambahan dalam setiap opsi
    function formatUjikom (ujikom) {
        if (!ujikom.id) { return ujikom.text; }
        var $ujikom = $(
            '<span>' + ujikom.text + ' - ' + ujikom.deskripsi + '</span>'
        );
        return $ujikom;
    }

    // Fungsi untuk menampilkan nilai yang dipilih dengan format yang benar
    function formatUjikomSelection (ujikom) {
        if (!ujikom.id) { return ujikom.text; }
        var $ujikom = $(
            '<span>' + ujikom.text + ' - ' + ujikom.deskripsi + '</span>'
        );
        return $ujikom;
    }
</script>
@endpush
