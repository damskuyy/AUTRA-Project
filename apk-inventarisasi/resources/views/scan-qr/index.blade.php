@extends ('be.layout')

@php
  $title = 'Scan QR';
  $breadcrumb = 'Scan';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
    <div class="container-fluid py-4">

    <!-- Judul -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button class="btn btn-dark btn-sm px-4" id="dummyOpenCamera">
                    <i class="fas fa-camera me-2"></i>Aktifkan Kamera
                </button>
            </div>
        </div>
    </div>

    <!-- Card Camera -->
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card shadow-sm hover-card border-0 p-3">

                <h6 class="text-center text-secondary mb-3">
                    Arahkan QR Code ke Kamera
                </h6>

                <!-- AREA PREVIEW KAMERA -->
                <div class="qr-camera-preview d-flex justify-content-center align-items-center"
                     style="height: 300px;
                            border-radius: 20px;
                            background: #f1f1f1;
                            border: 2px dashed #cbd5e1;
                            position: relative;
                            overflow: hidden;">
                    <i class="fas fa-qrcode fa-4x text-secondary opacity-50"></i>

                    <!-- fake overlay when scanning -->
                    <div id="scanLine"
                        style="position:absolute;
                               top:0;
                               width:100%;
                               height:4px;
                               background:red;
                               opacity:0.7;
                               display:none;">
                    </div>
                </div>

                <!-- Text Status -->
                <div class="mt-3 text-center">
                    <small class="text-muted" id="scanStatus">
                        Kamera belum aktif — tekan tombol untuk memulai
                    </small>
                </div>

                <!-- Hasil Scan -->
                <div class="mt-4">
                    <label class="form-label">ID Barang Terbaca</label>
                    <input type="text" class="form-control" placeholder="Hasil Scan QR tampil di sini"
                           disabled id="outputQR">
                </div>

                <!-- Simulasi Tombol (Tampilan Saja) -->
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-success w-50" disabled id="btnLanjut">
                        <i class="fas fa-arrow-right me-2"></i>Lanjutkan
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // ---- SIMULASI SAJA ----
    document.getElementById("dummyOpenCamera").addEventListener("click", () => {

        // Animasi garis scan
        const scanLine = document.getElementById("scanLine");
        scanLine.style.display = "block";
        scanLine.animate([
            { top: "0px" },
            { top: "296px" },
            { top: "0px" }
        ], {
            duration: 2000,
            iterations: Infinity
        });

        document.getElementById("scanStatus").innerText = "Scanning... Arahkan QR ke kamera";

        // Simulasi 3 detik lalu QR terbaca
        setTimeout(() => {
            document.getElementById("scanStatus").innerText = "QR Terbaca";
            document.getElementById("outputQR").value = "ALT-0021"; // contoh dari alur
            document.getElementById("btnLanjut").disabled = false;
            scanLine.style.display = "none";
        }, 3000);
    });
</script>
@endpush

@section('footer')
    @include('be.footer')
@endsection