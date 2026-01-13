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

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow">

                {{-- HEADER --}}
                <div class="card-header bg-gradient-primary text-white text-center py-3">
                    <h6 class="mb-0">Scan QR Inventaris</h6>
                    <small class="opacity-8">
                        Arahkan kamera ke QR Code
                    </small>
                </div>

                {{-- BODY --}}
                <div class="card-body p-4">

                    {{-- BUTTON CAMERA --}}
                    <div class="d-grid mb-3">
                        <button class="btn btn-dark" id="openCamera">
                            <i class="fas fa-camera me-2"></i>Aktifkan Kamera
                        </button>
                    </div>

                    {{-- SCAN AREA --}}
                    <div class="scan-wrapper mb-3">
                        <div id="reader"
                             class="rounded-4 overflow-hidden"
                             style="width:100%; height:280px; background:#f4f6f8;">
                        </div>
                    </div>

                    {{-- FORM SCAN --}}
                    <form id="scan-form" method="POST" action="{{ route('scan.process') }}">
                        @csrf
                        <input type="hidden" name="qr_code" id="qr_code">
                    </form>

                    {{-- STATUS --}}
                    <div class="text-center mb-3">
                        <span class="badge bg-secondary px-3 py-2" id="scanStatus">
                            Kamera belum aktif
                        </span>
                    </div>

                    {{-- OUTPUT --}}
                    <input type="text"
                           class="form-control text-center"
                           id="outputQR"
                           placeholder="Hasil QR akan muncul di sini"
                           readonly>

                    {{-- MANUAL INPUT --}}
                    <hr class="my-4">

                    <form method="POST" action="{{ route('scan.process') }}">
                        @csrf
                        <label class="form-label fw-semibold">
                            Input Manual Kode QR
                        </label>
                        <div class="input-group input-group-outline">
                            <input type="text"
                                   name="qr_code"
                                   class="form-control"
                                   placeholder="ALT-XX-XXX / BHN-XX-XXX"
                                   required>
                            <button type="submit" class="btn bg-gradient-primary mb-0 d-flex align-items-center justify-content-center">
                                Proses
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
  /* Disable input and button animations */
  .input-group input,
  .input-group .btn,
  .form-control {
    transition: none !important;
    transform: scale(1) !important;
  }

  .input-group input:focus,
  .input-group input:active,
  .input-group .btn:focus,
  .input-group .btn:active,
  .form-control:focus,
  .form-control:active {
    transform: scale(1) !important;
    transition: none !important;
  }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let html5Qr;
let isScanning = false;

document.getElementById('openCamera').addEventListener('click', () => {

    if (isScanning) return;

    document.getElementById('scanStatus').innerText = "Mengaktifkan kamera...";

    html5Qr = new Html5Qrcode("reader");

    html5Qr.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 220, height: 220 }
        },
        async (decodedText) => {

            if (isScanning) return;
            isScanning = true;

            document.getElementById('outputQR').value = decodedText;
            document.getElementById('scanStatus').innerText = "QR terbaca, memproses...";

            await html5Qr.stop();
            html5Qr.clear();

            document.getElementById('qr_code').value = decodedText;
            document.getElementById('scan-form').submit();
        }
    ).catch(err => {
        document.getElementById('scanStatus').innerText = "Kamera tidak bisa diakses";
        console.error(err);
    });
});
</script>
@endpush

@section('footer')
@include('be.footer')
@endsection
