# Setup Email Server Laravel - Panduan Lengkap

## 1. Setup File .env

Buat file `.env` di root direktori proyek dengan konfigurasi berikut:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration (untuk email background)
QUEUE_CONNECTION=database

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## 2. Generate App Key

```bash
php artisan key:generate
```

## 3. Setup Database

```bash
php artisan migrate
```

## 4. Setup Email Provider

### Gmail Setup:
1. Aktifkan 2FA di akun Google
2. Buat App Password:
   - Buka Google Account Settings
   - Security > 2-Step Verification
   - App passwords
   - Generate password untuk "Mail"
3. Update .env dengan App Password

### Outlook/Hotmail:
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=your-email@outmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

### Yahoo:
```env
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yahoo.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

## 5. Jalankan Seeder

```bash
php artisan db:seed --class=EmailTemplateSeeder
```

## 6. Start Queue Worker

### Windows:
```bash
start-queue-worker.bat
```

### Linux/Mac:
```bash
php artisan queue:work --tries=3 --timeout=60 --memory=512
```

### Atau gunakan command custom:
```bash
php artisan queue:start-worker
```

## 7. Test Email Server

1. Login ke admin panel
2. Buka menu "Email Server"
3. Test koneksi email
4. Kirim email test

## 8. Fitur Email Server

### Dashboard Email
- Overview statistik email
- Quick actions untuk kirim email

### Kirim Email
- Form kirim email manual
- Pilih template email
- Preview email sebelum kirim

### Manajemen Template
- Buat, edit, hapus template
- Preview template
- Variabel template support

### Riwayat Email
- Log semua email yang dikirim
- Status: Pending, Processing, Sent, Failed
- Detail error jika gagal

### Test Koneksi
- Test koneksi SMTP
- Validasi konfigurasi email

## 9. Background Processing

Email akan diproses di background menggunakan queue:

1. **Pending**: Email baru dijadwalkan
2. **Processing**: Email sedang diproses
3. **Sent**: Email berhasil dikirim
4. **Failed**: Email gagal dikirim

### Retry Mechanism:
- Maksimal 3x retry
- Timeout 60 detik
- Backoff: 30s, 60s, 120s

## 10. Monitoring Queue

### Cek status queue:
```bash
php artisan queue:work --once
```

### Clear failed jobs:
```bash
php artisan queue:flush
```

### Restart queue:
```bash
php artisan queue:restart
```

## 11. Troubleshooting

### Email tidak terkirim:
1. Cek konfigurasi SMTP
2. Pastikan App Password benar
3. Cek firewall/antivirus
4. Test koneksi di dashboard

### Queue tidak berjalan:
1. Pastikan queue worker berjalan
2. Cek log Laravel
3. Restart queue worker

### Template tidak muncul:
1. Jalankan seeder
2. Cek database email_templates
3. Clear cache: `php artisan cache:clear`

## 12. Security

- Gunakan App Password, bukan password biasa
- Aktifkan 2FA di email provider
- Jangan commit file .env ke git
- Gunakan environment variables di production

## 13. Production Setup

### Supervisor (Linux):
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/project/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=8
redirect_stderr=true
stdout_logfile=/path/to/project/storage/logs/worker.log
```

### Windows Service:
Gunakan NSSM untuk membuat Windows service.

## 14. Performance Tips

1. Gunakan Redis untuk queue di production
2. Monitor memory usage
3. Set appropriate timeout values
4. Use database indexing for email logs
5. Implement email rate limiting

## 15. API Endpoints (Opsional)

Jika ingin menggunakan API:

```php
// routes/api.php
Route::prefix('email')->group(function () {
    Route::post('/send', [EmailController::class, 'sendApi']);
    Route::get('/templates', [EmailController::class, 'templatesApi']);
    Route::get('/logs', [EmailController::class, 'logsApi']);
});
```

## 16. Backup & Maintenance

### Backup email logs:
```bash
php artisan tinker
>>> App\Models\EmailLog::all()->toJson();
```

### Clean old logs:
```bash
php artisan tinker
>>> App\Models\EmailLog::where('created_at', '<', now()->subMonths(6))->delete();
```

---

**Catatan**: Pastikan untuk mengganti `your-email@gmail.com` dan `your-app-password` dengan kredensial email yang sebenarnya. 