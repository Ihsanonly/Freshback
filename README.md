# FRESHBACK

FRESHBACK sekarang memakai Laravel dan MySQL.

## Menjalankan di Laragon

1. Buka Laragon.
2. Klik Start All agar Apache/MySQL aktif.
3. Buka terminal Laragon/Cmder.
4. Masuk ke folder project:

```bash
cd C:\laragon\www\Freshback
```

5. Jalankan Laravel:

```bash
php artisan serve
```

6. Buka browser:

```text
http://127.0.0.1:8000
```

## Tes Database

Buka:

```text
http://127.0.0.1:8000/test-db
```

Jika berhasil, halaman akan menampilkan database `freshback` dan total data pada tabel `foods`.

## Database

File SQL lama tetap disimpan di:

```text
database/freshback.sql
```

Laravel migration untuk tabel `foods` ada di:

```text
database/migrations/2026_09_04_000000_create_foods_table.php
```

Jalankan migration dengan:

```bash
php artisan migrate
```

Laravel akan memakai konfigurasi database dari file `.env`.

## Model Food

Model Laravel untuk tabel makanan ada di:

```text
app/Models/Food.php
```

Model ini memakai tabel `foods`, sehingga pengecekan koneksi bisa dilakukan dengan:

```bash
php artisan tinker --execute="echo App\Models\Food::count();"
```

Jika hasilnya `0`, artinya Laravel berhasil membaca tabel `foods` dan tabelnya masih kosong.
## Halaman Foods

Route daftar makanan:

```text
http://127.0.0.1:8000/foods
```

Alurnya:

```text
Browser -> /foods -> routes/web.php -> FoodController -> Food Model -> Database
```

Controller ada di:

```text
app/Http/Controllers/FoodController.php
```

View ada di:

```text
resources/views/foods/index.blade.php
```

## Tambah Makanan

Route form tambah makanan:

```text
http://127.0.0.1:8000/foods/create
```

Alurnya:

```text
Browser -> /foods/create -> FoodController@create -> create.blade.php
Form Submit -> POST /foods -> FoodController@store -> Food Model -> Database
```
