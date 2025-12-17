@extends('be.layout')

@php
  $title = 'Pemakaian Bahan';
  $breadcrumb = 'Pemakaian';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted small">Form pemakaian bahan habis pakai setelah scan QR</p>
        </div>
    </div>

    {{-- CARD FORM --}}
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-flask me-2"></i>Pemakaian Bahan (Habis Pakai)</h6>
        </div>

        <div class="card-body">

            {{-- Data Bahan --}}
            <h6 class="fw-bold mb-3">Informasi Bahan</h6>
            <div class="row g-3 mb-4">

                <div class="col-md-4">
                    <small class="text-muted">Nama Bahan</small>
                    <div class="fw-bold" id="namaBahan">Alkohol 70%</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Jenis Bahan</small>
                    <div class="fw-bold" id="jenisBahan">Cair</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Stok Tersedia</small>
                    <div class="fw-bold text-success" id="stokBahan">50</div>
                </div>

            </div>

            <hr>

            {{-- FORM --}}
            <h6 class="fw-bold mb-3">Form Pemakaian</h6>

            <div class="row g-3">

                {{-- Nama siswa --}}
                <div class="col-md-6">
                    <label class="form-label">Nama Siswa</label>
                    <select id="namaSiswa" class="form-control">
                        <option selected disabled>Pilih siswa...</option>
                        <option>Aldi Ramadhan</option>
                        <option>Dewi Lestari</option>
                        <option class="text-danger">Budi Prasetyo (BANNED)</option>
                    </select>
                </div>

                {{-- Kelas otomatis --}}
                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" id="kelasSiswa" class="form-control" value="-" readonly>
                </div>

                {{-- Jam pengambilan otomatis --}}
                <div class="col-md-3">
                    <label class="form-label">Jam Pengambilan</label>
                    <input type="text" class="form-control" value="{{ date('H:i') }}" readonly>
                </div>

                {{-- Jumlah pemakaian --}}
                <div class="col-md-4">
                    <label class="form-label">Jumlah Dipakai</label>
                    <input type="number" id="jumlahPakai" min="1" class="form-control" placeholder="Masukkan jumlah...">
                </div>

                {{-- Catatan --}}
                <div class="col-md-8">
                    <label class="form-label">Catatan (opsional)</label>
                    <input type="text" class="form-control" placeholder="Contoh: untuk praktikum kelas XII">
                </div>

            </div>

            {{-- Tombol --}}
            <div class="mt-4 text-end">
                <button id="btnKonfirmasi" class="btn btn-success px-4">
                    <i class="fas fa-check me-1"></i> Konfirmasi Pemakaian
                </button>
            </div>

        </div>
    </div>

</div>

{{-- SCRIPT VALIDASI UI (DUMMY) --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const siswaSelect = document.getElementById("namaSiswa");
    const kelasInput = document.getElementById("kelasSiswa");
    const jumlahPakai = document.getElementById("jumlahPakai");
    const stokBahan = parseInt(document.getElementById("stokBahan").innerText);
    const btnConfirm = document.getElementById("btnKonfirmasi");

    // Dummy data kelas siswa
    const kelasMap = {
        "Aldi Ramadhan": "XII RPL 2",
        "Dewi Lestari": "XI TKJ 1",
        "Budi Prasetyo (BANNED)": "XII RPL 3"
    };

    // Jika siswa dipilih → kelas muncul otomatis
    siswaSelect.addEventListener("change", () => {
        kelasInput.value = kelasMap[siswaSelect.value] ?? "-";
        validateForm();
    });

    // Validasi stok vs jumlah
    jumlahPakai.addEventListener("input", validateForm);

    function validateForm() {

        let siswa = siswaSelect.value;
        let jumlah = parseInt(jumlahPakai.value);

        // reset tombol
        btnConfirm.classList.remove("btn-danger", "btn-warning", "btn-success");
        btnConfirm.classList.add("btn-success");
        btnConfirm.innerHTML = `<i class="fas fa-check me-1"></i> Konfirmasi Pemakaian`;

        // 1. VALIDASI SISWA BANNED
        if (siswa && siswa.includes("BANNED")) {
            btnConfirm.classList.remove("btn-success");
            btnConfirm.classList.add("btn-danger");
            btnConfirm.innerHTML = `<i class="fas fa-ban me-1"></i> Siswa DIBANNED`;
            return;
        }

        // 2. VALIDASI STOK CUKUP
        if (jumlah > stokBahan) {
            btnConfirm.classList.remove("btn-success");
            btnConfirm.classList.add("btn-danger");
            btnConfirm.innerHTML = `<i class="fas fa-times me-1"></i> Stok Tidak Cukup`;
            return;
        }

        // Jika lolos semua, kembali normal
        btnConfirm.classList.add("btn-success");
    }

});
</script>

@endsection

@section('footer')
    @include('be.footer')
@endsection