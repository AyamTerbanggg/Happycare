<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# HappyCare Chatbot

Chatbot untuk website HappyCare yang membantu pengunjung mencari informasi tentang rumah sakit dan destinasi wisata di Jawa Tengah.

## Fitur Utama

1. **Pencarian Rumah Sakit**
   - Mencari rumah sakit berdasarkan lokasi
   - Mencari rumah sakit berdasarkan spesialisasi
   - Menampilkan informasi detail rumah sakit (fasilitas, kontak, dll)

2. **Pencarian Destinasi Wisata**
   - Mencari destinasi wisata berdasarkan lokasi
   - Mencari destinasi wisata berdasarkan jenis (alam, budaya, sejarah, dll)
   - Menampilkan informasi detail destinasi (jam buka, tiket, fasilitas)

3. **Multibahasa**
   - Mendukung Bahasa Indonesia dan Inggris
   - Switch bahasa yang mudah melalui tombol di interface

4. **Interface Interaktif**
   - Tombol navigasi cepat
   - Tampilan kartu untuk informasi
   - Respons yang cepat dan akurat

## Teknologi yang Digunakan

- Backend: Laravel 10
- Frontend: Vue.js 3
- Database: MySQL
- API: RESTful API

## Instalasi

1. Clone repository
```bash
git clone [repository-url]
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=happycare
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan migrasi dan seeder
```bash
php artisan migrate --seed
```

6. Compile assets
```bash
npm run dev
```

7. Jalankan server
```bash
php artisan serve
```

## Struktur Database

### Tabel Hospitals
- id (primary key)
- name
- address
- city
- phone
- email
- description
- specialties (JSON)
- facilities (JSON)
- image_url
- latitude
- longitude
- is_active
- timestamps

### Tabel TouristDestinations
- id (primary key)
- name
- type
- address
- city
- description
- facilities (JSON)
- opening_hours
- entrance_fee
- image_url
- latitude
- longitude
- is_active
- timestamps

## API Endpoints

### Chatbot
- GET /api/chatbot/greeting - Mendapatkan pesan sambutan
- POST /api/chatbot/message - Memproses pesan dari pengguna

## Penggunaan

1. Tambahkan komponen Chatbot ke layout utama:
```vue
<template>
  <div id="app">
    <!-- Konten website -->
    <Chatbot />
  </div>
</template>

<script>
import Chatbot from './components/Chatbot.vue'

export default {
  components: {
    Chatbot
  }
}
</script>
```

2. Pastikan axios sudah dikonfigurasi dengan benar di `resources/js/app.js`:
```javascript
import axios from 'axios'
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
```

## KPI (Key Performance Indicators)

1. **Response Time**
   - Target: < 2 detik untuk setiap respons
   - Monitoring: Log response time di setiap request

2. **User Satisfaction**
   - Target: > 80% user memberikan rating positif
   - Monitoring: Survey kepuasan pengguna

3. **Peningkatan Konversi Wisata:**
   - Latar Belakang: Tingkat konversi dari melihat detail wisata hingga bertanya atau merencanakan perjalanan masih rendah.
   - Tujuan: Meningkatkan interaksi pengguna dengan halaman detail wisata sebesar 20%.
   - Hipotesis: Dengan menyediakan informasi yang lebih kaya (galeri, review, fasilitas) dan call-to-action yang jelas, pengguna akan lebih tertarik.
   - Metrik: Jumlah klik pada tombol "Hubungi Agen", jumlah user yang menyimpan wisata ke wishlist.
   - Monitoring: Analitik event tracking pada halaman detail.

#### 2. Objektif Bisnis

- **Meningkatkan Engagement Pengguna:**
  - Latar Belakang: Pengguna cenderung pasif dan hanya melihat-lihat.
  - Tujuan: Meningkatkan waktu rata-rata sesi pengguna sebesar 15%.
  - Hipotesis: Chatbot yang proaktif dan informatif akan membuat pengguna lebih lama berinteraksi dengan platform.
  - Monitoring: Google Analytics (Session Duration, Pages/Session).

- **Otomatisasi Layanan Informasi:**
  - Latar Belakang: Pertanyaan umum yang berulang membebani tim support.
  - Tujuan: Mengurangi jumlah pertanyaan dasar yang masuk melalui email/telepon sebesar 40%.
  - Hipotesis: Chatbot dapat menjawab >70% pertanyaan umum seputar lokasi, jam buka, dan fasilitas.
  - Monitoring: Analisis log chat dan jumlah tiket support yang masuk.

### IV. Arsitektur & Teknologi

1. **Frontend:**
   - Blade: Untuk templating sisi server.

## Pengembangan Selanjutnya

1. Penambahan fitur chat dengan agen manusia
2. Implementasi machine learning untuk meningkatkan akurasi respons
3. Penambahan fitur voice input/output
4. Integrasi dengan platform messaging (WhatsApp, LINE, dll)

## Kontribusi

Silakan buat pull request untuk kontribusi. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan perubahan yang diinginkan.

## Lisensi

[MIT](https://choosealicense.com/licenses/mit/)
