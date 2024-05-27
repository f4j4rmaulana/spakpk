{{-- <x-guest-layout>
    <form method="POST" action="{{ route('eksternal.register') }}">
        @csrf

        <input type="hidden" name="role" id="role" value="eksternal">

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

         <!-- nomor_id -->
         <div class="mt-4">
            <div>
                <x-input-label for="nomor_id" :value="__('Nomor Identitas (NIP/NIK)')" />
                <x-text-input id="nomor_id" class="block mt-1 w-full" type="text" name="nomor_id" :value="old('nomor_id')" required autofocus autocomplete="nomor_id" />
                <x-input-error :messages="$errors->get('nomor_id')" class="mt-2" />
            </div>

        <!-- Instansi -->
        <div class="mt-4">
        <div>
            <x-input-label for="instansi" :value="__('Instansi')" />
            <x-text-input id="instansi" class="block mt-1 w-full" type="text" name="instansi" :value="old('instansi')" required autofocus autocomplete="instansi" />
            <x-input-error :messages="$errors->get('instansi')" class="mt-2" />
        </div>

        <!-- Unit Kerja -->
        <div class="mt-4">
        <div>
            <x-input-label for="unit_kerja" :value="__('Unit Kerja')" />
            <x-text-input id="unit_kerja" class="block mt-1 w-full" type="text" name="unit_kerja" :value="old('unit_kerja')" required autofocus autocomplete="unit_kerja" />
            <x-input-error :messages="$errors->get('unit_kerja')" class="mt-2" />
        </div>

        <!-- Jabatan -->
        <div class="mt-4">
        <div>
            <x-input-label for="jabatan" :value="__('Jabatan')" />
            <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required autofocus autocomplete="jabatan" />
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('eksternal.layouts.auth-master')

@push('custom-styles')
    <!-- example style for inner toggle -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugin/hideShowPassword-master/css/example.wink.css') }}">
@endpush

@section('contents')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-12 col-md-10 col-lg-8 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="text-center mt-4">
                    <h1 style="color:#000000">REGISTRASI</h1>
                    {{-- <p class="lead">Sign in to your account to continue</p> --}}
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">

                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <form method="POST" action="{{ route('eksternal.register') }}">
                                    @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input
                                            class="form-control form-control-lg {{ hasError($errors, 'name') }}"
                                            type="text"
                                            name="name"
                                            placeholder="Masukkan Nama"
                                            id="name"
                                            value="{{old('name')}}"
                                            required
                                            />
                                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input
                                            class="form-control form-control-lg {{ hasError($errors, 'email') }}"
                                            type="email"
                                            name="email"
                                            placeholder="Masukkan Email"
                                            id="email"
                                            value="{{old('email')}}"
                                            required
                                            />
                                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                        </div>

                                        <div class="d-flex justify-content-between gap-2">
                                            <div class="flex-fill mb-3">
                                                <label class="form-label">Password</label>
                                                <input
                                                    class="form-control form-control-lg {{ hasError($errors, 'password') }}"
                                                    type="password"
                                                    name="password"
                                                    placeholder="Masukkan Password"
                                                    id="password"
                                                    required>
                                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label class="form-label">Konfirmasi Password</label>
                                                <input
                                                    class="form-control form-control-lg {{ hasError($errors, 'password_confirmation') }}"
                                                    type="password"
                                                    name="password_confirmation"
                                                    placeholder="Konfirmasi Password"
                                                    id="password_confirmation"
                                                    required autocomplete="new-password">
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary"
                                            >Register</button
                                            >
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                </form>
                            <div class="text-center mt-4">
                                Sudah punya akun? <a href="{{ route('eksternal.login') }}">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
    <script src="{{ asset('backend/assets/plugin/hideShowPassword-master/hideShowPassword.min.js') }}"></script>
    <script>
        $('#password').hidePassword(true);
    </script>
@endpush


