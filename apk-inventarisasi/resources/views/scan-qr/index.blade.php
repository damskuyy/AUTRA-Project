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

    <div class="row mb-3">
        <div class="col-12 text-center">
            <button class="btn btn-dark px-4" id="openCamera">
                <i class="fas fa-camera me-2"></i>Aktifkan Kamera
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card border-0 shadow-sm p-3">

                <h6 class="text-center text-muted mb-3">
                    Arahkan QR Code ke kamera
                </h6>

                <!-- WAJIB ADA -->
                <div id="reader"
                     style="width:100%; height:300px; border-radius:20px; overflow:hidden;">
                </div>

                <form id="scan-form" method="POST" action="{{ route('scan.process') }}">
                    @csrf
                    <input type="hidden" name="qr_code" id="qr_code">
                </form>


                <div class="mt-3 text-center">
                    <small class="text-muted" id="scanStatus">
                        Kamera belum aktif
                    </small>
                </div>

                <div class="mt-3">
                    <input type="text" class="form-control" id="outputQR" readonly>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let html5Qr;

document.getElementById('openCamera').addEventListener('click', () => {

    document.getElementById('scanStatus').innerText = "Mengaktifkan kamera...";

    html5Qr = new Html5Qrcode("reader");

    html5Qr.start(
        { facingMode: "environment" },
        {
            fps: 15,
            qrbox: { width: 220, height: 220 }
        },
        (decodedText) => {

            document.getElementById('outputQR').value = decodedText;
            document.getElementById('scanStatus').innerText = "QR terbaca";

            html5Qr.stop();

            // MASUKKAN KE FORM
            document.getElementById('qr_code').value = decodedText;

            // SUBMIT KE ScanController@process
            document.getElementById('scan-form').submit();
        }
    ).catch(err => {
        alert("Kamera tidak bisa diakses");
        console.error(err);
    });
});
</script>
@endpush

@section('footer')
@include('be.footer')
@endsection
