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
```sql
CREATE DATABASE banyumas;
```

### 4. Konfigurasi environment
buat file .env dengan
```bash
cp .env.example .env
```
buka file .env dan sesuaikan konfigurasi berikut:
```sql
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
**[Download Postman Collection](https://github.com/riyandrmd/Riyanda_tes_online_PTSMS/blob/main/Project%20Laravel%20PT%20SMS.postman_collection.json)**

