<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>

<h2>RIWAYAT AKTIVITAS INVENTARIS</h2>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Aktivitas</th>
            <th>Detail</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>

        @foreach($barangMasuks as $b)
        <tr>
            <td>{{ $b->tanggal_masuk }}</td>
            <td>Pemasukan {{ ucfirst($b->jenis_barang) }}</td>
            <td>{{ $b->nama_barang }} ({{ $b->jumlah }})</td>
            <td>{{ $b->admin->name ?? '-' }}</td>
        </tr>
        @endforeach

        @foreach($peminjamans as $p)
        <tr>
            <td>{{ $p->created_at }}</td>
            <td>Peminjaman Alat</td>
            <td>{{ $p->siswa->nama }} - {{ $p->inventory->barangMasuk->nama_barang }}</td>
            <td>{{ $p->admin->name ?? '-' }}</td>
        </tr>
        @endforeach

        @foreach($pengembalians as $k)
        <tr>
            <td>{{ $k->created_at }}</td>
            <td>Pengembalian</td>
            <td>{{ $k->peminjaman->inventory->barangMasuk->nama_barang }} ({{ $k->kondisi }})</td>
            <td>{{ $k->admin->name ?? '-' }}</td>
        </tr>
        @endforeach

        @foreach($pemakaians as $pm)
        <tr>
            <td>{{ $pm->created_at }}</td>
            <td>Pemakaian Bahan</td>
            <td>
                {{ $pm->siswa->nama ?? '-' }}
                - {{ $pm->inventory->barangMasuk->nama_barang ?? '-' }}
                ({{ $pm->jumlah }})
            </td>
            <td>{{ $pm->admin->name ?? '-' }}</td>
        </tr>
        @endforeach

        @foreach($transaksiMassals as $tm)
        <tr>
            <td>{{ $tm->jam_transaksi }}</td>
            <td>Transaksi Massal</td>
            <td>
                <strong>{{ $tm->siswa->nama }}</strong><br>

                @foreach($tm->inventaris as $inv)
                    - {{ $inv->barangMasuk->nama_barang }}
                    x{{ $inv->pivot->quantity }}
                    (Rak: {{ $inv->penempatan_rak ?? '-' }})<br>
                @endforeach

                @if($tm->keperluan)
                    <em>Keperluan: {{ $tm->keperluan }}</em>
                @endif
            </td>
            <td>{{ $tm->admin->name ?? '-' }}</td>
        </tr>
        @endforeach



        @foreach($pelanggarans as $pl)
        <tr>
            <td>{{ $pl->created_at }}</td>
            <td>Pelanggaran Siswa</td>
            <td>{{ $pl->siswa->nama }} - {{ $pl->keterangan }}</td>
            <td>{{ $pl->admin->name ?? '-' }}</td>
        </tr>
        @endforeach

    </tbody>
</table>

</body>
</html>
