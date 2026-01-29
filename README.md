

Di bawah ini adalah **README.md versi FINAL**
❗ Tanpa emoji
❗ Tanpa heading bernomor
❗ Tanpa gaya presentasi
❗ Hanya markdown standar & rapi

---

⬇️ **SALIN SEMUA ISI DI BAWAH INI KE `README.md`** ⬇️

---

````md
# Aplikasi Pengaduan Sarpras

Aplikasi Pengaduan Sarana dan Prasarana berbasis web menggunakan Laravel 12 dan PHP 8.2.  
Project ini dibuat untuk memenuhi Tugas Uji Kompetensi Keahlian (Ujikom) RPL.

====================================================================

DESKRIPSI APLIKASI

Aplikasi ini digunakan untuk menampung pengaduan sarana dan prasarana dari pengguna.
Pengguna dapat mengajukan pengaduan, sedangkan admin dapat mengelola dan menanggapi
pengaduan tersebut.

Fitur User
- Registrasi dan Login
- Mengajukan pengaduan
- Melihat status pengaduan

Fitur Admin
- Login sebagai admin
- Melihat seluruh pengaduan
- Mengubah status pengaduan
- Memberikan tanggapan pengaduan

Fitur Sistem
- Role user dan admin
- Middleware admin
- Kategori pengaduan
- Upload gambar pengaduan

====================================================================

PERSYARATAN SISTEM

- PHP minimal versi 8.2
- Composer
- Node.js dan NPM
- MySQL (XAMPP)
- Git (opsional)

Perintah pengecekan versi:
```bash
php -v
composer -V
node -v
npm -v
````

====================================================================

INSTALASI PROJECT

Masuk ke folder htdocs:

```bash
cd C:\xampp\htdocs
```

Buat project Laravel:

```bash
composer create-project laravel/laravel laravel12
cd laravel12
```

Generate application key:

```bash
php artisan key:generate
```

====================================================================

KONFIGURASI DATABASE

Buat database melalui phpMyAdmin dengan nama:

```
laravel12
```

Atur konfigurasi database pada file .env:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12
DB_USERNAME=root
DB_PASSWORD=
```

====================================================================

MIGRATION DATABASE

Menambahkan kolom role pada tabel users:

```bash
php artisan make:migration add_role_to_users_table --table=users
```

```php
Schema::table('users', function (Blueprint $table) {
    $table->enum('role', ['user', 'admin'])->default('user');
});
```

Membuat tabel categories:

```bash
php artisan make:migration create_categories_table
```

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->timestamps();
});
```

Membuat tabel complaints:

```bash
php artisan make:migration create_complaints_table
```

```php
Schema::create('complaints', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('description');
    $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
    $table->text('response')->nullable();
    $table->string('image')->nullable();
    $table->timestamps();
});
```

Menjalankan migration:

```bash
php artisan migrate
```

====================================================================

MODEL DAN RELASI

User.php

```php
protected $fillable = [
    'name',
    'email',
    'password',
    'role'
];

public function complaints()
{
    return $this->hasMany(Complaint::class);
}
```

Category.php

```php
protected $fillable = ['name', 'description'];

public function complaints()
{
    return $this->hasMany(Complaint::class);
}
```

Complaint.php

```php
protected $fillable = [
    'user_id',
    'category_id',
    'title',
    'description',
    'status',
    'response',
    'image'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
```

====================================================================

SEEDER KATEGORI

Membuat seeder:

```bash
php artisan make:seeder CategorySeeder
```

```php
Category::create([
    'name' => 'Kerusakan Bangunan',
    'description' => 'Pengaduan terkait kerusakan bangunan'
]);

Category::create([
    'name' => 'Peralatan Rusak',
    'description' => 'Pengaduan terkait peralatan rusak'
]);
```

Menjalankan seeder:

```bash
php artisan db:seed --class=CategorySeeder
```

====================================================================

AUTENTIKASI (LARAVEL BREEZE)

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan migrate
```

Gunakan stack Blade with Alpine.

====================================================================

MIDDLEWARE ADMIN

Membuat middleware:

```bash
php artisan make:middleware AdminMiddleware
```

```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403);
    }
    return $next($request);
}
```

Registrasi middleware pada Laravel 12 di file bootstrap/app.php:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

====================================================================

ROUTING ADMIN

```php
Route::middleware(['auth','admin'])->get('/admin-test', function () {
    return 'ADMIN OK';
});
```

====================================================================

MENJALANKAN APLIKASI

```bash
php artisan serve
```

Akses melalui browser:

```
http://127.0.0.1:8000
```

====================================================================

MENJADIKAN USER SEBAGAI ADMIN

Melalui database:

```sql
UPDATE users SET role = 'admin' WHERE email = 'email@gmail.com';
```

====================================================================

STRUKTUR PROJECT

app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
database/
├── migrations/
└── seeders/
resources/
└── views/
routes/
└── web.php

====================================================================

AUTHOR

Nama      : Refan Al-Kholqi
Jurusan   : Rekayasa Perangkat Lunak
Framework : Laravel 12
PHP       : 8.2

```

---

Kalau kamu mau:
- versi **lebih singkat khusus penguji**
- versi **lebih formal untuk laporan**
- atau **ditambahkan ERD ASCII**

tinggal bilang, tapi **README ini sudah 100% siap upload ke GitHub** ✅
```
