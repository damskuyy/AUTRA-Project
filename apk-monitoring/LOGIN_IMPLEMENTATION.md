# Login Implementation Guide - AUTRA Monitoring

## Ringkasan Perubahan

Sistem login telah diperbarui dengan validasi database, middleware authentication, dan handling untuk status akun yang tidak aktif.

## File yang Dimodifikasi

### 1. **LoginController.php**
- Implementasi `store()` method untuk handle login request
- Validasi username/password terhadap database
- Pengecekan status akun (active/inactive)
- Update `last_login` timestamp saat login berhasil
- Support untuk AJAX dan form submission
- Response JSON untuk API requests dan redirects untuk web requests

### 2. **routes/web.php**
- Menambahkan route `GET /login` - menampilkan login page
- Menambahkan route `POST /api/login` - API endpoint untuk login
- Menambahkan route `POST /logout` - untuk logout
- Membungkus protected routes dengan `middleware('auth')`

### 3. **bootstrap/app.php**
- Menambahkan middleware alias untuk `auth` middleware

### 4. **resources/js/app.js**
- Fungsi `handleLogin()` untuk submit form login via AJAX
- Validasi input client-side
- Error handling dengan pesan yang sesuai
- Auto redirect ke dashboard setelah login berhasil
- Fungsi `showAlert()` untuk menampilkan pesan status

### 5. **resources/views/auth/login.blade.php**
- Penambahan Bootstrap CSS untuk styling alert
- Inline CSS untuk login page styling
- Form dengan id `loginForm` untuk di-trigger oleh JavaScript
- Support untuk menampilkan alert messages (success/danger)

## Fitur-Fitur

### ✅ Validasi Login
- Username dapat berupa `email` atau `name`
- Password di-hash dan di-verify menggunakan Laravel's Hash
- Jika user tidak ditemukan → error message "Username atau password tidak sesuai"
- Jika password salah → error message "Username atau password tidak sesuai"

### ✅ Status Akun
- Akun dengan status `inactive` tidak dapat login
- Pesan khusus: "Akun Anda telah dinonaktifkan. Hubungi administrator."

### ✅ Redirect & Session
- Login berhasil → redirect ke `/dashboard`
- Session dimaintain menggunakan Laravel session
- `last_login` timestamp di-update di table users

### ✅ Error Handling
- Validasi input di client-side
- Validasi input di server-side
- CSRF token protection
- Try-catch untuk exception handling

## Database Requirements

Table `users` harus memiliki columns:
- `id` (PRIMARY KEY)
- `name` (string) - untuk username alternatif
- `email` (string, unique)
- `password` (string) - hashed password
- `status` (enum: 'active', 'inactive')
- `role` (enum: 'admin', 'guru', 'siswa')
- `last_login` (timestamp, nullable) - untuk tracking last login time

## Cara Testing

### 1. **Buat Test User**
```sql
INSERT INTO users (name, email, role, status, password, created_at, updated_at) 
VALUES ('testuser', 'test@example.com', 'guru', 'active', 
        '$2y$12$XXXX...', NOW(), NOW());
```

Gunakan Laravel Tinker untuk hash password:
```bash
php artisan tinker
Hash::make('password123')
```

### 2. **Test Case 1: Login Berhasil**
- URL: http://localhost/apk-monitoring/login
- Username: testuser (atau test@example.com)
- Password: password123
- Expected: Redirect ke dashboard, alert "Login berhasil" ditampilkan

### 3. **Test Case 2: Username Salah**
- Username: wronguser
- Password: password123
- Expected: Alert "Username atau password tidak sesuai"

### 4. **Test Case 3: Password Salah**
- Username: testuser
- Password: wrongpassword
- Expected: Alert "Username atau password tidak sesuai"

### 5. **Test Case 4: Akun Inactive**
```sql
UPDATE users SET status = 'inactive' WHERE name = 'testuser';
```
- Username: testuser
- Password: password123
- Expected: Alert "Akun Anda telah dinonaktifkan. Hubungi administrator."

### 6. **Test Case 5: Empty Input**
- Username: (kosong)
- Password: password123
- Expected: Alert "Username dan password harus diisi"

## Logout Implementation

Route POST `/logout` sudah tersedia:
```blade
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
```

## Security Features

- ✅ CSRF Token Protection
- ✅ Password Hashing dengan Laravel Hash
- ✅ Middleware Authentication untuk protected routes
- ✅ Session-based authentication
- ✅ Last login timestamp tracking

## Struktur Request/Response

### Login Request
```javascript
POST /api/login
Content-Type: application/json
X-CSRF-TOKEN: {csrf_token}

{
    "username": "testuser",
    "password": "password123"
}
```

### Login Response (Success)
```json
{
    "success": true,
    "message": "Login berhasil",
    "redirect": "/dashboard"
}
```

### Login Response (Error)
```json
{
    "success": false,
    "message": "Username atau password tidak sesuai"
}
```

## Troubleshooting

### Issue: "Token mismatch" error
**Solusi:** Pastikan CSRF token sudah di-submit dengan form

### Issue: Password tidak cocok padahal benar
**Solusi:** Gunakan `Hash::make('password')` untuk generate password hash, bukan plaintext

### Issue: Redirect tidak berfungsi
**Solusi:** Pastikan JavaScript axios sudah loaded, cek console untuk error

### Issue: Logout tidak berfungsi
**Solusi:** Gunakan form POST method untuk logout route

## Next Steps

1. ✅ Setup test users di database
2. ✅ Test semua scenario login
3. ✅ Update navbar/sidebar dengan logout button
4. ✅ Setup rate limiting untuk login attempts (optional)
5. ✅ Setup email verification (optional)
