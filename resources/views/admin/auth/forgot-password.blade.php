@extends('admin.layouts.auth-master')

@section('contents')
<div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">
          <div class="text-center mt-4">
            <h1 class="h2">Forgot Your Password?</h1>
            <p class="lead">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="m-sm-4">
                {{-- <div class="text-center">
                  <img
                    src="img/avatars/avatar.jpg"
                    alt="#"
                    class="img-fluid rounded-circle"
                    width="132"
                    height="132"
                  />
                </div> --}}
                    <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('admin.password.email') }}">
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

                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary"
                      >Send Email Password Reset Link</button
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
