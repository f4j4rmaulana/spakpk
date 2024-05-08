@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Edit Admin</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role-user.update', Crypt::encryptstring($admin->id)) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-lg {{ hasError($errors, 'name') }}" id="name" name="name" value="{{old('name', $admin->name)}}" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg {{ hasError($errors, 'email') }}" id="email" name="email" value="{{old('email', $admin->email)}}" required autofocus>
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
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Role</label>
                            <select name="role" class="form-select">
                                    <option selected>Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option @selected($role->name == $admin->getRoleNames()->first()) value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                              </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.role-user.index') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
