@extends('eksternal.layouts.auth-master')

@section('contents')
<div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">
            <div class="text-center mt-4">
                <h1 style="color:#000000">LOGIN INTERNAL</h1>
                {{-- <p class="lead">Sign in to your account to continue</p> --}}
              </div>


          <div class="card">
            <div class="card-body">
              <div class="m-sm-4">
                <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist" style="border-bottom: 1px solid #ccc;">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Internal</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('eksternal.login') }}">Eksternal</a>
                    </li>
                </ul>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input
                      class="form-control form-control-lg {{ hasError($errors, 'username') }}"
                      type="username"
                      name="username"
                      placeholder="Masukkan Username LDAP anda"
                      id="username"
                      value="{{old('username')}}"
                      required
                    />
                    <x-input-error :messages="$errors->get('username')" class="mt-1" />
                  </div>


                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                      class="form-control form-control-lg {{ hasError($errors, 'password') }}"
                      type="password"
                      name="password"
                      placeholder="Masukkan Password"
                      id="password"
                      required
                      <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                  </div>
                  <div>
                    <label class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value="remember"
                        name="remember"
                        id="remember_me"
                      />

                      <span class="form-check-label">
                        Ingat Saya
                      </span>
                    </label>
                  </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary"
                      >Log in</button
                    >
                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
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


