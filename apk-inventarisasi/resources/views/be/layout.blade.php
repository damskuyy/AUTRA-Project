<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('be/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('be/img/favicon.png')}}">
  <title>
    Inventaris
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('be/css/soft-ui-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <style>
    #sidenav-main {
      position: fixed !important;
      top: 0 !important;
      bottom: auto !important;
      height: auto !important;
      max-height: none !important;
      overflow: visible !important;
      padding-bottom: 30px !important;
    }
    #sidenav-collapse-main {
      max-height: none !important;
      overflow: visible !important;
      display: flex !important;
      flex-direction: column !important;
    }
    .navbar-nav {
      display: flex !important;
      flex-direction: column !important;
      width: 100% !important;
      overflow: visible !important;
    }
    .sidenav {
      overflow: visible !important;
    }
    .nav-link[data-bs-toggle="collapse"]::after {
      content: '';
      display: inline-block;
      width: 16px;
      height: 16px;
      margin-left: auto;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      transition: transform 0.3s ease;
    }
    .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
      transform: rotate(180deg);
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
<!-- sidebar -->
    @yield('sidebar')
<!-- End Sidebar -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @yield('navbar')
    <!-- End Navbar -->

    <!-- main -->
    @yield('content')
    <!-- end main -->

    <!-- footer -->
    @yield('footer')
    <!-- end footer -->
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('be/js/core/popper.min.js')}}"></script>
  <script src="{{asset('be/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/chartjs.min.js')}}"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('be/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
</body>

</html>