<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Monitoring</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dark-theme">

<!-- ===== Sidebar ===== -->
<aside class="sidebar">
  <div class="logo">
    <div class="logo-icon">⚙️</div>
    <div>
      <h3>Automation</h3>
      <small>Monitoring System</small>
    </div>
  </div>

  <nav>
    <a class="active" href="dashboard.html"><i class="fa-solid fa-grid-2"></i> Dashboard</a>
    <a href="control.html"><i class="fa-solid fa-sliders"></i> Control</a>
    <a href="laporan.html"><i class="fa-solid fa-file-lines"></i> Laporan</a>
    <a href="notifikasi.html"><i class="fa-solid fa-bell"></i> Notifikasi</a>
    <a href="manage-user.html"><i class="fa-solid fa-users"></i> Manage User</a>
  </nav>

  <footer>© 2025 Automation System</footer>
</aside>

<!-- ===== Main ===== -->
<main class="main">

  <!-- ===== Topbar ===== -->
  <header class="topbar">
    <div>
      <h1>Dashboard Monitoring</h1>
      <p>Real-time monitoring sensor PLC</p>
    </div>

    <div class="topbar-right">
      <span class="live-badge"><i class="fa-solid fa-wave-square"></i> Live</span>
      <div class="user">
        <div class="avatar">AU</div>
        <div>
          <strong>Admin User</strong>
          <small>Administrator</small>
        </div>
      </div>
    </div>
  </header>

  <!-- ===== Sensor Cards ===== -->
  <section class="sensor-grid">

    <div class="sensor-card orange">
      <div class="card-header">
        <span>Suhu</span>
        <i class="fa-solid fa-temperature-half"></i>
      </div>
      <h2>26.6 <small>°C</small></h2>
      <p class="status normal"><i class="fa-solid fa-arrow-trend-up"></i> Normal</p>
    </div>

    <div class="sensor-card yellow">
      <div class="card-header">
        <span>Intensitas Cahaya</span>
        <i class="fa-solid fa-sun"></i>
      </div>
      <h2>448 <small>Lux</small></h2>
      <p class="status normal"><i class="fa-solid fa-arrow-trend-up"></i> Normal</p>
    </div>

    <div class="sensor-card blue">
      <div class="card-header">
        <span>Kelembapan</span>
        <i class="fa-solid fa-droplet"></i>
      </div>
      <h2>68.8 <small>%</small></h2>
      <p class="status normal"><i class="fa-solid fa-arrow-trend-up"></i> Normal</p>
    </div>

  </section>

  <!-- ===== Charts ===== -->
  <section class="chart-grid">

    <div class="chart-card">
      <h3><i class="fa-solid fa-temperature-half"></i> Trend Suhu</h3>
      <canvas id="tempChart"></canvas>
    </div>

    <div class="chart-card">
      <h3><i class="fa-solid fa-sun"></i> Trend Intensitas Cahaya</h3>
      <canvas id="lightChart"></canvas>
    </div>

  </section>

</main>

<script src="assets/js/script.js"></script>
</body>
</html>
