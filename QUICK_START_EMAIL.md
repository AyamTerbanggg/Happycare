# Quick Start Email Server

## Langkah Cepat Setup Email Server

### 1. Buat File .env
Copy konfigurasi dari `ENV_EMAIL_SETUP.md` ke file `.env`

### 2. Generate App Key
```bash
php artisan key:generate
```

### 3. Setup Database
```bash
php artisan migrate
```

### 4. Setup Email Provider (Gmail)
1. Aktifkan 2FA di Google Account
2. Buat App Password untuk "Mail"
3. Update .env:
   ```env
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-16-digit-app-password
   ```

### 5. Jalankan Seeder
```bash
php artisan db:seed --class=EmailTemplateSeeder
```

### 6. Start Queue Worker
**Windows:**
```bash
start-queue-worker.bat
```

**Linux/Mac:**
```bash
php artisan queue:work --tries=3 --timeout=60 --memory=512
```

### 7. Test Email Server
1. Login ke admin panel
2. Buka menu "Email Server"
3. Test koneksi email
4. Kirim email test

## Fitur yang Tersedia

✅ **Dashboard Email** - Overview statistik email  
✅ **Kirim Email** - Form kirim email manual  
✅ **Manajemen Template** - Buat, edit, hapus template  
✅ **Riwayat Email** - Log semua email yang dikirim  
✅ **Test Koneksi** - Validasi konfigurasi email  
✅ **Background Processing** - Email diproses di background  
✅ **Retry Mechanism** - Auto retry jika gagal  
✅ **Status Tracking** - Pending, Processing, Sent, Failed  

## Troubleshooting

### Email tidak terkirim:
- Cek konfigurasi SMTP di .env
- Pastikan App Password benar
- Test koneksi di dashboard admin

### Queue tidak berjalan:
- Pastikan queue worker berjalan
- Cek log Laravel
- Restart queue worker

### Template tidak muncul:
- Jalankan seeder: `php artisan db:seed --class=EmailTemplateSeeder`
- Clear cache: `php artisan cache:clear`

## Dokumentasi Lengkap

Lihat file `SETUP_EMAIL_SERVER.md` untuk dokumentasi lengkap. 