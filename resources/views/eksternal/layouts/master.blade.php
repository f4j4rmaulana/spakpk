<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta
      name="description"
      content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"
    />
    <meta name="author" content="AdminKit" />
    <meta
      name="keywords"
      content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
    />

    <link
      rel="shortcut icon"
      href="{{asset('backend/assets/img/icons/icon-48x48.png')}}"
    />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>{{ $titles }} | {{env('APP_NAME')}}</title>

    @stack('modal-styles')

    <link href="{{asset('backend/assets/css/app.css')}}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
    <script src="{{ asset('backend/assets/plugin/jquery/jquery-3.7.1.min.js') }}"></script>
    @stack('custom-styles')

    @routes
  </head>

  <body>
    <div class="wrapper">

      <nav id="sidebar" class="sidebar js-sidebar collapsed">
        @include('eksternal.layouts.sidebar')
      </nav>

        <div class="main">

            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                @include('eksternal.layouts.navbar')
            </nav>

            <main class="content">
            @include('sweetalert::alert')
            @yield('contents')
            </main>

            <footer class="footer">
            @include('eksternal.layouts.footer')
            </footer>

        </div>
    </div>

    <script src="{{asset('backend/assets/js/app.js')}}"></script>
    @stack('custom-script')

  </body>
</html>
