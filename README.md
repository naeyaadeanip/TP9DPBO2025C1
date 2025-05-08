# TP9DPBO2025C1

Saya Naeya Adeani Putri dengan NIM 2304017 mengerjakan Tugas Praktikum Latihan 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
![image](https://github.com/user-attachments/assets/026b5b8e-72b8-4ebc-a56c-26c6f438a856)

### 1. Model (`/model`)
Model bertanggung jawab untuk menangani semua interaksi dengan **database** dan merepresentasikan **entitas Mahasiswa**. Komponen model yang terlibat antara lain:
- `DB.class.php`: Menyediakan fungsi koneksi dan eksekusi query database.
- `Mahasiswa.class.php`: Merepresentasikan struktur data mahasiswa (NIM, nama, alamat).
- `TabelMahasiswa.class.php`: Menyediakan fungsi spesifik untuk CRUD data mahasiswa.
- `Template.class.php`: Template engine sederhana untuk menggantikan placeholder pada file HTML.

### 2. View (`/view`)
View hanya bertugas untuk **menampilkan data** kepada pengguna. View tidak berisi logika bisnis atau query database, hanya menerima data dari presenter.
- `KontrakView.php`: Membuat tampilan daftar mahasiswa dari data yang dikirim presenter.
- `TampilMahasiswa.php`: Menyusun HTML final berdasarkan template `skin.html`.

### 3. Presenter (`/presenter`)
Presenter menjadi **penghubung antara model dan view**. Presenter menerima aksi dari pengguna, memproses logika, mengakses data dari model, lalu meneruskan ke view untuk ditampilkan.
- `KontrakPresenter.php`: Mengambil data dari `TabelMahasiswa` dan mengirimkannya ke `KontrakView`.
- `ProsesMahasiswa.php`: Menerima input dari form, menyimpannya melalui model, lalu mengarahkan pengguna ke tampilan utama.

### 4. Templates (`/templates`)
Berisi HTML template statis dengan placeholder, yang akan digantikan oleh engine di `Template.class.php`.
- `form.html`: Form input untuk data mahasiswa.
- `skin.html`: Template layout dasar halaman.

# Alur Program

### 1. Pengguna mengakses `index.php`
- File `index.php` memuat presenter `KontrakPresenter.php`.
- Presenter menginisialisasi model `TabelMahasiswa` dan mengambil semua data mahasiswa dari database.
- Data dikirim ke view `KontrakView.php`.
- View menggunakan template `skin.html` untuk menampilkan daftar mahasiswa di browser.

### 2. Create (Tambah Data)
- Pengguna menekan tombol tambah, lalu diarahkan ke `form.html`.
- Form diisi dan dikirim melalui metode `POST` ke `ProsesMahasiswa.php`.
- `ProsesMahasiswa.php`:
  - Menerima data.
  - Memanggil method `addData()` dari model `TabelMahasiswa` untuk menyimpan ke database.
  - Redirect kembali ke `index.php`.

### 3. Read (Lihat Data)
- Secara default saat membuka `index.php`, presenter menampilkan semua data dari model ke view.
- Tampilan berupa tabel data mahasiswa.

### 4. Update (Edit Data)
- Pengguna klik tombol "Edit" pada salah satu baris mahasiswa.
- Form ditampilkan dengan data yang sudah terisi.
- Setelah diedit dan disubmit:
  - `ProsesMahasiswa.php` menerima input.
  - Model `TabelMahasiswa` melakukan update data berdasarkan ID mahasiswa.
  - Redirect kembali ke halaman utama.

### 5. Delete (Hapus Data)
- Pengguna klik tombol "Hapus" pada salah satu mahasiswa.
- Request dikirim ke `ProsesMahasiswa.php` dengan parameter `id` dan aksi `hapus`.
- Presenter memanggil `deleteData()` di model.
- Data dihapus dari database, lalu pengguna diarahkan kembali ke `index.php`.

# Dokumentasi
https://github.com/user-attachments/assets/90ffc236-8c6c-47fd-a99f-bfd8d0a0cb04
