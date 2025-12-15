# Login Page Setup & Testing Guide

## 📋 Overview
Halaman login responsif yang telah disempurnakan dengan:
- ✅ Font **Poppins** (Google Fonts) untuk tampilan modern
- ✅ **Glass Morphism** card design dengan blur & transparansi
- ✅ Icon SVG profesional (envelope untuk email, lock untuk password)
- ✅ Gradient background (warm brown/gold tema)
- ✅ Responsive design (desktop & mobile)
- ✅ Smooth transitions & hover effects
- ✅ Form validation (client & server-side)

## 🚀 Quick Start

### Prerequisites
Pastikan sudah install:
- PHP 8.0+
- Node.js 16+
- Composer

### Step 1: Install Dependencies

Buka PowerShell dan navigasi ke folder proyek:

```powershell
cd C:\xampp\htdocs\AUTRA-Project\apk-inventarisasi
```

Install PHP dependencies:
```powershell
composer install
```

Install Node dependencies:
```powershell
npm install
```

### Step 2: Setup Environment

Copy `.env.example` ke `.env`:
```powershell
copy .env.example .env
```

Generate app key:
```powershell
php artisan key:generate
```

(Opsional: Jika perlu database, setup di `.env` dan jalankan `php artisan migrate`)

### Step 3: Run Development Servers

**Terminal 1 — Vite Dev Server** (untuk CSS/JS assets):
```powershell
cd C:\xampp\htdocs\AUTRA-Project\apk-inventarisasi
npm run dev
```
Output akan menunjukkan:
```
  VITE v6.x.x  ready in 234 ms

  ➜  Local:   http://localhost:5173/
  ➜  press h to show help
```

Biarkan terminal ini tetap berjalan di background.

**Terminal 2 — Laravel Dev Server**:
```powershell
cd C:\xampp\htdocs\AUTRA-Project\apk-inventarisasi
php artisan serve --host=127.0.0.1 --port=8000
```

Output akan menunjukkan:
```
Starting Laravel development server: http://127.0.0.1:8000
```

### Step 4: View Login Page

Buka browser ke:
```
http://127.0.0.1:8000/login
```

Anda akan melihat halaman login dengan:
- Avatar circle berwarna emas di atas
- 2 input field (Email & Password) dengan icon
- Checkbox "Remember me" & link "Forgot Password?"
- Tombol Login dengan gradient coklat
- Background gradient emas ke coklat

## 🎨 Design Features

### Font
- **Poppins** dari Google Fonts (weights: 300, 400, 500, 600, 700)
- Applied ke semua elemen untuk keselarasan tipografi

### Colors
- **Primary**: #ffc857 / #ffb84d (emas/gold)
- **Secondary**: #663d1e / #3d2110 (coklat/brown)
- **Background**: Gradient radial + linear (warm brown to dark)

### Icons
- **Email icon**: Envelope (stroke SVG)
- **Password icon**: Lock (stroke SVG)
- **Avatar icon**: User profile (filled SVG)

### Effects
- **Glass Card**: Blur 10px + saturate 125% + transparency
- **Input Focus**: Glow effect dengan border color emas
- **Button Hover**: Lift effect + shadow enhancement
- **Responsive**: Mobile-first breakpoint di 640px

## 🔧 Customization

### Edit Styling
Jika ingin ubah warna/efek, edit di file view atau buat CSS custom:

File: `resources/views/login/login.blade.php`
- Section `<style>` berisi semua custom CSS
- Class `.glass-card`, `.avatar-circle`, `.btn-login` dapat di-customize

### Edit Form Fields
Untuk menambah/ubah field, edit HTML di dalam `<form>`:
```blade
<!-- Contoh: Tambah field baru -->
<div>
    <div class="input-wrapper">
        <div class="icon-box flex items-center justify-center">
            <!-- Icon SVG -->
        </div>
        <input type="text" name="field_name" class="login-input w-full px-4 py-3 rounded-r-full" />
    </div>
</div>
```

### Edit Validation
Server-side validation di file: `routes/web.php`
```php
$request->validate([
    'email' => 'required|email',
    'password' => 'required|min:4',
    // Tambah rule baru di sini
]);
```

## 📱 Responsive Breakpoints

### Desktop (640px+)
- Card padding: 2.5rem (10)
- Avatar: 80px (20)
- Font sizes: Normal

### Mobile (<640px)
- Card padding: 1.5rem (6)
- Avatar: 64px (auto-adjust)
- Font sizes: Sedikit lebih kecil
- Spacing: Lebih compact

## ⚙️ Routes

| Method | Route   | Handler | Purpose |
|--------|---------|---------|---------|
| GET    | /login  | View    | Tampilkan form login |
| POST   | /login  | Handle  | Proses form submission |

### Current POST Handler (Stub)
File: `routes/web.php`
```php
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:4',
    ]);
    
    return back()->with('status', 'Login attempt received for ' . $request->input('email'));
});
```

**Note**: Ini hanya stub. Untuk autentikasi nyata, ganti dengan:
```php
Auth::attempt(['email' => $request->email, 'password' => $request->password])
```

## 🧪 Testing Form

1. Buka http://127.0.0.1:8000/login
2. Masukkan:
   - Email: test@example.com
   - Password: password123
3. Klik tombol **Login**
4. Harusnya kembali ke halaman login dengan pesan status di atas form

## 🛑 Troubleshooting

### CSS/JS tidak dimuat
- Pastikan `npm run dev` masih berjalan di Terminal 1
- Clear browser cache (Ctrl+Shift+Delete)
- Cek browser console untuk error

### Port 8000 sudah terpakai
```powershell
php artisan serve --host=127.0.0.1 --port=8001
```

### Vite dev server tidak jalan
```powershell
npm run build  # Build static assets instead
```

Kemudian jalankan Laravel serve saja (CSS sudah di-bundle ke public/).

### Font Google tidak terload
- Cek koneksi internet (Google Fonts perlu CDN)
- Fallback ke system fonts sudah ada di CSS

## 📝 Next Steps (Opsional)

1. **Autentikasi Nyata**: Ganti POST handler dengan Logic auth menggunakan Model User
2. **Styling Lanjutan**: Tambah animasi, dark mode, atau theme switcher
3. **Validasi Frontend**: Tambah client-side validation dengan JavaScript
4. **Testing**: Buat Feature Test untuk login flow

## 📞 Support

Jika ada pertanyaan atau perlu adjustment, silakan hubungi tim development!

---

**Version**: 1.0  
**Last Updated**: December 1, 2025  
**Status**: ✅ Siap Produksi (Stub Auth)
