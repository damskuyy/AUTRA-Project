port :
inventaris 8000
monitoring 8001
landing page 3000

# AUTRA Project

 **Ringkasan**

Repositori ini berisi beberapa aplikasi yang saling berkaitan:

- `apk-inventarisasi` — aplikasi Laravel untuk manajemen inventaris.
- `apk-monitoring` — aplikasi Laravel untuk monitoring sensor & PLC (termasuk skrip Python di `plc/`).
- `landing-page` — situs frontend Next.js + Tailwind untuk landing page.
- SQL dump: `autra_project.sql` dan skrip backup `backup_autra.bat`.

---

## Tech stack

- Backend: **PHP** + **Laravel** (modern, Laravel 9/10 kompatibel)
- Frontend: **Tailwind CSS**, **Vite**, **Next.js** (untuk `landing-page`)
- DB: **MySQL / MariaDB**
- Package managers: **Composer**, **npm / yarn / pnpm**
- Scripting (PLC): **Python 3.8+** (pustaka di `apk-monitoring/plc/requirements.txt`)
- Dev tools: Git, PHPUnit / Laravel Test Suite

---

## Requirements

Sebelum instalasi, pastikan terpasang:

- Windows (direkomendasikan XAMPP) atau Linux/macOS
- PHP 8.1+ dengan ekstensi umum (PDO, OpenSSL, Mbstring, Ctype, JSON, Tokenizer, XML, BCMath)
- Composer
- Node.js (v16+ direkomendasikan) dan npm/yarn/pnpm
- MySQL / MariaDB
- Python 3.8+ (hanya untuk skrip PLC di `apk-monitoring/plc`)
- Git

---

## Cara instalasi (umum)

1. Clone repository:

   ```bash
   git clone <repo-url>
   cd AUTRA-Project
   ```

2. Import SQL (opsional, menyediakan data awal):

   - Gunakan `autra_project.sql` di root untuk mengisi database jika diinginkan.
   - Atau buat database baru dan jalankan migrasi dan seeder tiap aplikasi.

3. Aplikasi Laravel (`apk-inventarisasi` dan `apk-monitoring`):

   Untuk setiap aplikasi Laravel, ulangi langkah ini di root subfolder aplikasi:

   ```bash
   cd apk-inventarisasi
   composer install
   cp .env.example .env
   php artisan key:generate
   # atur konfigurasi DB di .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
   php artisan migrate --seed
   npm install
   npm run dev
   php artisan storage:link   # jika perlu
   php artisan serve --port=8001  # contoh port (ubah sesuai kebutuhan)
   ```

   Ulangi untuk `apk-monitoring` (ganti direktori dan port jika diperlukan).

4. Landing page (`landing-page`):

   ```bash
   cd landing-page
   npm install
   npm run dev
   # akses biasanya http://localhost:3000
   ```

5. Skrip PLC (opsional, `apk-monitoring/plc`):

   ```bash
   cd apk-monitoring/plc
   python -m venv venv     # opsional, gunakan virtualenv
   venv\Scripts\activate # Windows
   pip install -r requirements.txt
   # contoh menjalankan pembaca MQTT/PLC
   python mqtt_reader.py
   ```

6. Menjalankan test:

   ```bash
   # di folder aplikasi Laravel
   php artisan test
   # atau
   ./vendor/bin/phpunit
   ```

---

## Catatan & tips

- Pastikan setiap `.env` sudah diisi dengan kredensial DB dan konfigurasi yang benar (MAIL, QUEUE, dsb.).
- Gunakan `autra_project.sql` jika ingin memulai dengan data yang sudah ada.
- Untuk environment produksi, jangan gunakan `php artisan serve`; gunakan webserver (Apache/Nginx) dan supervisor untuk queue.
- Backup: `backup_autra.bat` tersedia untuk backup DB (periksa dan sesuaikan sebelum dipakai).

---

## Struktur API & Lokasi File (detail per aplikasi)

Berikut lokasi berkas yang berhubungan dengan API dan titik masuk (routes, controller, model, script) untuk tiap sub-aplikasi.

### `apk-inventarisasi` (Laravel)

- **Routes (API):** `apk-inventarisasi/routes/api.php`
  - Contoh endpoint: `GET /api/sarpras/by-kode-barang/{kode}` → `App\Http\Controllers\Api\ScanSarprasController@byKodeBarang`
- **Routes (Web/UI):** `apk-inventarisasi/routes/web.php` (resource routes seperti `inventaris`, `peminjaman`, dsb.)
- **Controller (API):** `apk-inventarisasi/app/Http/Controllers/Api/ScanSarprasController.php`
- **Controller (Web):** `apk-inventarisasi/app/Http/Controllers/` (mis.`InventoriesController`, `PeminjamanController`, `ScanController`)
- **Models:** `apk-inventarisasi/app/Models/` (mis. `Inventory.php`, `Siswa.php`)
- **Import/Export:** `apk-inventarisasi/app/Imports/` dan `apk-inventarisasi/app/Exports/` (`SiswaImport`, `RiwayatExport`)
- **Config eksternal API:** `apk-inventarisasi/config/services.php` — kunci `sarpras.base_url` (env `SARPRAS_API_BASE_URL`)
- **Migrations & Seeders:** `apk-inventarisasi/database/migrations/` dan `.../seeders/`

Contoh memanggil API lokal (dianggap aplikasi berjalan di `http://localhost:8001`):

```bash
curl "http://localhost:8001/api/sarpras/by-kode-barang/KODE123"
```

---

### `apk-monitoring` (Laravel + PLC)

### Tech Stack

**Backend (Web):**

* Laravel 11 (PHP 8.2+)
* MySQL / MariaDB
* REST API (JSON)

**Data Ingestion (PLC Bridge):**

* Python 3.10+
* paho-mqtt (MQTT Client)
* MySQL Connector (mysql-connector-python / pymysql)

**Frontend:**

* Blade Template (Laravel)
* Chart.js (Realtime Chart)
* Vanilla JavaScript (Fetch API)
* CSS Custom Dashboard UI

---

### Requirements

Sebelum menjalankan project dari repository GitHub, pastikan software berikut sudah terinstall:

#### 1. Web Backend (Laravel)

* PHP >= 8.2
* Composer
* MySQL / MariaDB
* Node.js & NPM (opsional, jika build asset)

#### 2. Python Data Collector (PLC → Database)

* Python >= 3.10
* Library Python untuk MQTT:

  ```bash
  pip install paho-mqtt 
  ```

  Dan Library Python untuk menghubungkan ke Database:

  ```bash
  pip install paho-mqtt mysql-connector-python
  ```
* MQTT Broker (Mosquitto / EMQX / PLC MQTT Gateway)

---

### Installation (Clone dari GitHub Repo)

#### 1. Clone Repository

```bash
git clone https://github.com/[username]/AUTRA-Project.git
cd AUTRA-Project/apk-monitoring
```

#### 2. Setup Laravel Backend

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Edit file `.env`:

```env
DB_DATABASE=autra_project
DB_USERNAME=root
DB_PASSWORD=
```

Migrasi database:

```bash
php artisan migrate
```

Seeding user login (hanya untuk user):
```bash
php artisan db:seed
```

Jalankan server Laravel:

```bash
php artisan serve —-port=8001
```

Akses dashboard:

```
http://127.0.0.1:8001/
atau
http://127.0.0.1:8001/dashboard
```

---

#### 3. Setup Python PLC Data Reader

Masuk ke folder PLC script:

```bash
cd plc
```

Install library Python:

```bash
pip install paho-mqtt mysql-connector-python
```

Jalankan script MQTT reader:

```bash
python mqtt_reader.py
```

Script ini akan:

* Subscribe ke MQTT topic PLC
* Menyimpan data ke MySQL setiap 1 menit
* Menjaga maksimal 100 data terbaru (data lama otomatis dihapus)

---

### Workflow Sistem

1. PLC mengirim data ke MQTT Broker
2. Python script membaca MQTT dan simpan ke MySQL
3. Laravel mengambil data dari database
4. Dashboard menampilkan data realtime via API polling

---

### Notes Penting

* Jika PLC tidak terhubung, dashboard akan menampilkan **NO DATA / OFFLINE**
* Interval polling dashboard default: 3 detik (bisa diubah di JavaScript)
* Data sensor tersimpan maksimal 100 record (rolling buffer)

---

## 3. System Architecture (Professional Overview)

### High-Level Architecture

**End-to-End Data Pipeline:**

PLC / Sensor Device → MQTT Broker → Python Data Collector → MySQL Database → Laravel Backend → Web Dashboard

### Component Responsibilities

* **PLC / Sensor Device**: Mengirim data sensor (temperature, humidity, light intensity) dalam format JSON melalui MQTT.
* **MQTT Broker**: Message broker (Mosquitto / EMQX) yang menangani publish–subscribe data PLC.
* **Python Data Collector (Bridge Layer)**: Service yang subscribe ke MQTT, parsing payload, validasi data, dan insert ke database.
* **MySQL Database**: Menyimpan data sensor historis dan status konektivitas PLC.
* **Laravel Backend**: Menyediakan API, business logic, dan data aggregation untuk dashboard.
* **Web Dashboard (Frontend)**: Visualisasi realtime data menggunakan Chart.js dan Blade template.

### Logical Data Flow

1. PLC publish data ke MQTT topic tertentu.
2. Python service menerima payload MQTT.
3. Data diparsing dan divalidasi.
4. Data disimpan ke MySQL dengan timestamp (`received_at`).
5. Laravel mengambil data terbaru dan histori melalui Eloquent ORM.
6. Frontend melakukan polling API untuk update chart dan card sensor.

---

## 4. Deployment Guide (Production Ready)

### Recommended Production Stack

* **OS**: Ubuntu Server 22.04 LTS
* **Web Server**: Nginx atau Apache
* **PHP Runtime**: PHP 8.2+ (PHP-FPM)
* **Database**: MySQL 8 / MariaDB 10+
* **MQTT Broker**: Mosquitto atau EMQX
* **Python Runtime**: Python 3.10+ (service mode)

### Production Deployment Steps (Summary)

1. Provision Linux server (VPS / On-Premise).
2. Install PHP, Composer, MySQL, Python, dan MQTT Broker.
3. Clone repository ke server.
4. Konfigurasi `.env` Laravel untuk database production.
5. Jalankan migration dan seed database.
6. Konfigurasi Nginx/Apache virtual host.
7. Jalankan Python MQTT collector sebagai **systemd service** atau **Docker container**.
8. Aktifkan security (firewall, SSL/TLS, authentication).

### Performance Best Practices

* Enable Laravel cache (config, route, view).
* Tambahkan index database pada kolom `received_at`.
* Batasi query histori (rolling window data).
* Atur polling interval frontend minimal 2–5 detik.
* Untuk skala besar, gunakan WebSocket (Laravel Echo / Socket.IO) menggantikan polling.

---

## 5. Troubleshooting & Common Issues

### Dashboard Menampilkan `NaN`, `-`, atau `NO DATA`

**Kemungkinan penyebab:**

* PLC tidak mengirim data
* MQTT broker tidak aktif
* Python data collector tidak berjalan
* Database kosong atau koneksi gagal
* Kredensial database salah di `.env`

### Status PLC Selalu OFFLINE

* Pastikan Python script mengupdate field `status` di database.
* Periksa kolom `received_at` terus berubah.
* Sinkronisasi timezone PHP, MySQL, dan server.

### MQTT Tidak Menerima Data

* Cek IP dan port broker (1883 / 8883).
* Pastikan topic name sesuai antara PLC dan Python.
* Pastikan firewall tidak memblokir port MQTT.

---

## Professional Notes

Sistem ini dirancang sebagai **Industrial IoT Monitoring Dashboard** dan dapat digunakan untuk:

* Smart Factory Monitoring
* Industrial Automation Dashboard
* Academic Research / Final Project (Skripsi / Thesis)
* Proof-of-Concept SCADA Web Interface
---

### `landing-page` (Next.js)

- Project statis/SSR di `landing-page/app/` dan `landing-page/components/`.
- Jika ingin memanggil backend, tambahkan variabel environment (contoh: `NEXT_PUBLIC_API_BASE_URL`) dan gunakan `fetch`/`axios` di komponen.
- File konfigurasi utama: `landing-page/next.config.ts` (images dan setelan Next.js lainnya).