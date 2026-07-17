# Product Requirements Document (PRD)
## Sistem Informasi Layanan Balai Pelestarian Kebudayaan DI Yogyakarta

| | |
|--|--|
| **Nama Sistem** | Sistem Informasi Layanan Balai Pelestarian Kebudayaan DI Yogyakarta |
| **Tanggal** | 16 Juli 2026 |
| **Penyusun** | [Nama] — [Jabatan] |
| **Instansi** | Balai Pelestarian Kebudayaan Daerah Istimewa Yogyakarta |

---

## Ringkasan Sistem

Balai Pelestarian Kebudayaan DI Yogyakarta membutuhkan sistem digital terpadu untuk mengelola data **lokasi cagar budaya** (candi, situs budaya, tempat bersejarah, pendopo, dsb) serta melayani **penggunaan fasilitas cagar budaya** oleh masyarakat. Sistem ini memudahkan pengunjung menemukan dan menelusuri informasi lokasi cagar budaya secara online, membantu admin mengelola data situs dan permohonan penggunaan fasilitas, serta memberikan pimpinan laporan real-time terkait kunjungan dan pemanfaatan fasilitas. Target: mempermudah akses informasi cagar budaya dari **pencarian manual/datang langsung** menjadi **akses digital terintegrasi dengan peta interaktif**.

---

## 1. Pengguna Sistem

| Peran | Siapa | Yang Mereka Lakukan |
|-------|-------|---------------------|
| **Administrator** | Staf TI Balai Pelestarian Kebudayaan | Kelola seluruh data, hak akses pengguna, dan konfigurasi sistem |
| **Pengelola Situs** | Staf teknis / juru pelihara cagar budaya | Input & perbarui data lokasi cagar budaya, upload foto, kelola status situs, konfirmasi permohonan penggunaan fasilitas |
| **Pimpinan** | Kepala Balai Pelestarian Kebudayaan | Lihat dashboard dan laporan — hanya baca |
| **Pengunjung (Publik)** | Masyarakat umum, wisatawan, peneliti | Lihat daftar & peta lokasi cagar budaya, cari informasi situs, ajukan permohonan penggunaan fasilitas |

---

## 2. Layanan yang Dikelola Sistem

> *Setiap layanan menjelaskan alurnya dan data yang perlu dicatat.*
> *Aturan bisnis penting dituliskan sebagai validasi di sistem.*

---

### Layanan 1 — Informasi Lokasi Cagar Budaya

**Deskripsi:** Penyediaan informasi lengkap mengenai lokasi cagar budaya yang berada di bawah pengelolaan Balai Pelestarian Kebudayaan DI Yogyakarta, meliputi candi, situs budaya, tempat bersejarah, pendopo, dan bangunan cagar budaya lainnya. Pengunjung dapat menelusuri dan mencari lokasi melalui peta interaktif maupun daftar katalog.

**Alur:**
1. Admin/Pengelola Situs menginput data lokasi cagar budaya (nama, kategori, deskripsi, koordinat, foto)
2. Data lokasi tampil di peta interaktif dan daftar katalog untuk pengunjung
3. Pengunjung membuka halaman publik, melihat peta dan daftar situs
4. Pengunjung dapat memfilter berdasarkan kategori (candi, situs budaya, tempat bersejarah, pendopo, dll)
5. Pengunjung mengklik lokasi untuk melihat detail lengkap (deskripsi, foto galeri, alamat, jam operasional, tiket masuk)

**Data yang dicatat:** nama situs · kategori (candi / situs budaya / tempat bersejarah / pendopo / lainnya) · deskripsi · alamat lengkap · koordinat GPS (latitude, longitude) · foto galeri · jam operasional · harga tiket masuk (jika ada) · status (aktif / dalam renovasi / tutup sementara) · nomor registrasi cagar budaya · tahun penetapan

**Aturan bisnis:**
- Setiap lokasi **wajib memiliki koordinat GPS** agar dapat ditampilkan di peta
- Kategori situs terbatas pada daftar yang telah ditentukan — tidak bisa diisi bebas
- Foto minimal **1 gambar** wajib diunggah untuk setiap lokasi
- Status situs harus selalu diperbarui jika ada perubahan (renovasi, tutup sementara)

---

### Layanan 2 — Permohonan Penggunaan Fasilitas Cagar Budaya

**Deskripsi:** Pelayanan permohonan penggunaan fasilitas cagar budaya untuk berbagai keperluan seperti kegiatan budaya, upacara adat, penelitian, pemotretan/syuting, dan kegiatan edukasi. Masyarakat atau instansi dapat mengajukan permohonan secara online.

**Alur:**
1. Pemohon (pengunjung terdaftar) memilih lokasi/fasilitas cagar budaya yang ingin digunakan
2. Pemohon mengecek ketersediaan fasilitas di kalender
3. Pemohon mengisi formulir permohonan (identitas, jenis kegiatan, tanggal, durasi, jumlah peserta, surat permohonan)
4. Pengelola Situs memverifikasi dan meninjau permohonan
5. Pengelola Situs menyetujui/menolak permohonan dengan catatan (syarat & ketentuan penggunaan)
6. Jika disetujui, pemohon menerima surat izin penggunaan fasilitas
7. Pemohon melaksanakan kegiatan sesuai jadwal yang disetujui
8. Pengelola Situs membuat laporan pasca-penggunaan

**Data yang dicatat:** nama pemohon · identitas (KTP/ID instansi) · nama instansi (jika ada) · lokasi/fasilitas yang dimohon · jenis kegiatan · tanggal mulai & selesai · durasi penggunaan · jumlah peserta · surat permohonan (upload) · status permohonan (diajukan / diverifikasi / disetujui / ditolak / selesai) · catatan persetujuan · nomor surat izin · biaya retribusi (jika ada)

**Aturan bisnis:**
- Satu fasilitas **tidak bisa digunakan dua pemohon** pada tanggal dan waktu yang sama
- Permohonan harus diajukan minimal **H-7** sebelum tanggal kegiatan
- Surat permohonan resmi **wajib diunggah** sebagai syarat pengajuan
- Kegiatan yang berpotensi merusak cagar budaya **otomatis ditolak**
- Pembatalan kurang dari **3 hari** sebelum tanggal kegiatan dikenakan sanksi administratif
- Fasilitas dengan status **"dalam renovasi"** atau **"tutup sementara"** tidak dapat diajukan

---

### Layanan 3 — Registrasi & Pelaporan Kondisi Cagar Budaya

**Deskripsi:** Pengelolaan data registrasi cagar budaya dan pencatatan kondisi situs secara berkala. Termasuk pencatatan temuan baru, pelaporan kerusakan, dan dokumentasi kegiatan pelestarian.

**Alur:**
1. Pengelola Situs melakukan survei dan dokumentasi kondisi situs
2. Pengelola Situs menginput laporan kondisi berkala (foto, deskripsi kondisi, rekomendasi)
3. Jika ditemukan kerusakan, Pengelola Situs membuat laporan kerusakan
4. Pimpinan meninjau laporan dan menetapkan prioritas tindakan pelestarian

**Data yang dicatat:** nama situs · tanggal survei · kondisi (baik / rusak ringan / rusak sedang / rusak berat) · foto dokumentasi · deskripsi temuan · rekomendasi tindakan · petugas survei · riwayat pemeliharaan

**Aturan bisnis:**
- Setiap situs **wajib disurvei** minimal **1 kali per semester**
- Laporan kerusakan berat harus **segera direspon** dalam 1×24 jam oleh pimpinan
- Riwayat kondisi situs **tidak dapat dihapus**, hanya ditambahkan (bersifat log)

---

## 3. Laporan & Dashboard yang Dibutuhkan

### Dashboard Utama (tampil saat login)

| Informasi | Keterangan |
|-----------|------------|
| Total lokasi cagar budaya | Jumlah seluruh situs yang terdaftar per kategori |
| Permohonan penggunaan bulan ini | Jumlah permohonan masuk, disetujui, dan ditolak bulan berjalan |
| Situs dalam perhatian | Daftar situs dengan status "dalam renovasi" atau "rusak berat" |
| Fasilitas aktif hari ini | Lokasi/fasilitas yang sedang digunakan hari ini |
| Statistik kunjungan halaman publik | Jumlah akses halaman informasi lokasi 7 hari terakhir |

### Laporan Berkala

| Laporan | Frekuensi | Isi | Format |
|---------|-----------|-----|--------|
| Rekap Penggunaan Fasilitas | Bulanan | Total permohonan per lokasi, status, dan jenis kegiatan | Excel & PDF |
| Kondisi Cagar Budaya | Semester | Ringkasan survei kondisi seluruh situs | PDF |
| Statistik Kunjungan Publik | Triwulanan | Jumlah akses informasi per lokasi dan kategori | PDF |
| Laporan Retribusi | Bulanan | Total penerimaan retribusi penggunaan fasilitas | Excel & PDF |

---

> **Catatan untuk AI Coding Assistant:**
> - Setiap **layanan** di Bagian 2 → 1 modul Filament Resource + set tabel database
> - Setiap **alur** → urutan status pada kolom `status` di tabel transaksi
> - Setiap **data yang dicatat** → kolom-kolom pada tabel yang bersangkutan
> - Setiap **aturan bisnis** → validasi dan business logic di Model/Controller
> - Bagian 3 → widget dashboard Filament + fitur ekspor PDF/Excel
> - **Peta interaktif** → gunakan Leaflet.js / OpenStreetMap untuk menampilkan lokasi cagar budaya
> - **Halaman publik** → landing page terpisah (non-Filament) untuk pengunjung umum

---
