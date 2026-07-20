# Roles And Permissions Kebudayaan

## 3. Matriks Pemetaan Role vs Permission

| Modul/Tugas | Super Admin (Staf TI) | Pengelola Situs (Juru Pelihara) | Pimpinan (Kepala Balai) | Pemohon (Masyarakat) |
| :--- | :---: | :---: | :---: | :---: |
| **Manajemen Akun** | ✅ CRUD Penuh | ❌ | ❌ | ❌ |
| **Data Lokasi & Kategori** | ✅ CRUD Penuh | 🟨 Input & Edit Data/Foto | 👁️ Hanya Lihat | 👁️ Hanya Lihat di Peta Publik |
| **Permohonan Fasilitas** | ✅ CRUD Penuh | 🟨 Verifikasi & Setujui/Tolak | 👁️ Hanya Lihat (Rekap) | 🙋 Ajukan & Pantau Milik Sendiri |
| **Laporan Kondisi Fisik** | ✅ CRUD Penuh | 🟨 Input Survei Berkala | 🟨 Review & Tindak Lanjut | ❌ |
| **Dashboard & Ekspor** | ✅ Semua | ✅ Statistik Teknis | ✅ Semua (Strategis) | ❌ |

## 4. Analisa & Rekomendasi Tambahan Sistem

1. **Role Pengelola Situs per Kategori/Lokasi:** Jika balai memiliki banyak juru pelihara, pertimbangkan fitur *scoped access* di mana seorang `pengelola_situs` hanya bisa mengedit/melaporkan kondisi untuk lokasi yang ditugaskan kepadanya, bukan seluruh data secara global.
2. **Sistem Notifikasi:** Rekomendasi untuk menambahkan modul notifikasi real-time (email/in-app) agar Pimpinan segera mendapat peringatan otomatis ketika ada input laporan kondisi "Rusak Berat".
3. **Pendaftaran Otomatis (Self-Registration):** Pastikan role "Pemohon (Masyarakat)" diberikan secara otomatis ketika publik mendaftar (*register*) akun baru di portal, sehingga mengurangi beban kerja admin.
