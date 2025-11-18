@extends ('be.layout')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA INVENTARIS</h4>
                </div>
                <div class="card-body">
                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <button class="btn btn-success" onclick="showAddModal()">Tambah Barang Baru</button>
                            <button class="btn btn-primary" onclick="showUpdateModal()">Perbarui Barang</button>
                            <button class="btn btn-danger" onclick="deleteItem()">Hapus Barang</button>
                            <button class="btn btn-info" onclick="generateBarcode()">Generate Barcode</button>
                        </div>
                        <div>
                            <button class="btn btn-secondary" onclick="exportToExcel()">Export Excel</button>
                            <button class="btn btn-secondary" onclick="exportToPDF()">Export PDF</button>
                            <input type="file" id="importFile" accept=".xlsx" class="btn btn-secondary" onchange="importFromExcel()">
                        </div>
                    </div>
                    
                    <!-- Tabel Inventaris -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="inventoryTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Kondisi</th>
                                    <th>Jumlah Stok</th>
                                    <th>Ketersediaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data contoh (ganti dengan data dari controller jika ada) -->
                                <tr>
                                    <td>001</td>
                                    <td>Laptop</td>
                                    <td>Elektronik</td>
                                    <td>Baik</td>
                                    <td>10</td>
                                    <td>Tersedia</td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>Meja</td>
                                    <td>Furnitur</td>
                                    <td>Rusak</td>
                                    <td>5</td>
                                    <td>Tidak Tersedia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Barang Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3">
                        <label for="addKode" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="addKode" required>
                    </div>
                    <div class="mb-3">
                        <label for="addNama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="addNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="addJenis" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="addJenis" required>
                    </div>
                    <div class="mb-3">
                        <label for="addKondisi" class="form-label">Kondisi</label>
                        <select class="form-control" id="addKondisi" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addStok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" id="addStok" required>
                    </div>
                    <div class="mb-3">
                        <label for="addKetersediaan" class="form-label">Ketersediaan</label>
                        <select class="form-control" id="addKetersediaan" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="addItem()">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perbarui Barang -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Perbarui Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="mb-3">
                        <label for="updateKode" class="form-label">Kode Barang (untuk update)</label>
                        <input type="text" class="form-control" id="updateKode" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateKondisi" class="form-label">Kondisi Baru</label>
                        <select class="form-control" id="updateKondisi">
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateStok" class="form-label">Jumlah Stok Baru</label>
                        <input type="number" class="form-control" id="updateStok">
                    </div>
                    <div class="mb-3">
                        <label for="updateKetersediaan" class="form-label">Ketersediaan Baru</label>
                        <select class="form-control" id="updateKetersediaan">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateItem()">Perbarui</button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas untuk Barcode -->
<canvas id="barcodeCanvas" style="display: none;"></canvas>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    let selectedRow = null;

    function showAddModal() {
        $('#addModal').modal('show');
    }

    function showUpdateModal() {
        $('#updateModal').modal('show');
    }

    function addItem() {
        const kode = document.getElementById('addKode').value;
        const nama = document.getElementById('addNama').value;
        const jenis = document.getElementById('addJenis').value;
        const kondisi = document.getElementById('addKondisi').value;
        const stok = document.getElementById('addStok').value;
        const ketersediaan = document.getElementById('addKetersediaan').value;
        
        if (kode && nama && jenis && kondisi && stok && ketersediaan) {
            const table = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `<td>${kode}</td><td>${nama}</td><td>${jenis}</td><td>${kondisi}</td><td>${stok}</td><td>${ketersediaan}</td>`;
            $('#addModal').modal('hide');
            document.getElementById('addForm').reset();
        }
    }

    function updateItem() {
        const kode = document.getElementById('updateKode').value;
        const kondisi = document.getElementById('updateKondisi').value;
        const stok = document.getElementById('updateStok').value;
        const ketersediaan = document.getElementById('updateKetersediaan').value;
        
        const rows = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0].rows;
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].cells[0].innerText === kode) {
                if (kondisi) rows[i].cells[3].innerText = kondisi;
                if (stok) rows[i].cells[4].innerText = stok;
                if (ketersediaan) rows[i].cells[5].innerText = ketersediaan;
                break;
            }
        }
        $('#updateModal').modal('hide');
        document.getElementById('updateForm').reset();
    }

    function deleteItem() {
        const kode = prompt('Masukkan Kode Barang untuk dihapus:');
        if (kode) {
            const rows = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0].rows;
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].cells[0].innerText === kode) {
                    rows[i].remove();
                    break;
                }
            }
        }
    }

    function generateBarcode() {
        const kode = prompt('Masukkan Kode Barang untuk generate barcode:');
        if (kode) {
            JsBarcode("#barcodeCanvas", kode);
            document.getElementById('barcodeCanvas').style.display = 'block';
            alert('Barcode generated. Lihat canvas di bawah tabel.');
        }
    }

    function exportToExcel() {
        const table = document.getElementById('inventoryTable');
        const wb = XLSX.utils.table_to_book(table, {sheet: "Inventaris"});
        XLSX.writeFile(wb, 'inventaris.xlsx');
    }

    function exportToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text('Data Inventaris', 10, 10);
        const table = document.getElementById('inventoryTable');
        doc.autoTable({ html: table });
        doc.save('inventaris.pdf');
    }

    function importFromExcel() {
        const file = document.getElementById('importFile').files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {type: 'array'});
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const json = XLSX.utils.sheet_to_json(sheet);
            const table = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0];
            table.innerHTML = '';
            json.forEach(row => {
                const newRow = table.insertRow();
                newRow.innerHTML = `<td>${row['Kode Barang'] || ''}</td><td>${row['Nama Barang'] || ''}</td><td>${row['Jenis Barang'] || ''}</td><td>${row['Kondisi'] || ''}</td><td>${row['Jumlah Stok'] || ''}</td><td>${row['Ketersediaan'] || ''}</td>`;
            });
        };
        reader.readAsArrayBuffer(file);
    }
</script>
@endpush
@endsection

@section('footer')
    @include('be.footer')
@endsection