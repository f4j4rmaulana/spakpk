<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Aplikasi Sistem SiJempol</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<!-- UI CARD -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/dataTables.bootstrap.css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">



  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/main.css')}}" rel="stylesheet">


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('frontend/assets/img/logo.png')}}" alt="">
        <h1 class="sitename">SiJempol</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#home" class="">Home</a></li>
          <li><a href="index.html#about">Tentang SiJempol</a></li>
          <li><a href="index.html#statistik">Statistik</a></li>
          <li><a href="index.html#fitur">Fitur</a></li>
          <li class="dropdown"><a href="#"><span>Panduan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a target="_blank" href="assets/pdf/PANDUAN PENGISIAN KEBUTUHAN PENGEMBANGAN KOMPETENSI.pdf">Pengisian Kebutuhan Pengembangan Kompetensi</a></li>
              <li><a target="_blank" href="assets/pdf/PANDUAN PENGISIAN KEBUTUHAN UJI KOMPTENSI.pdf">Pengisian Kebutuhan Uji Kompetensi</a></li>
            </ul>
          </li>
          <li><a href="index.html#kebutuhanbangkom">Kebutuhan Bangkom</a></li>
          <li><a href="index.html#faq">F.A.Q</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="home" class="hero section">
      <div class="hero-bg">
        <img src="{{ asset('frontend/assets/img/hero-bg-light.webp')}}" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up" class="">Selamat Datang di <span>SiJempol</span></h1>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <br>
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/embed/tgbNymZ7vqY" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
          <img src="{{ asset('frontend/assets/img/hero-services-img.webp')}}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section>
    <!-- /Hero Section -->



    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Who We Are</p>
            <h3>Deskripsi Penting nya AKPK / TNA</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
            </ul>

          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="{{ asset('frontend/assets/img/about-company-1.jpg')}}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="{{ asset('frontend/assets/img/about-company-2.jpg')}}" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="{{ asset('frontend/assets/img/about-company-3.jpg')}}" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>
    <!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-sm-6">
           <center>
              <div class="card-body">
                <center><h5 class="card-title">Panduan Pengisian Kebutuhan Pengembangan Kompetensi</h5></center>
                <br>
                <iframe width="544" height="306"
src="https://www.youtube.com/embed/tgbNymZ7vqY">
</iframe>

              </div>
            </center>
          </div>

          <div class="col-sm-6">

              <div class="card-body">
               <h5 class="card-title">Panduan Pengisian Kebutuhan Uji Kompetensi</h5>
               <br>
                <iframe width="544" height="306"
src="https://www.youtube.com/embed/tgbNymZ7vqY">
</iframe>

              </div>

          </div>
        </div>

      </div>

    </section>
    <!-- /Clients Section -->

    <!-- Features Section -->
    <section id="statistik" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 class="">Statistik Kebutuhan Pengembangan Kompentensi</h2>
        <p>Tahun Input 2024 digunakan untuk Perencanaan Tahun 2025</p>
      </div><!-- End Section Title -->
 <!-- Featured Services Section -->
 <section id="featured-services" class="featured-services section">

  <div class="container">

    <div class="row gy-4">
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger" id="value">278</h3>
                  <span>Total Usulan Pelatihan</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-rocket danger font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Service Item -->
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="dark" id="value" >156</h3>
                  <span>Usulan dari ASN Pemprov</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="dark" id="value">156</h3>
                  <span>Usulan Unit Kerja</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="succes" id="value" >156</h3>
                  <span>Total User</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


</section>
<!-- /Featured Services Section -->
      <div class="container">
        <div class="row justify-content-between">

          <!-- Bar Chart View -->
            <div id="bar"></div>

          <!-- Bar Race Chart View -->
            <div id="barrace"></div>
          </div>
          </div>

          <div class="container" data-aos="fade-up">
            <div class="row">
              <div class="col-sm-6">
              <div id="pie"> </div>
              </div>

              <div class="col-sm-6">

                <div id="pie1"> </div>

                  </div>

              </div>
            </div>

          </div>





    </section>
    <!-- /Features Section -->



    <!-- Services Section -->
    <section id="fitur" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Fitur </h2>
            <p>Fitur Aplikasi SiJempol</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item item-cyan position-relative">
                <i class="bi bi-activity icon"></i>
                <div>
                    <h3>Usulan Uji Kompetensi</h3>
                    <p>Fitur ini berfungsi untuk dapat mengidentifikasi kebutuhan uji komptensi dan usulan uji kompetensi.</p>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item item-cyan position-relative">
                <i class="bi bi-activity icon"></i>
                <div>
                    <h3>Usulan Pelatihan</h3>
                    <p>Fitur ini berfungsi untuk dapat mengidentifikasi kebutuhan pelatihan dan usulan pelatihan.</p>
                </div>
                </div>
            </div><!-- End Service Item -->



            </div>

        </div>

    </section>
    <!-- /Services Section -->

    <!-- More Features Section -->
    <section id="more-features" class="more-features section">

      <div class="container">

        <div class="row justify-content-around gy-4">

          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
            <h3>Enim quis est voluptatibus aliquid consequatur</h3>
            <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

            <div class="row">

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-easel flex-shrink-0"></i>
                <div>
                  <h4>Lorem Ipsum</h4>
                  <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias </p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-patch-check flex-shrink-0"></i>
                <div>
                  <h4>Nemo Enim</h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiise</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Dine Pad</h4>
                  <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Tride clov</h4>
                  <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit</p>
                </div>
              </div><!-- End Icon Box -->

            </div>

          </div>

          <div class="features-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('frontend/assets/img/features-3.jpg')}}" alt="">
          </div>

        </div>

      </div>

    </section>
    <!-- /More Features Section -->

    <!-- Pricing Section -->
        <section id="kebutuhanbangkom" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kebutuhan Pengembangan Kompetensi</h2>
            <p>Tahun input 2024 yang sudah divalidasi oleh Kontributor untuk perencanaan tahun 2025</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <center><li class="nav-item" role="presentation"><button class="nav-link active" href="#tab-table1" data-bs-toggle="tab" data-bs-target="#tab-table1" fdprocessedid="y0b3n">ASN Pemprov</button></li> </center>
                <center> <li><button class="nav-link" href="#tab-table2" data-bs-toggle="tab" data-bs-target="#tab-table2" fdprocessedid="p33jj">ASN Kabupaten / Kota</button></li> </center>

                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane show active" id="tab-table1">
                        <table id="myTable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>TABEL 1</th>
                                    <th>Office</th>
                                    <th>Extn.</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011-04-25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011-07-25</td>
                                <td>$170,750</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009-01-12</td>
                                <td>$86,000</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012-03-29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008-11-28</td>
                                <td>$162,700</td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012-12-02</td>
                                <td>$372,000</td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012-08-06</td>
                                <td>$137,500</td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010-10-14</td>
                                <td>$327,900</td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009-09-15</td>
                                <td>$205,500</td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008-12-13</td>
                                <td>$103,600</td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008-12-19</td>
                                <td>$90,560</td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013-03-03</td>
                                <td>$342,000</td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008-10-16</td>
                                <td>$470,600</td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012-12-18</td>
                                <td>$313,500</td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010-03-17</td>
                                <td>$385,750</td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012-11-27</td>
                                <td>$198,500</td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010-06-09</td>
                                <td>$725,000</td>
                            </tr>
                            <tr>
                                <td>Gloria Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009-04-10</td>
                                <td>$237,500</td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012-10-13</td>
                                <td>$132,000</td>
                            </tr>
                            <tr>
                                <td>Dai Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012-09-26</td>
                                <td>$217,500</td>
                            </tr>
                            <tr>
                                <td>Jenette Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011-09-03</td>
                                <td>$345,000</td>
                            </tr>
                            <tr>
                                <td>Yuri Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009-06-25</td>
                                <td>$675,000</td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011-12-12</td>
                                <td>$106,450</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-table2">
                        <table id="myTable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>TABEL 2</th>
                                    <th>Office</th>
                                    <th>Extn.</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011-04-25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011-07-25</td>
                                <td>$170,750</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009-01-12</td>
                                <td>$86,000</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012-03-29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008-11-28</td>
                                <td>$162,700</td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012-12-02</td>
                                <td>$372,000</td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012-08-06</td>
                                <td>$137,500</td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010-10-14</td>
                                <td>$327,900</td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009-09-15</td>
                                <td>$205,500</td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008-12-13</td>
                                <td>$103,600</td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008-12-19</td>
                                <td>$90,560</td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013-03-03</td>
                                <td>$342,000</td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008-10-16</td>
                                <td>$470,600</td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012-12-18</td>
                                <td>$313,500</td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010-03-17</td>
                                <td>$385,750</td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012-11-27</td>
                                <td>$198,500</td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010-06-09</td>
                                <td>$725,000</td>
                            </tr>
                            <tr>
                                <td>Gloria Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009-04-10</td>
                                <td>$237,500</td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012-10-13</td>
                                <td>$132,000</td>
                            </tr>
                            <tr>
                                <td>Dai Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012-09-26</td>
                                <td>$217,500</td>
                            </tr>
                            <tr>
                                <td>TABELL 2</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011-09-03</td>
                                <td>$345,000</td>
                            </tr>
                            <tr>
                                <td>Yuri Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009-06-25</td>
                                <td>$675,000</td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011-12-12</td>
                                <td>$106,450</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>

        </div>

        </section>
    <!-- /Pricing Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Pertanyaan yang Sering di Tanyakan</h2>
        </div>
      <!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                <div class="faq-container">

                <div class="faq-item faq-active">
                    <h3>Apa itu SiJempol?</h3>
                    <div class="faq-content">
                    <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Bagaimana Cara Saya Mendapatkan Akun Eksternal?</h3>
                    <div class="faq-content">
                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Jenis Pelatihan Apa Saja yang Dimiliki Balai Diklat Geospasial?</h3>
                    <div class="faq-content">
                    <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Uji Kompetensi Apa Saja yang Dimiliki Balai Diklat Geospasial?</h3>
                    <div class="faq-content">
                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Berapa Lama Pendaftaran Akun Bagi Eksternal?</h3>
                    <div class="faq-content">
                    <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->


                </div>

            </div><!-- End Faq Column-->

            </div>

        </div>

    </section>
    <!-- /Faq Section -->


  </main>

  <footer>
    <div class="rounded-social-buttons">
                      <a class="social-button facebook" href="https://www.facebook.com/profile.php?id=100066721177768" target="_blank"><i class="fab fa-facebook-f"></i></a>
                      <a class="social-button twitter" href="https://twitter.com/diklatspasial?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
                      <a class="social-button tiktok" href="https://www.tiktok.com/@diklatbig" target="_blank"><i class="fab fa-tiktok"></i></a>
                      <a class="social-button youtube" href="https://youtube.com/@diklatgeospasialbig?si=xsvTRYFJ76ywc_GS" target="_blank"><i class="fab fa-youtube"></i></a>
                      <a class="social-button instagram" href="https://www.instagram.com/diklatgeospasial.big?igsh=M2N2OHViemUwaGc2" target="_blank"><i class="fab fa-instagram"></i></a>
                  </div>

                  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-body">Balai Diklat Geospasial</a>
  </div>
  <!-- Copyright -->
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Data Tables -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

    <!-- Chart JS-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</script>
  <!-- Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js')}}"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

  <script>
    // Listen for Bootstrap tab change
document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((el) => {
    el.addEventListener('shown.bs.tab', () => {
        DataTable.tables({ visible: true, api: true }).columns.adjust();
    });
});

// Pie Char JS
Highcharts.chart('pie',{
    chart: {
        type: 'pie'
    },


    title: {
        text: 'Jumlah Usulan dari ASN Pemprov'
    },
    tooltip: {
        valueSuffix: '%'
    },
    subtitle: {
        text:
        'Source: Berdasarkan Jenis Pelatihan'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Percentage',
            colorByPoint: true,
            data: [
                {
                    name: 'Water',
                    y: 55.02
                },
                {
                    name: 'Fat',
                    sliced: true,
                    selected: true,
                    y: 26.71
                },
                {
                    name: 'Carbohydrates',
                    y: 1.09
                },
                {
                    name: 'Protein',
                    y: 15.5
                },
                {
                    name: 'Ash',
                    y: 1.68
                }
            ]
        }
    ]
});
// Pie1 Char JS
Highcharts.chart('pie1',{
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Jumlah Usulan dari ASN Kabupaten / Kota'
    },
    tooltip: {
        valueSuffix: '%'
    },
    subtitle: {
        text:
        'Source: Berdasarkan Jenis Pelatihan'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Percentage',
            colorByPoint: true,
            data: [
                {
                    name: 'Water',
                    y: 55.02
                },
                {
                    name: 'Fat',
                    sliced: true,
                    selected: true,
                    y: 26.71
                },
                {
                    name: 'Carbohydrates',
                    y: 1.09
                },
                {
                    name: 'Protein',
                    y: 15.5
                },
                {
                    name: 'Ash',
                    y: 1.68
                }
            ]
        }
    ]
});

 /*
 * BAR RACE CHART JS.
 */
  </script>
<script>
  const startYear = 1960,
    endYear = 2018,
    nbr = 20;

let dataset, chart;


/*
 * Animate dataLabels functionality
 */
(function (H) {
    const FLOAT = /^-?\d+\.?\d*$/;

    // Add animated textSetter, just like fill/strokeSetters
    H.Fx.prototype.textSetter = function () {
        let startValue = this.start.replace(/ /g, ''),
            endValue = this.end.replace(/ /g, ''),
            currentValue = this.end.replace(/ /g, '');

        if ((startValue || '').match(FLOAT)) {
            startValue = parseInt(startValue, 10);
            endValue = parseInt(endValue, 10);

            // No support for float
            currentValue = Highcharts.numberFormat(
                Math.round(startValue + (endValue - startValue) * this.pos),
                0
            );
        }

        this.elem.endText = this.end;

        this.elem.attr(this.prop, currentValue, null, true);
    };

    // Add textGetter, not supported at all at this moment:
    H.SVGElement.prototype.textGetter = function () {
        const ct = this.text.element.textContent || '';
        return this.endText ? this.endText : ct.substring(0, ct.length / 2);
    };

    // Temporary change label.attr() with label.animate():
    // In core it's simple change attr(...) => animate(...) for text prop
    H.wrap(H.Series.prototype, 'drawDataLabels', function (proceed) {
        const attr = H.SVGElement.prototype.attr,
            chart = this.chart;

        if (chart.sequenceTimer) {
            this.points.forEach(point =>
                (point.dataLabels || []).forEach(
                    label =>
                        (label.attr = function (hash) {
                            if (
                                hash &&
                                hash.text !== undefined &&
                                chart.isResizing === 0
                            ) {
                                const text = hash.text;

                                delete hash.text;

                                return this
                                    .attr(hash)
                                    .animate({ text });
                            }
                            return attr.apply(this, arguments);

                        })
                )
            );
        }

        const ret = proceed.apply(
            this,
            Array.prototype.slice.call(arguments, 1)
        );

        this.points.forEach(p =>
            (p.dataLabels || []).forEach(d => (d.attr = attr))
        );

        return ret;
    });
}(Highcharts));


function getData(year) {
    const output = Object.entries(dataset)
        .map(country => {
            const [countryName, countryData] = country;
            return [countryName, Number(countryData[year])];
        })
        .sort((a, b) => b[1] - a[1]);
    return [output[0], output.slice(1, nbr)];
}

function getSubtitle() {

}

(async () => {

    dataset = await fetch(
        'https://demo-live-data.highcharts.com/population.json'
    ).then(response => response.json());


    chart = Highcharts.chart('barrace', {
        chart: {
            animation: {
                duration: 500
            },
            marginRight: 50
        },
        title: {
            text: 'Jumlah Usulan di OPD Provinsi',
            align: 'center'
        },
        subtitle: {
            useHTML: true,
            text: getSubtitle(),
            floating: true,
            align: 'right',
            verticalAlign: 'middle',
            y: -80,
            x: -100
        },

        legend: {
            enabled: false
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            opposite: true,
            tickPixelInterval: 150,
            title: {
                text: null
            }
        },
        plotOptions: {
            series: {
                animation: false,
                groupPadding: 0,
                pointPadding: 0.1,
                borderWidth: 0,
                colorByPoint: true,
                dataSorting: {
                    enabled: true,
                    matchByName: true
                },
                type: 'bar',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [
            {
                type: 'bar',
                name: startYear,
                data: getData(startYear)[1]
            }
        ],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 550
                },
                chartOptions: {
                    xAxis: {
                        visible: false
                    },
                    subtitle: {
                        x: 0
                    },
                    plotOptions: {
                        series: {
                            dataLabels: [{
                                enabled: true,
                                y: 8
                            }, {
                                enabled: true,
                                format: '{point.name}',
                                y: -8,
                                style: {
                                    fontWeight: 'normal',
                                    opacity: 0.7
                                }
                            }]
                        }
                    }
                }
            }]
        }
    });
})();

/*
 * Pause the timeline, either when the range is ended, or when clicking the pause button.
 * Pausing stops the timer and resets the button to play mode.
 */
function pause(button) {
    button.title = 'play';
    button.className = 'fa fa-play';
    clearTimeout(chart.sequenceTimer);
    chart.sequenceTimer = undefined;
}

/*
 * Update the chart. This happens either on updating (moving) the range input,
 * or from a timer when the timeline is playing.
 */
function update(increment) {
    if (increment) {
        input.value = parseInt(input.value, 10) + increment;
    }
    if (input.value >= endYear) {
        // Auto-pause
        pause(btn);
    }

    chart.update(
        {
            subtitle: {
                text: getSubtitle()
            }
        },
        false,
        false,
        false
    );

    chart.series[0].update({
        name: input.value,
        data: getData(input.value)[1]
    });
}

/*
 * Play the timeline.
 */
function play(button) {
    button.title = 'pause';
    button.className = 'fa fa-pause';
    chart.sequenceTimer = setInterval(function () {
        update(1);
    }, 500);
}

btn.addEventListener('click', function () {
    if (chart.sequenceTimer) {
        pause(this);
    } else {
        play(this);
    }
});
/*
 * Trigger the update on the range bar click.
 */
input.addEventListener('click', function () {
    update();
});

</script>
  <!-- data tables -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable1').DataTable({
      "pagingType": "simple_numbers"
    });
		$('#myTable2').DataTable({
      "pagingType": "simple_numbers"
    });
	});
</script>

 <!-- Chart Bar JS -->
<script>
  Highcharts.chart('bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Usulan Pelatihan Pengembangan Kompetensi ASN BIG',
        align: 'center'
    },
    xAxis: {
        categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '1000 metric tons (MT)'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 MT)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Corn',
            data: [406292, 260000, 107000, 68300, 27500, 14500]
        },
        {
            name: 'Wheat',
            data: [51086, 136000, 5500, 141000, 107180, 77000]
        }
    ]
});

</script>


</body>

</html>
