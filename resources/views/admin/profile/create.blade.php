@extends('admin.layouts.master')

@section('contents')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <x-image-preview :height="400" :width="300" :source="$admin?->image" />

                            <label for="">Image</label>
                            <input type="file" class="form-control {{ hasError($errors, 'image') }}" name="image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
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
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password-update') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-wrap gap-3">
                            <div class="mb-3 flex-fill">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg {{ hasError($errors, 'password') }}" id="password" name="password" value="{{old('password')}}" required autofocus>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                            <div class="mb-3 flex-fill">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control form-control-lg {{ hasError($errors, 'password_confirmation') }}" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" required autofocus>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-link shadow-none" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
