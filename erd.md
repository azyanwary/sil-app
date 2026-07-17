# ERD — Sistem Informasi Layanan Balai Pelestarian Kebudayaan DI Yogyakarta

```mermaid
erDiagram
    users {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        enum role "admin | site_manager | leader | visitor"
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    site_categories {
        bigint id PK
        string name UK
        string slug UK
        text description
        string icon
        timestamp created_at
        timestamp updated_at
    }

    heritage_sites {
        bigint id PK
        bigint site_category_id FK
        string name
        string slug UK
        text description
        text address
        decimal latitude "10,7"
        decimal longitude "10,7"
        json operating_hours
        int admission_fee "nullable, default 0"
        string registration_number UK
        year designation_year
        enum status "active | under_renovation | temporarily_closed"
        boolean is_facility_available "default true"
        bigint created_by FK
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }

    site_photos {
        bigint id PK
        bigint heritage_site_id FK
        string file_path
        string caption
        smallint sort_order "default 0"
        boolean is_featured "default false"
        timestamp created_at
        timestamp updated_at
    }

    facility_usage_requests {
        bigint id PK
        string request_number UK
        bigint user_id FK
        bigint heritage_site_id FK
        string applicant_name
        string identity_number
        string institution_name
        string activity_type
        text activity_description
        date start_date
        date end_date
        smallint duration_days
        int participant_count
        string application_letter_path
        enum status "submitted | verified | approved | rejected | completed | cancelled"
        text approval_notes
        string permit_number UK
        int fee_amount "nullable, default 0"
        bigint reviewed_by FK
        timestamp reviewed_at
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }

    site_condition_reports {
        bigint id PK
        bigint heritage_site_id FK
        bigint surveyor_id FK
        date survey_date
        enum condition "good | minor_damage | moderate_damage | severe_damage"
        text findings
        text recommendation
        boolean is_urgent "default false"
        bigint responded_by FK
        timestamp responded_at
        text response_notes
        timestamp created_at
        timestamp updated_at
    }

    condition_report_photos {
        bigint id PK
        bigint site_condition_report_id FK
        string file_path
        string caption
        timestamp created_at
        timestamp updated_at
    }

    %% Relationships
    site_categories ||--o{ heritage_sites : "has many"
    users ||--o{ heritage_sites : "creates"
    heritage_sites ||--o{ site_photos : "has many"
    heritage_sites ||--o{ facility_usage_requests : "has many"
    heritage_sites ||--o{ site_condition_reports : "has many"
    users ||--o{ facility_usage_requests : "submits"
    users ||--o{ facility_usage_requests : "reviews"
    users ||--o{ site_condition_reports : "surveys"
    users ||--o{ site_condition_reports : "responds"
    site_condition_reports ||--o{ condition_report_photos : "has many"
```

---

## Keterangan Relasi

| Relasi | Tipe | FK Column | Deskripsi |
|--------|------|-----------|-----------|
| `users` → `heritage_sites` | One-to-Many | `created_by` | User (admin/site_manager) yang menginput situs |
| `site_categories` → `heritage_sites` | One-to-Many | `site_category_id` | Kategori situs (Temple, Cultural Site, dst) |
| `heritage_sites` → `site_photos` | One-to-Many | `heritage_site_id` | Galeri foto situs (cascade delete) |
| `heritage_sites` → `facility_usage_requests` | One-to-Many | `heritage_site_id` | Permohonan penggunaan fasilitas di situs |
| `users` → `facility_usage_requests` | One-to-Many | `user_id` | Pemohon yang mengajukan |
| `users` → `facility_usage_requests` | One-to-Many | `reviewed_by` | Admin/pengelola yang meninjau |
| `heritage_sites` → `site_condition_reports` | One-to-Many | `heritage_site_id` | Laporan kondisi situs |
| `users` → `site_condition_reports` | One-to-Many | `surveyor_id` | Petugas yang melakukan survei |
| `users` → `site_condition_reports` | One-to-Many | `responded_by` | Pimpinan yang merespon laporan |
| `site_condition_reports` → `condition_report_photos` | One-to-Many | `site_condition_report_id` | Foto dokumentasi laporan (cascade delete) |

---

## Ringkasan Tabel

| # | Tabel | Jumlah Kolom | Soft Delete | Keterangan |
|---|-------|-------------|-------------|------------|
| 1 | `users` (modify) | +1 (`role`) | — | Tambah kolom role |
| 2 | `site_categories` | 6 | ✗ | Lookup kategori |
| 3 | `heritage_sites` | 16 | ✓ | Data utama situs |
| 4 | `site_photos` | 7 | ✗ | Galeri foto situs |
| 5 | `facility_usage_requests` | 21 | ✓ | Permohonan fasilitas |
| 6 | `site_condition_reports` | 13 | ✗ | Laporan kondisi (log) |
| 7 | `condition_report_photos` | 5 | ✗ | Foto laporan kondisi |

---
