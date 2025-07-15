# Sistem Email Server - Dokumentasi Lengkap

## 🚀 Fitur Utama

Sistem email server telah berhasil diintegrasikan ke dalam proyek Laravel Anda dengan fitur-fitur berikut:

### 📊 Dashboard Email
- **Statistik Email**: Total email terkirim, email hari ini, jumlah template
- **Email Terbaru**: Daftar 10 email terakhir
- **Test Koneksi**: Uji koneksi email server secara real-time
- **Akses**: `/admin/email`

### 📧 Kirim Email
- **Form Pengiriman**: Interface yang user-friendly untuk mengirim email
- **Pilihan Template**: Pilih dari template yang sudah dibuat
- **Preview Template**: Lihat preview template sebelum mengirim
- **Validasi**: Validasi input yang ketat
- **Akses**: `/admin/email/create`

### 📝 Template Email
- **Manajemen Template**: Buat, edit, hapus template
- **Variabel Dinamis**: Gunakan variabel seperti `{{name}}`, `{{email}}`
- **Preview Real-time**: Lihat preview saat mengetik
- **Status Aktif/Nonaktif**: Kontrol template yang dapat digunakan
- **Akses**: `/admin/email/templates`

### 📋 Riwayat Email
- **Log Lengkap**: Catatan semua email yang dikirim
- **Status Tracking**: Terkirim, gagal, menunggu
- **Detail Email**: Lihat detail lengkap setiap email
- **Pagination**: Navigasi yang mudah
- **Akses**: `/admin/email/logs`

## 🗄️ Database Structure

### Tabel `email_templates`
```sql
- id (Primary Key)
- name (VARCHAR) - Nama template
- subject (VARCHAR) - Subjek email
- content (TEXT) - Konten template
- variables (JSON) - Variabel yang tersedia
- is_active (BOOLEAN) - Status aktif
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### Tabel `email_logs`
```sql
- id (Primary Key)
- to (VARCHAR) - Email penerima
- subject (VARCHAR) - Subjek email
- message (TEXT) - Pesan email
- template_id (FOREIGN KEY) - ID template (opsional)
- status (ENUM) - sent, failed, pending
- sent_at (TIMESTAMP) - Waktu terkirim
- error_message (TEXT) - Pesan error (jika gagal)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

## 🔧 Konfigurasi Email

### 1. File .env
Tambahkan konfigurasi berikut ke file `.env`:

```env
# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Provider Email yang Didukung

#### Gmail
```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

#### Outlook/Hotmail
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=your-email@outlook.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

#### Yahoo
```env
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yahoo.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

## 📁 File Structure

```
app/
├── Http/Controllers/
│   └── EmailController.php          # Controller utama email
├── Models/
│   ├── EmailTemplate.php            # Model template email
│   └── EmailLog.php                 # Model log email
├── Mail/
│   └── CustomEmail.php              # Mail class untuk email kustom

resources/views/
├── admin/email/
│   ├── index.blade.php              # Dashboard email
│   ├── create.blade.php             # Form kirim email
│   ├── templates.blade.php          # Daftar template
│   ├── create-template.blade.php    # Form buat template
│   ├── edit-template.blade.php      # Form edit template
│   ├── logs.blade.php               # Riwayat email
│   └── show.blade.php               # Detail email
└── emails/
    ├── basic.blade.php              # Template email dasar
    └── template.blade.php           # Template email kustom

database/
├── migrations/
│   ├── create_email_templates_table.php
│   └── create_email_logs_table.php
└── seeders/
    └── EmailTemplateSeeder.php      # Seeder template default
```

## 🎯 Template Default

Sistem menyediakan 3 template default:

### 1. Welcome Email
- **Subjek**: "Selamat Datang di {{company_name}}"
- **Variabel**: name, company_name, username, email
- **Gunakan untuk**: Email selamat datang user baru

### 2. Password Reset
- **Subjek**: "Reset Password - {{company_name}}"
- **Variabel**: name, company_name, reset_link
- **Gunakan untuk**: Email reset password

### 3. Notification Email
- **Subjek**: "Notifikasi: {{title}}"
- **Variabel**: name, title, message, date, time, company_name
- **Gunakan untuk**: Email notifikasi umum

## 🔌 API Endpoints

### Email Management
```php
GET    /admin/email                    # Dashboard email
GET    /admin/email/create            # Form kirim email
POST   /admin/email/send              # Kirim email
GET    /admin/email/logs              # Riwayat email
GET    /admin/email/logs/{id}         # Detail email
```

### Template Management
```php
GET    /admin/email/templates                    # Daftar template
GET    /admin/email/templates/create            # Form buat template
POST   /admin/email/templates                   # Simpan template
GET    /admin/email/templates/{id}/edit         # Form edit template
PUT    /admin/email/templates/{id}              # Update template
DELETE /admin/email/templates/{id}              # Hapus template
GET    /admin/email/templates/{id}/preview      # Preview template
```

### System
```php
POST   /admin/email/test-connection            # Test koneksi email
```

## 🎨 Variabel Template

Gunakan variabel berikut dalam template:

| Variabel | Deskripsi | Contoh |
|----------|-----------|---------|
| `{{name}}` | Nama penerima | John Doe |
| `{{email}}` | Email penerima | john@example.com |
| `{{company_name}}` | Nama perusahaan | HappyCare |
| `{{username}}` | Username | johndoe123 |
| `{{reset_link}}` | Link reset password | https://... |
| `{{title}}` | Judul notifikasi | Pembayaran Berhasil |
| `{{message}}` | Pesan | Terima kasih telah... |
| `{{date}}` | Tanggal | 08/07/2025 |
| `{{time}}` | Waktu | 14:30 |

## 🔒 Keamanan

### Best Practices
1. **Jangan commit .env**: File .env tidak boleh masuk repository
2. **App Password**: Gunakan App Password untuk Gmail
3. **2FA**: Aktifkan 2FA untuk akun email
4. **Access Control**: Batasi akses ke admin email
5. **Monitoring**: Monitor log email secara berkala

### Validasi
- Email address validation
- XSS protection pada content
- CSRF protection pada semua form
- Input sanitization

## 🐛 Troubleshooting

### Error: "Authentication failed"
**Solusi:**
- Periksa username dan password
- Untuk Gmail, gunakan App Password
- Aktifkan 2FA jika menggunakan Gmail

### Error: "Connection refused"
**Solusi:**
- Periksa host dan port SMTP
- Pastikan firewall tidak memblokir
- Coba port alternatif (465 untuk SSL)

### Error: "SSL certificate"
**Solusi:**
- Ubah `MAIL_ENCRYPTION` ke `tls`
- Atau gunakan port 465 dengan `ssl`

### Template tidak muncul
**Solusi:**
- Periksa status template (aktif/nonaktif)
- Jalankan seeder: `php artisan db:seed --class=EmailTemplateSeeder`
- Periksa database connection

## 📈 Monitoring & Analytics

### Statistik yang Tersedia
- Total email terkirim
- Email hari ini
- Jumlah template
- Success rate
- Error rate

### Log Monitoring
- Email yang berhasil dikirim
- Email yang gagal dengan error message
- Waktu pengiriman
- Template yang digunakan

## 🚀 Deployment

### 1. Database Migration
```bash
php artisan migrate
```

### 2. Seeder
```bash
php artisan db:seed --class=EmailTemplateSeeder
```

### 3. Konfigurasi Email
- Update file `.env` dengan kredensial email
- Test koneksi melalui dashboard

### 4. Permission
- Pastikan folder `storage/logs` writable
- Set permission untuk cache dan config

## 📞 Support

Jika mengalami masalah:

1. **Periksa Log**: `storage/logs/laravel.log`
2. **Test Koneksi**: Gunakan fitur test di dashboard
3. **Periksa Konfigurasi**: Pastikan .env sudah benar
4. **Database**: Pastikan migration dan seeder sudah dijalankan

## 🎉 Selamat!

Sistem email server Anda siap digunakan! 

**Langkah selanjutnya:**
1. Konfigurasi email provider di `.env`
2. Test koneksi melalui dashboard
3. Buat template sesuai kebutuhan
4. Mulai kirim email!

---

**Dibuat dengan ❤️ untuk proyek Laravel Anda** 