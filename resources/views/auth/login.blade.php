<html>
    <head>
      <title>Login | Aplikasi Sistem SiJempol</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
        <link href="{{ asset('frontend/assets/img/favicon.png')}}" rel="icon">
        <link href="{{ asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}" crossorigin="anonymous">

                <!-- Optional theme -->
                <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap-3.4.1-dist/css/bootstrap-theme.min.css')}}" crossorigin="anonymous">

                <!-- Latest compiled and minified JavaScript -->
                <script src="{{ asset('frontend/assets/bootstrap-3.4.1-dist/css/bootstrap.min.js')}}" crossorigin="anonymous"></script>
                <title> </title>


        <!-- Main1 CSS File -->
        <link href="{{ asset('frontend/assets/css/main1.css')}}" rel="stylesheet">
    </head>
        <body class="main-bg">
            <div class="login-container text-c animated flipInX">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-login">
                                <div class="panel-heading">
                                <div>
                                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                                </div>
                                    <h3 class="text-whitesmoke">Login</h3>
                                <div class="row">
                                    <div class="col-xs-6">
                                    <a href="{{ route('login') }}" class="active" id="internal-form-link">Internal</a>
                                    </div>
                                    <div class="col-xs-6">
                                    <a href="{{ route('eksternal.login') }}" id="eksternal-form-link">Eksternal</a>
                                    </div>
                                </div>
                                <hr>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                                <!-- Session Status -->
                                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                                <form id="internal-form" method="POST" action="{{ route('login') }}"form" style="display: block;">
                                                    @csrf

                                                    <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                                                        <label for="username">Username</label>
                                                        <input
                                                        class="form-control is-invalid"
                                                        type="text"
                                                        name="username"
                                                        placeholder="Masukkan username"
                                                        id="username"
                                                        value="{{old('username')}}"
                                                        required autofocus
                                                      />
                                                      <x-input-error :messages="$errors->get('username')" class="mt-1" />
                                                    </div>
                                                    <div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
                                                            <label for="password">Password</label>
                                                            <input
                                                            class="form-control"
                                                            type="password"
                                                            name="password"
                                                            placeholder="Masukkan password"
                                                            id="password"
                                                            required autocomplete="current-password"
                                                            />
                                                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                                        </div>
                                                    <div class="form-group text-center">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value="remember"
                                                            name="remember"
                                                            id="remember_me" />
                                                        <label for="remember">Ingat Saya</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-sm-offset-3">
                                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    {{-- <script src="{{ asset('backend/assets/plugin/jquery/jquery-3.7.1.min.js') }}"></script>
    <script>
      $(function() {

        $('#internal-form-link').click(function(e) {
        $("#internal-form").delay(100).fadeIn(100);
        $("#eksternal-form").fadeOut(100);
        $('#eksternal-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        });
        $('#eksternal-form-link').click(function(e) {
        $("#eksternal-form").delay(100).fadeIn(100);
        $("#internal-form").fadeOut(100);
        $('#internal-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        });

        });
    </script> --}}
</html>
