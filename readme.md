Semua kode di atas sudah memenuhi prinsip SOLID. Setiap prinsip diterapkan dengan baik:

- SRP: Setiap class memiliki satu tanggung jawab.
    - Setiap class seperti MySQLDatabase, PostgresDatabase, dan SQLiteDatabase hanya bertanggung jawab untuk mengatur koneksi dan menjalankan query ke database yang spesifik.
    - Class Main.php bertanggung jawab untuk memilih database dan menjalankan logika aplikasi utama. Ini memisahkan logika aplikasi dari logika koneksi ke database.

- OCP: Kode terbuka untuk ekstensi (penambahan driver baru) tanpa perlu memodifikasi yang sudah ada.
    - Jika kamu ingin menambahkan dukungan untuk database baru (misalnya SQLite), kamu tidak perlu memodifikasi class lain yang ada, cukup buat class baru yang mengimplementasikan DatabaseInterface.
    - Class Main.php menggunakan switch untuk memilih database, yang masih bisa dianggap memenuhi prinsip OCP karena hanya ditambahkan driver baru tanpa perlu mengubah implementasi inti.
- LSP: Setiap implementasi dapat saling menggantikan tanpa memengaruhi aplikasi.
    - Semua class (MySQLDatabase, PostgresDatabase, SQLiteDatabase) mengimplementasikan interface DatabaseInterface, sehingga bisa digunakan dengan cara yang sama di Main.php tanpa mengubah kode utama.
    - Setiap implementasi mengikuti kontrak yang sama (metode connect dan query), sehingga dapat digunakan secara bergantian tanpa menyebabkan error.

- ISP: Interface kecil dan spesifik pada tugas yang dibutuhkan.
    - DatabaseInterface hanya mendefinisikan dua metode yang sangat spesifik untuk koneksi dan query, yaitu connect dan query. Interface ini cukup kecil dan spesifik untuk kebutuhan pengelolaan database.
    - Tidak ada metode tambahan yang dipaksakan pada implementasi yang tidak memerlukannya.

- DIP: Class utama bergantung pada abstraksi, bukan pada implementasi konkrit.
    - Class Main.php tidak bergantung langsung pada class MySQLDatabase, PostgresDatabase, atau SQLiteDatabase. Sebaliknya, ia bergantung pada interface DatabaseInterface.
    - Implementasi database yang spesifik bisa diubah tanpa memodifikasi logika utama aplikasi, karena aplikasi utama hanya bergantung pada abstraksi.

Dengan demikian, library ini sudah diimplementasikan sesuai dengan prinsip-prinsip SOLID.


# SOLID Database Library

Proyek ini adalah contoh implementasi library database dengan menggunakan prinsip **SOLID**. Library ini mendukung berbagai database, seperti MySQL, PostgreSQL, dan SQLite. Pada panduan ini, kita akan menggunakan **SQLite** sebagai contoh.

## Prasyarat

Sebelum memulai, pastikan kamu sudah memiliki:
- **PHP** 7.4 atau lebih tinggi terinstal.
- **Composer** terinstal. Jika belum, kamu bisa mengikuti panduan [di sini](https://getcomposer.org/download/).

## Instalasi

1. Clone repositori ini atau unduh dan ekstrak di direktori proyekmu.
2. Masuk ke direktori proyek di terminal:

    ```bash
    cd /path/to/your/project
    ```

3. Jalankan perintah berikut untuk menginstal package yang diperlukan menggunakan Composer:

    ```bash
    composer install
    ```

## Setup Database SQLite

1. Buat database SQLite dengan nama `database.db`

    ```bash
    buat file database.db
    ```

2. Buat tabel bernama `users` dengan 5 kolom. Kamu bisa menggunakan skrip SQL berikut untuk membuat tabel:

    ```sql
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        age INTEGER NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    ```

3. Jalankan SQL ini di SQLite. Kamu bisa menggunakan command-line SQLite untuk menjalankannya:

    ```bash
    sqlite3 database.db
    ```

    Di dalam SQLite CLI, jalankan perintah SQL untuk membuat tabel:

    ```sql
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        age INTEGER NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    ```

4. Masukkan beberapa data ke dalam tabel `users` untuk keperluan testing. Kamu bisa menggunakan SQL ini:

    ```sql
    INSERT INTO users (name, email, age) VALUES 
    ('John Doe', 'john@example.com', 30),
    ('Jane Smith', 'jane@example.com', 25),
    ('Bob Brown', 'bob@example.com', 35),
    ('Alice Green', 'alice@example.com', 28),
    ('Charlie Black', 'charlie@example.com', 40);
    ```

5. Verifikasi data yang sudah ditambahkan dengan menjalankan perintah berikut di SQLite CLI:

    ```sql
    SELECT * FROM users;
    ```

## Konfigurasi `.env`

1. Buat file `.env` di root direktori proyek, dan isi dengan konfigurasi berikut untuk menggunakan SQLite:

    ```env
    DB_TYPE=sqlite
    DB_CONNECTION_STRING=sqlite:database.db
    ```

    Pastikan jalur ke file `database.db` benar sesuai dengan lokasi file tersebut.

## Menjalankan Proyek

1. Pastikan semua dependency sudah terinstal dan database sudah siap. Untuk menjalankan aplikasi, jalankan perintah berikut di terminal:

    ```bash
    php src/Main.php
    ```

2. Jika berhasil, aplikasi akan menampilkan data dari tabel `users` yang sudah kamu buat dan isi.

## Troubleshooting

- Jika mendapatkan error "No such file or directory" untuk SQLite, pastikan jalur file `database.db` benar di `.env` dan file tersebut memang sudah ada di lokasi yang diharapkan.
- Pastikan Composer autoloading berfungsi dengan benar. Jika ada perubahan di file `composer.json`, jalankan `composer dump-autoload` untuk memperbarui autoloading.

