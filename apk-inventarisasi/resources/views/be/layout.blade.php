<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('be/img/logos/logo-autra-nonBG.png')}}">
  <link rel="icon" type="image/png" href="{{asset('be/img/logos/logo-autra-nonBG.png')}}">
  <title>Inventaris</title>
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{asset('be/css/soft-ui-dashboard.css?v=1.1.0')}}" rel="stylesheet" />

  <style>

  body.g-sidenav-show {
    overflow: hidden; /* Soft UI bug, ini membuang gap */
}

.main-content {
    overflow-y: auto;
    height: 100vh;
}
  /* Hover Soft UI */
  .hover-card {
    transition: all .2s ease-in-out;
    border-radius: 20px;
  }
  .hover-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }

  /* Dark Mode */
  body.dark-mode {
    background: #1f1f1f !important;
    color: white !important;
  }
  body.dark-mode .card {
    background: #2b2b2b !important;
    color: white !important;
    box-shadow: none !important;
  }
  body.dark-mode .navbar {
    background: #2b2b2b !important;
  }
  body.dark-mode .footer {
    color: white !important;
  }

  /* Styling untuk dropdown profile */
  .dropdown-menu {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-radius: 15px;
  }
  .dropdown-item {
    border-radius: 10px;
    margin: 5px;
    transition: all 0.2s;
  }
  .dropdown-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
  }
  .nav-link {
    border-radius: 10px;
    transition: all 0.2s;
  }
  .nav-link:hover {
    background-color: rgba(255,255,255,0.1);
  }

  /* Avatar styling */
  .avatar {
    width: 40px;
    height: 40px;
  }
  .avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .avatar-lg {
    width: 60px;
    height: 60px;
  }
  .dropdown-header {
    border-radius: 15px 15px 0 0;
  }

  /* Disable ALL button animations completely */
  .btn,
  .btn-dark,
  .btn-primary,
  .btn-secondary,
  .btn-success,
  .btn-danger,
  .btn-warning,
  .btn-info,
  .bg-gradient-primary {
    transition: none !important;
    transform: scale(1) !important;
    box-shadow: none !important;
    outline: none !important;
  }

  .btn:active,
  .btn:focus,
  .btn:focus-visible,
  .btn:hover,
  .btn-dark:active,
  .btn-dark:focus,
  .bg-gradient-primary:active,
  .bg-gradient-primary:focus {
    transform: scale(1) !important;
    box-shadow: none !important;
    transition: none !important;
    outline: none !important;
  }
</style>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="g-sidenav-show bg-gray-100">
  {{-- sidebar --}}
  @yield('sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    {{-- navbar --}}
    @yield('navbar')
    {{-- main --}}
    @yield('main')
    {{-- footer --}}
    @yield('footer')
  </main>

  <!-- Core JS -->
  <script src="{{asset('be/js/core/popper.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{asset('be/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/chartjs.min.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{asset('be/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
  <!-- Bootstrap JS -->
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  


  <script>
  // Dark Mode Toggle
  document.getElementById("darkModeToggle").addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });

  // Chart Dummy Data
  const dataPinjam = [5, 9, 6, 8, 10, 7, 12];
  const dataPakai = [3, 4, 5, 3, 6, 4, 5];

  // Chart Peminjaman
  new Chart(document.getElementById("chartPinjam"), {
    type: "bar",
    data: {
      labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
      datasets: [{
        label: "Peminjaman",
        data: dataPinjam,
        borderWidth: 1
      }]
    }
  });

  // Chart Penggunaan
  new Chart(document.getElementById("chartPakai"), {
    type: "line",
    data: {
      labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
      datasets: [{
        label: "Pemakaian",
        data: dataPakai,
        borderWidth: 1
      }]
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
      const body = document.body;
      const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
      const iconSidenav = document.getElementById('iconSidenav');

      if (iconNavbarSidenav) {
          iconNavbarSidenav.addEventListener("click", function () {
              body.classList.toggle("g-sidenav-pinned");
              body.classList.toggle("g-sidenav-hidden");
          });
      }

      if (iconSidenav) {
          iconSidenav.addEventListener("click", function () {
              body.classList.remove("g-sidenav-pinned");
              body.classList.add("g-sidenav-hidden");
          });
      }
  });
</script>


  @stack('scripts') {{-- untuk script tambahan di halaman --}}
</body>
</html>