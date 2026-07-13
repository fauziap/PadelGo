
# 🎾 PadelGo

**PadelGo** adalah aplikasi booking lapangan padel berbasis web yang dikembangkan menggunakan **Laravel 11**. Aplikasi ini memudahkan pengguna untuk melakukan reservasi lapangan secara online, memilih jadwal bermain, melakukan pembayaran, serta memperoleh e-ticket sebagai bukti pemesanan.

---

## 📌 Tentang PadelGo

PadelGo hadir untuk memberikan pengalaman reservasi lapangan padel yang cepat, praktis, dan efisien. Dengan antarmuka yang sederhana dan mudah digunakan, pengguna dapat melakukan pemesanan kapan saja tanpa harus datang langsung ke lokasi.

---

## ✨ Fitur Utama

### 👤 Pengguna
- Registrasi & Login
- Melihat daftar lapangan
- Memilih tanggal dan jam bermain
- Booking lapangan
- Pembayaran booking
- Melihat riwayat booking
- Mendapatkan E-Ticket setelah pembayaran berhasil

### 👨‍💼 Admin
- Dashboard Admin
- Kelola data lapangan
- Kelola jadwal
- Kelola data booking
- Verifikasi pembayaran
- Melihat laporan transaksi

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 11 | Backend Framework |
| PHP 8.2+ | Programming Language |
| MySQL | Database |
| Blade | Template Engine |
| Bootstrap | User Interface |
| Vite | Asset Bundler |
| JavaScript | Interaktivitas |

---

## 📂 Struktur Folder

```text
PadelGo/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
└── vendor/
```

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/fauziap/PadelGo.git
```

### 2. Masuk ke Folder Project

```bash
cd PadelGo
```

### 3. Install Dependency

```bash
composer install
```

```bash
npm install
```

### 4. Salin File Environment

Linux / Mac

```bash
cp .env.example .env
```

Windows

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Ubah file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=padelgo
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika menggunakan Seeder

```bash
php artisan migrate --seed
```

### 8. Jalankan Server

```bash
php artisan serve
```

### 9. Jalankan Vite

```bash
npm run dev
```

---

## 📸 Tampilan Aplikasi

> Tambahkan screenshot aplikasi di folder **docs/** agar README terlihat lebih menarik.

### 🏠 Home

![Home](docs/home.png)

---

### 🎾 Booking Lapangan

![Booking](docs/booking.png)

---

### 💳 Pembayaran

![Payment](docs/payment.png)

---

### 🎫 E-Ticket

![ETicket](docs/e-ticket.png)

---

### 👨‍💼 Dashboard Admin

![Dashboard](docs/dashboard.png)

---

## 📋 Roadmap

- [x] Login & Register
- [x] Booking Lapangan
- [x] Pembayaran
- [x] E-Ticket
- [x] Dashboard Admin
- [ ] QR Code E-Ticket
- [ ] Email Notification
- [ ] Payment Gateway Midtrans
- [ ] Export Laporan PDF
- [ ] Responsive Mobile

---

## 🤝 Kontribusi

Kontribusi sangat terbuka.

1. Fork repository
2. Buat branch baru

```bash
git checkout -b feature/nama-fitur
```

3. Commit perubahan

```bash
git commit -m "Menambahkan fitur baru"
```

4. Push ke repository

```bash
git push origin feature/nama-fitur
```

5. Buat Pull Request

---

## 👨‍💻 Developer

**Kelompok 2**

- 🎓 Information Systems Student
- 💻 Laravel Developer
- 🌐 GitHub: https://github.com/fauziap

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran, pengembangan, dan portofolio.
