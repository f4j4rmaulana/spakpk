@extends('admin.layouts.auth-master')

@section('contents')
<div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">
          <div class="text-center mt-4">
            <h1 class="h2">Welcome back</h1>
            <p class="lead">Sign in to your account to continue</p>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="m-sm-4">
                <div class="text-center">
                  <img
                    src="img/avatars/avatar.jpg"
                    alt="#"
                    class="img-fluid rounded-circle"
                    width="132"
                    height="132"
                  />
                </div>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                      class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                      type="email"
                      name="email"
                      placeholder="Enter your email"
                      id="email"
                      value="{{old('email')}}"
                      required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                  </div>


                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                      class="form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}"
                      type="password"
                      name="password"
                      placeholder="Enter your password"
                      id="password"
                      required
                      <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    />



                    <small>
                      <a href="{{ route('admin.password.request') }}">Forgot password?</a>
                    </small>
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
                        Remember me next time
                      </span>
                    </label>
                  </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary"
                      >Sign in</button
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
