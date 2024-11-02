# UTS
## Manajemen Laptop API
- Nama : Galih Yunus Al Anas
- Nim : 20.01.55.0025
## Deskripsi Project
Project ini adalah sebuah RESTful API menggunakan PHP dan MySQL untuk mengelola data laptop dalam sistem inventaris. API ini mendukung operasi CRUD (Create, Read, Update, Delete) yang memungkinkan pengguna untuk menambahkan, membaca, memperbarui, dan menghapus data laptop. Setiap endpoint memberikan repons yang sesuai, termasuk validasi dan penanganan error.
## Query SQL Pembuatan Tabel
```sql
CREATE DATABASE laptop_management;

USE laptop_management;

CREATE TABLE laptops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);

 ```
## Daftar Endpoint API
#### 1. GET Semua Data
- URL
```
http://localhost/laptop_management_api/api/laptops/read.php
```
- Method: GET
#### 2. GET Detail berdasarkan ID
- URL
```
http://localhost/laptop_management_api/api/laptops/read_single.php?id=1
```
- Method: GET

#### 3. POST Tambah Data Baru
- URL
```
http://localhost/laptop_management_api/api/laptops/create.php
```
- Method: POST
- JSON
  ```JSON
  {
    "brand": "Lenovo",
    "model": "ThinkPad X1 Carbon",
    "price": 18000000,
    "stock": 1
  }
  ```
#### 4. PUT Update Data berdasarkan ID
- URL
```
http://localhost/laptop_management_api/api/laptops/update.php?id=1
```
- Method: PUT
- JSON
  ```JSON
  {
    "brand": "Acer",
    "model": "NX.A7USN.002",
    "price": 6000000,
    "stock": 3
  }
  ```
 #### 5. DELETE Hapus Data Berdasarkan ID
- URL
```
http://localhost/laptop_management_api/api/laptops/delete.php?id=1
```
- Method: DELETE
- Pastikan untuk menambahkan parameter id di URL

## Cara Instalasi dan Penggunaan
### 1. Setup Project di Localhost
- Pastikan sudah menginstal XAMPP/MAMPP : XAMPP (untuk Windows dan Linux) atau MAMPP (untuk MacOS)
- Jika menggunakan XAMPP, salin folder proyek (misalnya laptop_management_api) ke dalam direktori htdocs di folder instalasi XAMPP, biasanya di C:\xampp\htdocs.
- Untuk MAMP, folder ini berada di Applications/MAMP/htdocs pada macOS.
- setelah menyalin, struktur diktori seharusnya seperti ini:
 ```arduino
C:\xampp\htdocs\laptop_management_api
├── api
│   ├── config.php
│   ├── laptop.php
│   ├── laptops
│       ├── create.php
│       ├── read.php
│       ├── read_single.php
│       ├── update.php
│       ├── delete.php
├── README.md

``` 
- Buka file config.php dan pastikan konfigurasi koneksi database sesuai dengan setup database.
   ```php
   <?php
   class Database {
    private $host = "localhost";
    private $db_name = "laptop_management";
    private $username = "root";  
    private $password = "";      
    public $conn;
   
    public function getConnection() {
      $this->conn = null;
       try {
         $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
   }
   ?>
   ```
 ### 2. Jalankan Apache dan MySQL di XAMPP/MAMP
 - Buka XAMPP Control Panel (atau MAMP) dan aktifkan Apache dan MySQL.
 - Pastikan Apache dan MySQL berjalan, dengan indikasi warna hijau pada XAMPP.

 ### 3. Mengakses API dengan Postman
 - Buka Postman dan buat Request baru untuk setiap endpoint
 - Periksa Response JSON untuk setiap Request
 
