# Tes Online PHP Programmer – PT SMS

Proyek ini dibuat menggunakan Laravel 8, MySQL, dan Laravel Sanctum untuk autentikasi berbasis token.

## Menjalankan Project

### 1. Clone repository
```bash
git clone https://github.com/riyandrmd/Riyanda_tes_online_PTSMS.git
cd Riyanda_tes_online_PTSMS
```

### 2. Install dependency
```bash
composer install
```

### 3. Buat Database
```bash
CREATE DATABASE banyumas;
```

### 4. Konfigurasi environment
buka file .env dan sesuaikan konfigurasi berikut:
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banyumas
DB_USERNAME=root
DB_PASSWORD=

```

### 5. Generate key & migrate database
```bash
php artisan key:generate
php artisan migrate
```

### 6. Jalankan server
```bash
php artisan serve
```

### API testing
**[Download Postman Collection](https://raw.githubusercontent.com/riyandrmd/Riyanda_tes_online_PTSMS/refs/heads/main/Project%20Laravel%20PT%20SMS.postman_collection.json)**

