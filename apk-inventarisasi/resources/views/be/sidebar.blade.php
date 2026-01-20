<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
       id="sidenav-main">

  <!-- HEADER -->
  <div class="sidenav-header px-3 py-3">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
   id="iconSidenav"></i>


    <a class="navbar-brand m-0 d-flex align-items-center gap-2" href="#">
      <img
        src="{{asset('be/img/logos/logo-autra-nonBG.png')}}"
        class="navbar-brand-img"
        alt="main_logo"
      />
      <span class="brand-text">AUTRA Inventarisasi</span>
    </a>
  </div>

  <hr class="horizontal dark my-2">

  <!-- MENU -->
  <div class="collapse navbar-collapse w-auto show" id="sidenav-collapse-main">
    <ul class="navbar-nav px-2">

      <!-- DASHBOARD -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/dashboard">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
          </div>
          <span class="menu-text">Dashboard</span>
        </a>
      </li>

      <!-- SCAN QR -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/scan-qr">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code-icon lucide-qr-code"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
          </div>
          <span class="menu-text">Scan QR</span>
        </a>
      </li>

      <!-- TRANSAKSI MASSAL -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/transaksi-massal">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered-icon lucide-list-ordered"><path d="M11 5h10"/><path d="M11 12h10"/><path d="M11 19h10"/><path d="M4 4h1v5"/><path d="M4 9h2"/><path d="M6.5 20H3.4c0-1 2.6-1.925 2.6-3.5a1.5 1.5 0 0 0-2.6-1.02"/></svg>
          </div>
          <span class="menu-text">Transaksi Massal</span>
        </a>
      </li>

      <!-- INVENTARIS -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/inventaris">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-boxes-icon lucide-boxes"><path d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z"/><path d="m7 16.5-4.74-2.85"/><path d="m7 16.5 5-3"/><path d="M7 16.5v5.17"/><path d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z"/><path d="m17 16.5-5-3"/><path d="m17 16.5 4.74-2.85"/><path d="M17 16.5v5.17"/><path d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z"/><path d="M12 8 7.26 5.15"/><path d="m12 8 4.74-2.85"/><path d="M12 13.5V8"/></svg>
          </div>
          <span class="menu-text">Inventaris</span>
        </a>
      </li>

      <!-- BARANG MASUK -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/barang-masuk">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive-restore-icon lucide-archive-restore"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h2"/><path d="M20 8v11a2 2 0 0 1-2 2h-2"/><path d="m9 15 3-3 3 3"/><path d="M12 12v9"/></svg>
          </div>
          <span class="menu-text">Barang Masuk</span>
        </a>
      </li>

      <!-- PEMINJAMAN -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/peminjaman">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-repeat-icon lucide-repeat"><path d="m17 2 4 4-4 4"/><path d="M3 11v-1a4 4 0 0 1 4-4h14"/><path d="m7 22-4-4 4-4"/><path d="M21 13v1a4 4 0 0 1-4 4H3"/></svg>
          </div>
          <span class="menu-text">Peminjaman Alat</span>
        </a>
      </li>

      <!-- SISWA -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/siswa">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
          </div>
          <span class="menu-text">Siswa</span>
        </a>
      </li>

      <!-- RUANGAN -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/ruangan">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open-icon lucide-door-open"><path d="M11 20H2"/><path d="M11 4.562v16.157a1 1 0 0 0 1.242.97L19 20V5.562a2 2 0 0 0-1.515-1.94l-4-1A2 2 0 0 0 11 4.561z"/><path d="M11 4H8a2 2 0 0 0-2 2v14"/><path d="M14 12h.01"/><path d="M22 20h-3"/></svg>
          </div>
          <span class="menu-text">Ruangan</span>
        </a>
      </li>

      <!-- RIWAYAT -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/riwayat-aktivitas">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-clock-icon lucide-clipboard-clock"><path d="M16 14v2.2l1.6 1"/><path d="M16 4h2a2 2 0 0 1 2 2v.832"/><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h2"/><circle cx="16" cy="16" r="6"/><rect x="8" y="2" width="8" height="4" rx="1"/></svg>
          </div>
          <span class="menu-text">Riwayat Aktivitas</span>
        </a>
      </li>

      <!-- PROFILE -->
      <li class="nav-item mb-1">
        <a class="nav-link sidebar-link" href="/profile">
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg>
          </div>
          <span class="menu-text">Profile Settings</span>
        </a>
      </li>

    </ul>
  </div>
</aside>

<!-- STYLE (UI ONLY) -->
<style>
/* SIDEBAR */
.sidenav {
  background: linear-gradient(180deg, #ffffff, #ffffff);
  box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

/* BRAND */
.navbar-brand-img {
  height: 34px;
}
.brand-text {
  font-size: 14px;
  font-weight: 600;
  color: #000000;
}

/* MENU LINK */
.sidebar-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 12px;
  color: #7c2d12;
  transition: all .25s ease;
}

.sidebar-link:hover {
  background: rgba(251, 140, 0, 0.15);
  transform: translateX(4px);
}

/* ACTIVE */
.sidebar-link.active {
  background: linear-gradient(135deg, #fb8c00, #ff9800);
  color: #fff;
  box-shadow: 0 6px 20px rgba(251, 140, 0, .4);
}

/* ICON */
.icon-wrapper {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(251, 140, 0, .25);
}

/* TEXT */
.menu-text {
  font-size: 14px;
  font-weight: 500;
}

.sidebar-link .icon-wrapper {
  color: #f97316;
}

.sidebar-link:hover .icon-wrapper {
  color: #f97316;
}


</style>


<!-- SCRIPT ASLI (TIDAK DIUBAH) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname.split('/').pop();
    const fullPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.sidenav .nav-link');

    navLinks.forEach(link => {
        link.classList.remove('active');
    });

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (fullPath.startsWith(href)) {
            link.classList.add('active');
        }
    });
});
</script>
