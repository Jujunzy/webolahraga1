<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    WEBSITE OLAHRAGA
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('vendor/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('vendor/assets/demo/demo.css') }}" rel="stylesheet" />
  <!-- Custom CSS untuk menghilangkan background pada tabel dan form -->
  <style>
    /* Menghilangkan background di tabel */
    table {
        background-color: transparent !important;
    }

    /* Menghilangkan background di form */
    form {
        background-color: transparent !important;
    }

    /* Menghilangkan background di .wrapper dan .main-panel jika ada */
    .wrapper, .main-panel {
        background-color: transparent !important;
    }
</style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ asset('vendor/assets/img/logow.jpg') }}">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
            Klub Olahraga
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('home*') ? 'active' : '' }}">
                <a href="/home" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ Request::is('anggota*') ? 'active' : '' }}">
            <a href="/anggota" class="nav-link {{ Request::is('anggota*') ? 'active' : '' }}">
              <i class="fa fa-users"></i>
              <p>Data Anggota</p>
            </a>
          </li>
          <li class="{{ Request::is('jenisolahraga*') ? 'active' : '' }}">
            <a href="/jenisolahraga" class="nav-link {{ Request::is('jenisolahraga*') ? 'active' : '' }}">
                <i class="fa fa-tags"></i>
              <p>Jenis Olahraga</p>
            </a>
          </li>
          <li class="{{ Request::is('latihan*') ? 'active' : '' }}">
            <a href="/latihan" class="nav-link {{ Request::is('latihan*') ? 'active' : '' }}">
              <i class="nc-icon nc-bell-55"></i>
              <p>Latihan</p>
            </a>
          </li>
          <li class="{{ Request::is('pelatih*') ? 'active' : '' }}">
            <a href="/pelatih" class="nav-link {{ Request::is('pelatih*') ? 'active' : '' }}">
              <i class="nc-icon nc-single-02"></i>
              <p>Pelatih</p>
            </a>
          </li>
          <li class="{{ Request::is('event*') ? 'active' : '' }}">
            <a href="/event" class="nav-link {{ Request::is('event*') ? 'active' : '' }}">
              <i class="fa fa-calendar"></i>
              <p>Event Kompetisi</p>
            </a>
          </li>
          <li class="{{ Request::is('pemenang*') ? 'active' : '' }}">
            <a href="/pemenang" class="nav-link {{ Request::is('pemenang*') ? 'active' : '' }}">
              <i class="fa fa-bullhorn"></i>
              <p>Pemenang Event</p>
            </a>
          </li>
          <li class="{{ Request::is('jadwal*') ? 'active' : '' }}">
            <a href="/jadwal" class="nav-link {{ Request::is('jadwal*') ? 'active' : '' }}">
              <i class="fa fa-table"></i>
              <p>Jadwal Latihan</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            {{-- <form>
              <div class="input-group no-border">
                <input type="text"  id="search-input" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> --}}
            <ul class="navbar-nav">
              <li class="nav-item">
                {{-- <a class="nav-link btn-magnify" href="javascript:;">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a> --}}
              </li>
              <li class="nav-item btn-rotate dropdown">
                {{-- <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a> --}}
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link" >
                  <i class="fas fa-sign-out-alt"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      {{-- Content --}}
      @include('sweetalert::alert')
      @yield('content')
      {{-- End Content --}}

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            {{-- <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav> --}}
            {{-- <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by evvamaulani
              </span>
            </div> --}}
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>
