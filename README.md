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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
git
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# 🏛️ E-Litbang - BRIDA Kota Surakarta

**E-Litbang** adalah aplikasi pelayanan perizinan terpadu berbasis web yang dikembangkan untuk Badan Riset dan Inovasi Daerah (BRIDA) Kota Surakarta. Aplikasi ini dirancang untuk mempermudah masyarakat, mahasiswa, dan instansi dalam mengurus berbagai perizinan penelitian, KKN, hingga pengabdian masyarakat secara digital dan terintegrasi dengan Perangkat Daerah (OPD) terkait.

---

## 🌟 Fitur Utama

- **Portal Perizinan Terpadu:** Pengajuan izin secara mandiri untuk berbagai jenis layanan (Penelitian, KKN, Permohonan Data, Survey, Wawancara, dan Pengabdian Masyarakat).
- **Tracking & Multi-Stage Workflow:** Alur pemrosesan perizinan yang terstruktur dan transparan sebanyak 12-16 tahapan.
- **Multi-Role User System:** Hak akses khusus untuk *Pemohon/Peneliti*, *Admin BRIDA*, *Admin Kesbangpol*, serta *OPD Terkait*.
- **Integrasi Dokumen & TTE:** Manajemen unggah persyaratan, verifikasi proposal, hingga penerbitan dokumen terverifikasi Tanda Tangan Elektronik (TTE).
- **Interaktif & Dynamic UI:** Menggunakan komponen Livewire untuk pemrosesan data secara *real-time* tanpa *reload* halaman.

---

## 🛠️ Teknologi yang Digunakan

- **Framework Backend:** [Laravel](https://laravel.com/)
- **Frontend Reactive:** [Livewire](https://livewire.laravel.com/)
- **Database:** MySQL (via Laragon / HeidiSQL)
- **Styling UI:** Tailwind CSS / Bootstrap & FontAwesome Icons
- **Web Server:** Nginx / Apache (Laragon Local Environment)

---

## 📋 Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan sistem Anda sudah terpasang:
- PHP >= 8.4
- Laravel >= 13
- Composer >= 2.0
- MySQL / MariaDB (Disarankan menggunakan **Laragon**)
- Node.js & NPM (Opsional, jika mengompilasi aset frontend)

---

## 🚀 Cara Instalasi & Menjalankan Proyek Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal menggunakan Laragon:

### 1. Clone Repositori
```bash
git clone [https://github.com/username/elitbang.git](https://github.com/tekat0604/elitbang.git)
cd elitbang
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment (.env)
Duplikat file .env.example menjadi .env:
```bash
cp .env.example .env
```
Buka file .env dan atur konfigurasi database sesuai dengan pengaturan MySQL Laragon Anda:
Misalkan,
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=elitbang
- DB_USERNAME=root
- DB_PASSWORD=

### 4. Generate Application Key
```bash
php artisan key:generate
```
### 5. Jalankan Migrasi Database & Seeder
Buat database bernama elitbang di HeidiSQL/phpMyAdmin, lalu jalankan migrasi:
```bash
php artisan migrate
```
Jika ada file seeder untuk data awal layanan atau akun default:
```bash
php artisan db seed
```

### 6. Link Storage (Untuk Manajemen Upload File)
```bash
php artisan storage:link
```

### 7. Jalankan Server
Jika menggunakan Laragon, Anda cukup mengakses URL lokal seperti:
```http://elitbang.test:8080``` atau ```http://localhost/elitbang/public``` .
Atau Anda juga bisa menjalankannya via CLI bawaaan Laravel:
```bash
php artisan serve
```
Akses aplikasi di browser melalui ```http://127.0.0.1:8000```.

## Kredensial Penguji (Data Dummy Login)
Jika menggunakan data seed default, gunakan akun dibawah ini untuk pengujian:
| Role / Hak Akses | Email / Username | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Pemohon (User 1)** | `budi@example.com` | `password123` | Akun pemohon / mahasiswa |
| **Kepala Brida (TTE)** | `kepala.brida@surakarta.go.id` | `password123` | TTE |
| **Kepala Kesbangpol (TTE)** | `kepala.kesbangpol@surakarta.go.id` | `password123` | TTE |
| **Verifikator BRIDA** | `brida@surakarta.go.id` | `password123` | Verifikator utama, Penerbit Surat |
| **Verifikator Kesbangpol** | `kesbangpol@surakarta.go.id` | `password123` | Verifikator berkas diawal |
| **Admin OPD** | `namaopd@surakarta.go.id` | `password123` | Penerima dokumen & data |

## 📄 Lisensi & Hak Cipta
Proyek ini dikembangkan untuk instansi Badan Riset dan Inovasi Daerah (BRIDA) Kota Surakarta © 2026.
