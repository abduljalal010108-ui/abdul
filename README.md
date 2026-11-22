# RasaKita - Full Laravel Food Store

Project toko makanan Laravel lengkap.

## Fitur
- `artisan` dan struktur Laravel lengkap
- Login admin
- Dashboard admin
- CRUD produk
- Upload gambar produk
- CRUD kategori
- Keranjang belanja
- Registrasi dan login pelanggan
- Pemesanan makanan dengan checkout khusus pelanggan
- Riwayat pesanan pelanggan
- Checkout dan validasi stok
- Status pembayaran dan pesanan
- Pembayaran simulasi: Transfer, QRIS, COD
- Database SQLite default

## Akun admin demo
Email: `admin@rasakita.test`
Password: `password`

## Cara menjalankan di Windows
Pastikan PHP 8.2+, Composer, dan extension SQLite aktif.

1. Extract ZIP.
2. Buka folder project di CMD/PowerShell.
3. Jalankan:
   ```
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   php artisan serve
   ```
4. Buka `http://localhost:8000`
5. Admin: `http://localhost:8000/admin/login`

Jika perintah `copy` tidak cocok di terminal yang digunakan, salin `.env.example` menjadi `.env` secara manual.

## Catatan
Pembayaran pada project ini hanya simulasi. Tidak terhubung ke payment gateway nyata.
