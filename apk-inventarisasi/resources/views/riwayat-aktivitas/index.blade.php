@extends ('be.layout')

@php
  $title = 'Riwayat Aktivitas';
  $breadcrumb = 'Riwayat';
@endphp

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid py-4">

    {{-- HEADER + EXPORT --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-3">
        <div>
            <h3 class="mb-0">Riwayat Aktivitas</h3>
            <small class="text-muted">Ringkasan aktivitas perangkat dan siswa — kelola, ekspor, dan cari cepat.</small>
        </div>

        <div class="d-flex gap-3">
            <a href="{{ route('riwayat-aktivitas.export.pdf', request()->query()) }}"
            class="btn btn-light btn-icon-only border px-5 py-3  d-flex justify-content-center align-items-center">
                <i class="fas fa-file-pdf text-danger fs-4"></i>
            </a>

            <a href="{{ route('riwayat-aktivitas.export.excel', request()->query()) }}"
            class="btn btn-light btn-icon-only border px-5 py-3  d-flex justify-content-center align-items-center">
                <i class="fas fa-file-excel text-success fs-4"></i>
            </a>
        </div>



    </div>

    {{-- STATS & CONTROLS --}}
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $barangMasuks->count() }}</div>
                                <small class="text-muted">Barang Masuk</small>
                            </div>
                            <div class="vr"></div>
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $peminjamans->count() }}</div>
                                <small class="text-muted">Peminjaman</small>
                            </div>
                            <div class="vr"></div>
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $pengembalians->count() }}</div>
                                <small class="text-muted">Pengembalian</small>
                            </div>
                            <div class="vr"></div>
                            <div class="text-center">                                <div class="h5 mb-0">{{ $transaksiMassals->count() }}</div>
                                <small class="text-muted">Transaksi Massal</small>
                            </div>
                            <div class="vr"></div>
                            <div class="text-center">                                <div class="h5 mb-0">{{ $pelanggarans->count() }}</div>
                                <small class="text-muted">Pelanggaran</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterRiwayat" aria-expanded="false" aria-controls="filterRiwayat" id="btnFilter">
                                <i class="fas fa-filter me-1"></i><span id="filterText">Filter</span>
                            </button>

                            <a href="{{ route('riwayat-aktivitas.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- COLLAPSE FILTER --}}
                
                <div id="filterRiwayat" class="collapse {{ request()->query() ? 'show' : ""}}">
                    <div class="card-body border-top">
                        <form method="GET" action="{{ route('riwayat-aktivitas.index') }}">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Dari</label>
                                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Sampai</label>
                                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Nama Siswa</label>
                                    <input type="text" name="siswa" value="{{ request('siswa') }}" class="form-control form-control-sm" placeholder="Cari siswa...">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Kelas</label>
                                    <select name="kelas" class="form-control form-control-sm">
                                        <option value="">Semua</option>
                                        @foreach ($kelasList ?? [] as $kelas)
                                            <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Jenis Aktivitas</label>
                                    <select name="jenis" class="form-control form-control-sm">
                                        <option value="">Semua</option>
                                        <option value="barang_masuk" {{ request('jenis')=='barang_masuk'?'selected':'' }}>Barang Masuk</option>
                                        <option value="peminjaman" {{ request('jenis')=='peminjaman'?'selected':'' }}>Peminjaman</option>
                                        <option value="pengembalian" {{ request('jenis')=='pengembalian'?'selected':'' }}>Pengembalian</option>
                                        <option value="pemakaian" {{ request('jenis')=='pemakaian'?'selected':'' }}>Pemakaian</option>
                                        <option value="transaksi_massal" {{ request('jenis')=='transaksi_massal'?'selected':'' }}>Transaksi Massal</option>
                                        <option value="banned" {{ request('jenis')=='banned'?'selected':'' }}>Pelanggaran</option>
                                    </select>
                                </div>

                                <div class="col-md-4 d-flex align-items-end gap-2 mt-5">
                                    <button class="btn btn-primary w-50 btn-sm" type="submit"><i class="fas fa-search me-1"></i> Terapkan Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div id="activityEmpty" class="text-center text-muted py-5" style="display:none;">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <h5 class="mb-0">Tidak ada riwayat yang cocok</h5>
                <div class="small">Coba ubah filter atau hapus kata kunci pencarian</div>
            </div>

            <div id="activityList">

                {{-- BARANG MASUK --}}
                @foreach ($barangMasuks as $bm)
                    <div class="activity-item mb-3 p-3 border rounded" data-type="barang_masuk">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-circle bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:42px;height:42px;"><i class="fas fa-box"></i></div>
                                    <div>
                                        <div class="fw-semibold">{{ $bm->nama_barang }}</div>
                                        <div class="small text-muted">Masuk: {{ $bm->jumlah }} {{ $bm->satuan ?? 'unit' }} • {{ $bm->created_at->format('d M Y H:i') }} ({{ $bm->created_at->diffForHumans() }})</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end text-muted small">{{ $bm->admin->name ?? '-' }}</div>
                        </div>
                    </div>
                @endforeach
                {{-- TRANSAKSI MASSAL --}}
                @foreach ($transaksiMassals as $tm)
                <div class="activity-item mb-3 p-3 border rounded" data-type="transaksi_massal">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-3">
                            <div class="icon-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width:42px;height:42px;">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">
                                    Transaksi massal oleh {{ $tm->siswa->nama }}
                                </div>
                                <div class="small text-muted">
                                    {{ $tm->created_at->format('d M Y H:i') }}
                                    ({{ $tm->created_at->diffForHumans() }})
                                </div>
                                <div class="small text-muted mt-1">
                                    @foreach($tm->inventaris as $inv)
                                        <div>• {{ $inv->barangMasuk->nama_barang }}
                                        @if($inv->barangMasuk->jenis_barang == 'bahan')
                                            ({{ $inv->pivot->quantity }} {{ $inv->barangMasuk->satuan }} - pemakaian)
                                        @else
                                            ({{ $inv->kode_qr_jurusan }} - peminjaman)
                                        @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-muted small">
                            {{ $tm->admin->name ?? '-' }}
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- PEMINJAMAN --}}
                @foreach ($peminjamans as $p)
                    <div class="activity-item mb-3 p-3 border rounded" data-type="peminjaman">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-circle bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:42px;height:42px;"><i class="fas fa-user"></i></div>
                                    <div>
                                        <div class="fw-semibold">{{ $p->siswa->nama }} <span class="text-muted">meminjam</span> <strong>{{ $p->inventory->barangMasuk->nama_barang }}</strong></div>
                                        <div class="small text-muted">{{ $p->created_at->format('d M Y H:i') }} ({{ $p->created_at->diffForHumans() }})</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end text-muted small">{{ $p->admin->name ?? '-' }}</div>
                        </div>
                    </div>
                @endforeach

                {{-- PENGEMBALIAN --}}
                @foreach ($pengembalians as $k)

                    {{-- PENGEMBALIAN SATUAN --}}
                    @if ($k instanceof \App\Models\Pengembalian)
                        <div class="activity-item mb-3 p-3 border rounded" data-type="pengembalian">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="icon-circle bg-info text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width:42px;height:42px;">
                                            <i class="fas fa-undo"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">
                                                {{ $k->peminjaman->siswa->nama }}
                                                mengembalikan
                                                <strong>{{ $k->peminjaman->inventory->barangMasuk->nama_barang }}</strong>
                                            </div>
                                            <div class="small text-muted">
                                                Kondisi: <strong class="text-danger">{{ $k->kondisi }}</strong> •
                                                {{ $k->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end text-muted small">{{ $k->admin->name ?? '-' }}</div>
                            </div>
                        </div>

                    {{-- PENGEMBALIAN MASSAL --}}
                    @elseif ($k instanceof \App\Models\TransaksiMassal)
                    <div class="activity-item mb-3 p-3 border rounded" data-type="pengembalian">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <div class="icon-circle bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:42px;height:42px;">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $k->siswa->nama }} mengembalikan transaksi massal
                                    </div>
                                    <div class="small text-muted">
                                        {{ $k->updated_at->format('d M Y H:i') }}
                                    </div>

                                    {{-- LIST ALAT SAJA --}}
                                    <div class="small text-muted mt-1">
                                        @foreach ($k->inventaris as $inv)
                                            @if ($inv->barangMasuk->jenis_barang !== 'bahan')
                                                <div>
                                                    • {{ $inv->barangMasuk->nama_barang }}
                                                    ({{ $inv->kode_qr_jurusan }})
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="text-muted small">{{ $k->admin->name ?? '-' }}</div>
                        </div>
                    </div>
                @endif


                @endforeach


                {{-- PEMAKAIAN BAHAN --}}
                @foreach ($pemakaians as $pb)
                <div class="activity-item mb-3 p-3 border rounded" data-type="pemakaian">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-3">
                            <div class="icon-circle bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center"
                                style="width:42px;height:42px;">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">
                                    {{ $pb->siswa->nama }} memakai
                                    <strong>{{ $pb->inventory->barangMasuk->nama_barang }}</strong>
                                </div>
                                <div class="small text-muted">
                                    Jumlah: {{ $pb->jumlah }} •
                                    {{ $pb->created_at->format('d M Y H:i') }}
                                    ({{ $pb->created_at->diffForHumans() }})
                                </div>
                            </div>
                        </div>
                        <div class="text-muted small">
                            {{ $pb->admin->name ?? '-' }}
                        </div>
                    </div>
                </div>
                @endforeach


                {{-- PELANGGARAN --}}
                @foreach ($pelanggarans as $pl)
                    <div class="activity-item mb-3 p-3 border rounded" data-type="pelanggaran">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-circle bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:42px;height:42px;"><i class="fas fa-exclamation-triangle"></i></div>
                                    <div>
                                        <div class="fw-semibold">{{ $pl->siswa->nama }} <span class="text-muted">({{ $pl->siswa->kelas }})</span></div>
                                        <div class="small text-muted">{{ $pl->created_at->format('d M Y H:i') }} ({{ $pl->created_at->diffForHumans() }})</div>
                                        <div class="small mt-1">
                                            <strong>Pelanggaran:</strong> 
                                            @switch($pl->tipe)
                                                @case('TELAT_KEMBALI')
                                                    Telat Mengembalikan Alat
                                                    @break
                                                @case('KERUSAKAN')
                                                    Merusakkan Alat
                                                    @break
                                                @case('HILANG')
                                                    Menghilangkan Alat
                                                    @break
                                                @default
                                                    {{ $pl->tipe }}
                                            @endswitch
                                            ({{ $pl->poin }} poin)
                                            @if($pl->keterangan)
                                                <br><em>{{ $pl->keterangan }}</em>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end text-muted small">{{ $pl->admin->name ?? '-' }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- SMALL INLINE STYLES & SCRIPTS (kept local to file for faster iteration) --}}
    <style>
        .icon-circle { font-size: 16px; }
        .tab-filter.active { background-color: #f8f9fa; }
        .activity-item:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.04); transform: translateY(-1px); transition: all 0.12s ease; }
        .vr { width:1px; background:#e9ecef; height:36px; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const filter = document.getElementById('filterRiwayat');
        const text = document.getElementById('filterText');

        filter.addEventListener('shown.bs.collapse', function () {
            text.innerText = 'Tutup Filter';
        });

        filter.addEventListener('hidden.bs.collapse', function () {
            text.innerText = 'Filter';
        });
    });
    </script>

</div>
@endsection


@section('footer')
    @include('be.footer')
@endsection