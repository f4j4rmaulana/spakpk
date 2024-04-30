@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Tambah Pelatihan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pelatihan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'nama') }}" id="nama" name="nama" value="{{old('nama')}}" required autofocus>
                            <x-input-error :messages="$errors->get('nama')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-lg {{ hasError($errors, 'deskripsi') }}" id="deskripsi" name="deskripsi" rows="2" required autofocus>{{old('deskripsi')}}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                        </div>
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.pelatihan.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
