# Konteks Database Migrations

## Sistem Informasi Layanan — Balai Pelestarian Kebudayaan DI Yogyakarta

> **Catatan untuk AI Coding Assistant:**
> - Framework: **Laravel 12** (SQLite)
> - Tabel `users`, `password_reset_tokens`, `sessions`, `cache`, `jobs` sudah ada (bawaan Laravel)
> - Semua nama tabel dan kolom menggunakan **bahasa Inggris**, mengikuti konvensi Laravel (`snake_case`, plural)
> - Semua migration menggunakan format anonymous class (`return new class extends Migration`)
> - Gunakan `foreignId()->constrained()->cascadeOnDelete()` untuk foreign key
> - Gunakan `softDeletes()` pada tabel utama

---

## ERD (Entity Relationship)

```
users (existing)
  │
  ├──< heritage_sites          (1 user creates many sites)
  │       │
  │       ├──< site_photos     (1 site has many photos)
  │       │
  │       ├──< facility_usage_requests  (1 site has many requests)
  │       │
  │       └──< site_condition_reports   (1 site has many reports)
  │
  └──< facility_usage_requests (1 user submits many requests)
```

---

## Migration 1 — Tabel Kategori Situs

**File:** `create_site_categories_table`
**Model:** `SiteCategory`

Tabel lookup untuk kategori situs cagar budaya. Kategori bersifat terbatas (tidak bisa diisi bebas oleh pengguna).

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `name` | `string` | required, unique | Nama kategori (contoh: Temple, Cultural Site, Historical Place, Pavilion, Other) |
| `slug` | `string` | required, unique | Slug URL-friendly |
| `description` | `text` | nullable | Deskripsi kategori |
| `icon` | `string` | nullable | Nama ikon untuk peta/UI |
| `timestamps` | `timestamps()` | | created_at, updated_at |

**Seed data yang harus disiapkan:**

| `name` | `slug` | Keterangan (ID) |
|--------|--------|-----------------|
| Temple | temple | Candi |
| Cultural Site | cultural-site | Situs Budaya |
| Historical Place | historical-place | Tempat Bersejarah |
| Pavilion | pavilion | Pendopo |
| Other | other | Lainnya |

---

## Migration 2 — Tabel Situs Cagar Budaya

**File:** `create_heritage_sites_table`
**Model:** `HeritageSite`

Tabel utama untuk menyimpan data lokasi cagar budaya (candi, situs budaya, tempat bersejarah, pendopo, dll).

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `site_category_id` | `foreignId` | required, FK → `site_categories.id` | Kategori situs |
| `name` | `string` | required | Nama situs cagar budaya |
| `slug` | `string` | required, unique | Slug URL-friendly |
| `description` | `text` | required | Deskripsi lengkap situs |
| `address` | `text` | required | Alamat lengkap |
| `latitude` | `decimal(10,7)` | required | Koordinat GPS latitude |
| `longitude` | `decimal(10,7)` | required | Koordinat GPS longitude |
| `operating_hours` | `json` | nullable | Jam operasional (format JSON per hari) |
| `admission_fee` | `unsignedInteger` | nullable, default: 0 | Harga tiket masuk (Rp), null = gratis |
| `registration_number` | `string` | nullable, unique | Nomor registrasi cagar budaya |
| `designation_year` | `year` | nullable | Tahun penetapan sebagai cagar budaya |
| `status` | `enum` | required, default: `active` | Status situs: `active`, `under_renovation`, `temporarily_closed` |
| `is_facility_available` | `boolean` | default: true | Apakah fasilitas situs tersedia untuk diajukan |
| `created_by` | `foreignId` | nullable, FK → `users.id` | User yang menginput data |
| `timestamps` | `timestamps()` | | created_at, updated_at |
| `softDeletes` | `softDeletes()` | | deleted_at |

**Index:**
- `index(['status'])` — filter berdasarkan status
- `index(['site_category_id'])` — filter berdasarkan kategori
- `index(['latitude', 'longitude'])` — query spasial peta

**Aturan bisnis terkait:**
- `latitude` dan `longitude` wajib diisi (required) — agar bisa tampil di peta
- `site_category_id` wajib merujuk ke tabel `site_categories` — kategori tidak bisa diisi bebas
- Situs dengan status `under_renovation` atau `temporarily_closed` tidak bisa diajukan penggunaan fasilitasnya

---

## Migration 3 — Tabel Foto Situs

**File:** `create_site_photos_table`
**Model:** `SitePhoto`

Menyimpan foto galeri untuk setiap situs cagar budaya. Minimal 1 foto per situs (validasi di level aplikasi).

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `heritage_site_id` | `foreignId` | required, FK → `heritage_sites.id`, cascadeOnDelete | Relasi ke situs |
| `file_path` | `string` | required | Path file foto di storage |
| `caption` | `string` | nullable | Keterangan foto |
| `sort_order` | `unsignedSmallInteger` | default: 0 | Urutan tampil foto |
| `is_featured` | `boolean` | default: false | Apakah foto utama / thumbnail |
| `timestamps` | `timestamps()` | | created_at, updated_at |

**Aturan bisnis terkait:**
- Setiap situs wajib memiliki minimal 1 foto (validasi di Model/Controller, bukan DB constraint)
- Hanya boleh 1 foto dengan `is_featured = true` per situs

---

## Migration 4 — Tabel Permohonan Penggunaan Fasilitas

**File:** `create_facility_usage_requests_table`
**Model:** `FacilityUsageRequest`

Menyimpan data permohonan penggunaan fasilitas cagar budaya oleh masyarakat/instansi.

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `request_number` | `string` | required, unique | Nomor permohonan (auto-generate) |
| `user_id` | `foreignId` | required, FK → `users.id` | Pemohon (user terdaftar) |
| `heritage_site_id` | `foreignId` | required, FK → `heritage_sites.id` | Lokasi/fasilitas yang dimohon |
| `applicant_name` | `string` | required | Nama pemohon |
| `identity_number` | `string` | required | Nomor identitas (KTP / ID instansi) |
| `institution_name` | `string` | nullable | Nama instansi (jika dari instansi) |
| `activity_type` | `string` | required | Jenis kegiatan (budaya, penelitian, syuting, edukasi, dll) |
| `activity_description` | `text` | nullable | Deskripsi detail kegiatan |
| `start_date` | `date` | required | Tanggal mulai kegiatan |
| `end_date` | `date` | required | Tanggal selesai kegiatan |
| `duration_days` | `unsignedSmallInteger` | required | Durasi penggunaan (hari) |
| `participant_count` | `unsignedInteger` | required | Jumlah peserta |
| `application_letter_path` | `string` | required | Path file surat permohonan (upload) |
| `status` | `enum` | required, default: `submitted` | Status: `submitted`, `verified`, `approved`, `rejected`, `completed`, `cancelled` |
| `approval_notes` | `text` | nullable | Catatan persetujuan/penolakan dari pengelola |
| `permit_number` | `string` | nullable, unique | Nomor surat izin (diisi saat disetujui) |
| `fee_amount` | `unsignedInteger` | nullable, default: 0 | Biaya retribusi (Rp) |
| `reviewed_by` | `foreignId` | nullable, FK → `users.id` | Admin/pengelola yang meninjau |
| `reviewed_at` | `timestamp` | nullable | Waktu ditinjau |
| `timestamps` | `timestamps()` | | created_at, updated_at |
| `softDeletes` | `softDeletes()` | | deleted_at |

**Index:**
- `index(['status'])` — filter berdasarkan status
- `index(['heritage_site_id', 'start_date', 'end_date'])` — cek ketersediaan (overlap)
- `index(['user_id'])` — riwayat permohonan per user

**Aturan bisnis terkait:**
- Tidak boleh ada overlap pada situs + tanggal yang sama → validasi di level aplikasi (query overlap `start_date`/`end_date`)
- `start_date` minimal **H+7** dari tanggal pengajuan
- `application_letter_path` wajib diisi (surat permohonan wajib diunggah)
- Jika `status` = `approved`, maka `permit_number` wajib diisi
- Fasilitas dengan `heritage_sites.status` = `under_renovation` atau `temporarily_closed` tidak bisa diajukan (validasi di Controller)
- Pembatalan (`cancelled`) kurang dari 3 hari sebelum `start_date` → catat sebagai sanksi administratif

---

## Migration 5 — Tabel Laporan Kondisi Situs

**File:** `create_site_condition_reports_table`
**Model:** `SiteConditionReport`

Menyimpan laporan survei kondisi situs cagar budaya secara berkala. Data bersifat log (append-only, tidak bisa dihapus).

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `heritage_site_id` | `foreignId` | required, FK → `heritage_sites.id` | Situs yang dilaporkan |
| `surveyor_id` | `foreignId` | required, FK → `users.id` | Petugas survei (Pengelola Situs) |
| `survey_date` | `date` | required | Tanggal survei dilakukan |
| `condition` | `enum` | required | Kondisi: `good`, `minor_damage`, `moderate_damage`, `severe_damage` |
| `findings` | `text` | required | Deskripsi temuan survei |
| `recommendation` | `text` | nullable | Rekomendasi tindakan pelestarian |
| `is_urgent` | `boolean` | default: false | Apakah butuh tindakan darurat (kerusakan berat) |
| `responded_by` | `foreignId` | nullable, FK → `users.id` | Pimpinan yang merespon |
| `responded_at` | `timestamp` | nullable | Waktu direspon |
| `response_notes` | `text` | nullable | Catatan respon pimpinan |
| `timestamps` | `timestamps()` | | created_at, updated_at |

> ⚠️ **Tidak menggunakan `softDeletes()`** — riwayat kondisi bersifat log permanen, tidak boleh dihapus. Implementasikan juga larangan hard delete di level Model (override method `delete()`).

**Index:**
- `index(['heritage_site_id', 'survey_date'])` — query riwayat per situs
- `index(['condition'])` — filter berdasarkan kondisi
- `index(['is_urgent'])` — filter laporan darurat

**Aturan bisnis terkait:**
- Setiap situs wajib disurvei minimal 1x per semester → buat scheduled command untuk cek
- Jika `condition` = `severe_damage`, maka `is_urgent` otomatis `true`
- Laporan dengan `is_urgent = true` harus direspon (`responded_by`, `responded_at`) dalam 1×24 jam
- Data **tidak boleh dihapus** (bersifat log) → override `delete()` di Model

---

## Migration 6 — Tabel Foto Laporan Kondisi

**File:** `create_condition_report_photos_table`
**Model:** `ConditionReportPhoto`

Menyimpan foto dokumentasi dari setiap laporan kondisi situs.

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `id` | `id()` | PK, auto-increment | |
| `site_condition_report_id` | `foreignId` | required, FK → `site_condition_reports.id`, cascadeOnDelete | Relasi ke laporan |
| `file_path` | `string` | required | Path file foto di storage |
| `caption` | `string` | nullable | Keterangan foto |
| `timestamps` | `timestamps()` | | created_at, updated_at |

---

## Migration 7 — Modifikasi Tabel Users (add role)

**File:** `add_role_to_users_table`

Menambahkan kolom `role` pada tabel `users` bawaan Laravel untuk membedakan hak akses pengguna.

| Kolom | Tipe | Constraint | Keterangan |
|-------|------|------------|------------|
| `role` | `enum` | required, default: `visitor` | Peran: `admin`, `site_manager`, `leader`, `visitor` |

**Mapping peran:**

| Enum Value | Peran (PRD) | Keterangan |
|------------|-------------|------------|
| `admin` | Administrator | Staf TI — kelola seluruh data & hak akses |
| `site_manager` | Pengelola Situs | Staf teknis — kelola data situs & permohonan |
| `leader` | Pimpinan | Kepala Balai — dashboard & laporan (read-only) |
| `visitor` | Pengunjung | Masyarakat umum — lihat info & ajukan permohonan |

---

## Urutan Eksekusi Migration

```
1. create_site_categories_table
2. create_heritage_sites_table          (FK → site_categories)
3. create_site_photos_table             (FK → heritage_sites)
4. create_facility_usage_requests_table (FK → heritage_sites, users)
5. create_site_condition_reports_table  (FK → heritage_sites, users)
6. create_condition_report_photos_table (FK → site_condition_reports)
7. add_role_to_users_table              (alter users)
```

---

## Ringkasan Enum Values

| Kolom | Tabel | Values |
|-------|-------|--------|
| `status` | `heritage_sites` | `active`, `under_renovation`, `temporarily_closed` |
| `status` | `facility_usage_requests` | `submitted`, `verified`, `approved`, `rejected`, `completed`, `cancelled` |
| `condition` | `site_condition_reports` | `good`, `minor_damage`, `moderate_damage`, `severe_damage` |
| `role` | `users` | `admin`, `site_manager`, `leader`, `visitor` |

---
