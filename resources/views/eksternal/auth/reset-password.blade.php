@extends('eksternal.layouts.auth-master')

@section('contents')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Reset Your Password</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form method="POST" action="{{ route('eksternal.password.store') }}">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Enter your email" id="email" value="{{ old('email', $request->email) }}" required/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="Enter password" id="password" required/>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control form-control-lg {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="Enter password" id="password_confirmation" id="password_confirmation" required />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Reset Password</button>
                                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
