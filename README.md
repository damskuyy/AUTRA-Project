# AUTRA Project

 **Ringkasan**

Repositori ini berisi beberapa aplikasi yang saling berkaitan:

* `apk-inventarisasi` — aplikasi Laravel untuk manajemen inventaris.
* `apk-monitoring` — aplikasi Laravel untuk monitoring sensor & PLC (termasuk skrip Python di `plc/`).
* `landing-page` — situs frontend Next.js + Tailwind untuk landing page.
* SQL dump: `autra_project.sql` dan skrip backup `backup_autra.bat`.

Port Yang Digunakan :
apk-inventarisasi = 8000
apk-monitoring = 8001
landing-page = 3000

---

## Tech stack

* Backend: **PHP** + **Laravel** (modern, Laravel 9/10 kompatibel)
* Frontend: **Tailwind CSS**, **Vite**, **Next.js** (untuk `landing-page`)
* DB: **MySQL / MariaDB**
* Package managers: **Composer**, **npm / yarn / pnpm**
* Scripting (PLC): **Python 3.8+**
* Dev tools: Git, PHPUnit / Laravel Test Suite

---

## Requirements

Sebelum instalasi, pastikan terpasang:

* Windows (direkomendasikan XAMPP) atau Linux/macOS
* PHP 8.1+ dengan ekstensi umum (PDO, OpenSSL, Mbstring, Ctype, JSON, Tokenizer, XML, BCMath)
* Composer
* Node.js (v16+ direkomendasikan) dan npm/yarn/pnpm
* MySQL / MariaDB
* Python 3.8+ (hanya untuk skrip PLC di `apk-monitoring/plc`)
* MQTT Broker (Mosquitto / EMQX / PLC MQTT Gateway)
* Git

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
   php artisan storage:link   # jika perlu
   php artisan serve --port=8000  # contoh port (ubah sesuai kebutuhan)
   ```

   Ulangi untuk `apk-monitoring` (ganti direktori dan port jika diperlukan).

4. Landing page (`landing-page`):

   ```bash
   cd landing-page
   npm install
   npm run dev
   # akses http://localhost:3000
   ```

---

## Catatan & tips

* Pastikan setiap `.env` sudah diisi dengan kredensial DB dan konfigurasi yang benar (MAIL, QUEUE, dsb.).
* Gunakan `autra_project.sql` jika ingin memulai dengan data yang sudah ada.
* Untuk environment produksi, jangan gunakan `php artisan serve`; gunakan webserver (Apache/Nginx) dan supervisor untuk queue.
* Backup: `backup_autra.bat` tersedia untuk backup DB (periksa dan sesuaikan sebelum dipakai).

---

## Struktur API & Lokasi File (detail per aplikasi)

Berikut lokasi berkas yang berhubungan dengan API dan titik masuk (routes, controller, model, script) untuk tiap sub-aplikasi.

### `apk-inventarisasi` (Laravel)

* **Routes (API):** `apk-inventarisasi/routes/api.php`
  - Contoh endpoint: `GET /api/sarpras/by-kode-barang/{kode}` → `App\Http\Controllers\Api\ScanSarprasController@byKodeBarang`
* **Routes (Web/UI):** `apk-inventarisasi/routes/web.php` (resource routes seperti `inventaris`, `peminjaman`, dsb.)
* **Controller (API):** `apk-inventarisasi/app/Http/Controllers/Api/ScanSarprasController.php`
* **Controller (Web):** `apk-inventarisasi/app/Http/Controllers/` (mis.`InventoriesController`, `PeminjamanController`, `ScanController`)
* **Models:** `apk-inventarisasi/app/Models/` (mis. `Inventory.php`, `Siswa.php`)
* **Import/Export:** `apk-inventarisasi/app/Imports/` dan `apk-inventarisasi/app/Exports/` (`SiswaImport`, `RiwayatExport`)
* **Config eksternal API:** `apk-inventarisasi/config/services.php` — kunci `sarpras.base_url` (env `SARPRAS_API_BASE_URL`)
* **Migrations & Seeders:** `apk-inventarisasi/database/migrations/` dan `.../seeders/`

Contoh memanggil API lokal (dianggap aplikasi berjalan di `http://localhost:8001`):

```bash
curl "http://localhost:8001/api/sarpras/by-kode-barang/KODE123"
```

---

### `apk-monitoring` (Laravel + PLC)

## AUTRA Monitoring System

### Tech Stack

**Backend (Web):**

* Laravel 11 (PHP 8.2+)
* MySQL / MariaDB
* REST API (JSON)

**Data Ingestion (PLC Bridge):**

* Python 3.10+
* paho-mqtt (MQTT Client)
* MySQL Connector (mysql-connector-python)

**Frontend:**

* Blade Template (Laravel)
* Chart.js (Realtime Chart)
* JavaScript (Fetch API)
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
git clone [Link Repo]
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
pip install paho-mqtt
```

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

## 3. System Architecture

PLC / Sensor Device → MQTT Broker → Python Data Collector → MySQL Database → Laravel Backend → Web Dashboard

### Component Responsibilities

* **PLC / Sensor Device**: Mengirim data sensor (temperature, humidity, light intensity) dalam format JSON melalui MQTT.
* **MQTT Broker**: Message broker (Mosquitto / EMQX) yang menangani publish–subscribe data PLC.
* **Python Data Collector (Bridge Layer)**: Service yang subscribe ke MQTT, parsing payload, validasi data, dan insert ke database.
* **MySQL Database**: Menyimpan data sensor historis dan status konektivitas PLC.
* **Laravel Backend**: Menyediakan API, business logic, dan data aggregation untuk dashboard.
* **Web Dashboard (Frontend)**: Visualisasi realtime data menggunakan Chart.js dan Blade template.

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

### `landing-page` (Next.js)

* Project statis/SSR di `landing-page/app/` dan `landing-page/components/`.
* Jika ingin memanggil backend, tambahkan variabel environment (contoh: `NEXT_PUBLIC_API_BASE_URL`) dan gunakan `fetch`/`axios` di komponen.
* File konfigurasi utama: `landing-page/next.config.ts` (images dan setelan Next.js lainnya).