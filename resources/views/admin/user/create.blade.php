@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Tambah Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'name') }}" id="name" name="name" value="{{old('name')}}" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg {{ hasError($errors, 'email') }}" id="email" name="email" value="{{old('email')}}" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg {{ hasError($errors, 'password') }}" id="password" name="password" value="{{old('password')}}" required autofocus>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control form-control-lg {{ hasError($errors, 'password_confirmation') }}" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" required autofocus>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                        {{-- <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select" disabled>
                                    <option value="eksternal">Eksternal</option>
                              </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="nomor_id" class="form-label">Nomor Identitas</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'nomor_id') }}" id="nomor_id" name="nomor_id" value="{{old('nomor_id')}}" required autofocus>
                            <x-input-error :messages="$errors->get('nomor_id')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="nomor_id" class="form-label">Instansi</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'instansi') }}" id="instansi" name="instansi" value="{{old('instansi')}}" required autofocus>
                            <x-input-error :messages="$errors->get('instansi')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="nomor_id" class="form-label">Unit Kerja</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'unit_kerja') }}" id="unit_kerja" name="unit_kerja" value="{{old('unit_kerja')}}" required autofocus>
                            <x-input-error :messages="$errors->get('unit_kerja')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="nomor_id" class="form-label">Jabatan</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'jabatan') }}" id="jabatan" name="jabatan" value="{{old('jabatan')}}" required autofocus>
                            <x-input-error :messages="$errors->get('jabatan')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="account_type" class="form-label">Tipe Akun</label>
                            <select name="account_type" class="form-select">
                                <option selected>Pilih Tipe Akun</option>
                                            <option value="single">Single</option>
                                            <option value="multirole">Multi Role</option>
                              </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
