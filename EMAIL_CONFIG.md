# Konfigurasi Email Server

## Setup Email Server

Sistem email server telah berhasil diintegrasikan ke dalam proyek Laravel Anda. Berikut adalah langkah-langkah untuk mengkonfigurasi email server:

### 1. Konfigurasi .env

Tambahkan konfigurasi berikut ke file `.env` Anda:

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

### 3. Fitur Email Server

#### Dashboard Email
- Statistik email terkirim
- Email terbaru
- Test koneksi email
- Akses: `/admin/email`

#### Kirim Email
- Form pengiriman email
- Pilihan template
- Preview template
- Akses: `/admin/email/create`

#### Template Email
- Manajemen template
- Preview template
- Variabel dinamis
- Akses: `/admin/email/templates`

#### Riwayat Email
- Log pengiriman email
- Status email (terkirim/gagal)
- Detail email
- Akses: `/admin/email/logs`

### 4. Template Default

Sistem sudah menyediakan 3 template default:
1. **Welcome Email** - Email selamat datang
2. **Password Reset** - Email reset password
3. **Notification Email** - Email notifikasi

### 5. Variabel Template

Gunakan variabel berikut dalam template:
- `{{name}}` - Nama penerima
- `{{email}}` - Email penerima
- `{{company_name}}` - Nama perusahaan
- `{{username}}` - Username
- `{{reset_link}}` - Link reset password
- `{{title}}` - Judul notifikasi
- `{{message}}` - Pesan
- `{{date}}` - Tanggal
- `{{time}}` - Waktu

### 6. Test Koneksi

Untuk menguji koneksi email:
1. Buka dashboard email: `/admin/email`
2. Klik tombol "Test Koneksi"
3. Pastikan konfigurasi email sudah benar

### 7. Troubleshooting

#### Error: "Authentication failed"
- Pastikan username dan password benar
- Untuk Gmail, gunakan App Password
- Aktifkan 2FA jika menggunakan Gmail

#### Error: "Connection refused"
- Periksa host dan port SMTP
- Pastikan firewall tidak memblokir
- Coba port alternatif (465 untuk SSL)

#### Error: "SSL certificate"
- Ubah `MAIL_ENCRYPTION` ke `tls`
- Atau gunakan port 465 dengan `ssl`

### 8. Keamanan

- Jangan commit file `.env` ke repository
- Gunakan App Password untuk Gmail
- Batasi akses ke admin email
- Monitor log email secara berkala

### 9. API Endpoints

```php
// Test koneksi email
POST /admin/email/test-connection

// Preview template
GET /admin/email/templates/{id}/preview

// Kirim email
POST /admin/email/send
```

### 10. Model dan Database

#### EmailTemplate
- `name` - Nama template
- `subject` - Subjek email
- `content` - Konten template
- `variables` - Variabel yang tersedia
- `is_active` - Status aktif

#### EmailLog
- `to` - Email penerima
- `subject` - Subjek email
- `message` - Pesan email
- `template_id` - ID template (opsional)
- `status` - Status pengiriman
- `sent_at` - Waktu terkirim
- `error_message` - Pesan error (jika gagal)

Sistem email server siap digunakan! Pastikan untuk mengkonfigurasi email provider Anda terlebih dahulu. 