<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('be/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('be/img/favicon.png')}}">
  <title>Inventaris</title>
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{asset('be/css/soft-ui-dashboard.css?v=1.1.0')}}" rel="stylesheet" />

  <style>s

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
</style>
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
  <script src="{{asset('be/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('be/js/plugins/chartjs.min.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{asset('be/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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