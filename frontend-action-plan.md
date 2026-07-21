# Rencana Aksi: Frontend Publik — Sistem Informasi Layanan Balai Pelestarian Kebudayaan DIY

> **Stack**: Laravel 13 + Livewire 4 + Tailwind CSS 4 + Leaflet.js  
> **Tujuan**: Membangun halaman publik (non-Filament) untuk pengunjung umum sesuai PRD

---

## Fase 0 — Persiapan & Instalasi

### 0.1 Install Livewire 4
```bash
composer require livewire/livewire:"^4.0"
```

### 0.2 Konfigurasi Tailwind CSS
- Tailwind CSS 4 sudah terinstal (`package.json`).
- Tambahkan `@source` untuk komponen Livewire di `resources/css/app.css`:
```css
@source '../../app/Livewire/**/*.php';
@source '../../resources/views/livewire/**/*.blade.php';
```

### 0.3 Setup Layout Blade
- Buat layout utama `resources/views/components/layouts/public.blade.php` yang berisi:
  - `<head>` dengan meta SEO, Google Fonts (Inter/Outfit), `@vite`, `@livewireStyles`
  - Navbar publik (logo, navigasi: Beranda, Peta, Katalog, Permohonan Fasilitas)
  - Footer (info instansi, kontak, tautan cepat)
  - `@livewireScripts`
- Buat layout wrapper `resources/views/components/layouts/app.blade.php` sebagai Livewire layout default

---

## Fase 1 — Halaman Beranda (Landing Page)

### 1.1 Livewire Component: `App\Livewire\Pages\Home`
**Route**: `GET /`

**Konten**:
- **Hero Section**: Judul besar + tagline + background gambar cagar budaya + CTA "Jelajahi Peta"
- **Statistik Ringkas**: Total situs, total kategori, total permohonan disetujui (animated counter)
- **Kategori Situs**: Grid card dari `SiteCategory` (ikon + nama + jumlah situs) — klik menuju katalog terfilter
- **Situs Unggulan**: Carousel/grid 6 situs `HeritageSite` terbaru/terpopuler dengan foto `is_featured`
- **CTA Section**: Ajakan untuk mengajukan permohonan penggunaan fasilitas

### File yang dibuat:
| File | Keterangan |
|------|------------|
| `app/Livewire/Pages/Home.php` | Livewire full-page component |
| `resources/views/livewire/pages/home.blade.php` | View template |

---

## Fase 2 — Peta Interaktif

### 2.1 Livewire Component: `App\Livewire\Pages\MapExplorer`
**Route**: `GET /peta`

**Fitur**:
- Peta Leaflet.js fullscreen dengan marker untuk setiap `HeritageSite` yang statusnya `aktif`
- Cluster marker jika situs berdekatan
- Popup marker: nama situs, foto thumbnail, kategori, tombol "Lihat Detail"
- Sidebar panel filter:
  - Filter kategori (checkbox dari `SiteCategory`)
  - Filter status (aktif / dalam renovasi / tutup sementara)
  - Search by nama
- Sinkronisasi filter Livewire ↔ Leaflet via `@entangle` atau `$wire`

### 2.2 Aset JS
- Include Leaflet.js via CDN (CSS + JS)
- Include MarkerCluster plugin
- Custom JS untuk inisialisasi peta dan komunikasi dengan Livewire (`resources/js/map.js`)

### File yang dibuat:
| File | Keterangan |
|------|------------|
| `app/Livewire/Pages/MapExplorer.php` | Livewire component + query filter |
| `resources/views/livewire/pages/map-explorer.blade.php` | View dengan div peta + sidebar filter |
| `resources/js/map.js` | Inisialisasi Leaflet, bindMarker, event listener |

---

## Fase 3 — Katalog Situs Cagar Budaya

### 3.1 Livewire Component: `App\Livewire\Pages\SiteCatalog`
**Route**: `GET /situs`

**Fitur**:
- Grid card responsif dari `HeritageSite` (foto featured, nama, kategori badge, alamat singkat, status badge)
- Filter sidebar / top bar:
  - Dropdown kategori (`SiteCategory`)
  - Dropdown status
  - Search teks (nama, alamat)
- Sorting: terbaru, nama A-Z
- Pagination (Livewire paginator + scroll ke atas)
- Klik card → halaman detail

### 3.2 Livewire Component: `App\Livewire\Pages\SiteDetail`
**Route**: `GET /situs/{slug}`

**Fitur**:
- Header: nama situs + badge kategori + badge status
- Galeri foto: grid/carousel dari `SitePhoto` (lightbox on click)
- Tab/Section informasi:
  - **Deskripsi** — deskripsi lengkap
  - **Informasi Praktis** — alamat, jam operasional, harga tiket
  - **Lokasi** — mini-map Leaflet dengan single marker + link Google Maps
  - **Data Registrasi** — nomor registrasi, tahun penetapan
- Tombol "Ajukan Penggunaan Fasilitas" (jika `is_facility_available = true`)
- Breadcrumb: Beranda > Katalog > [Nama Situs]

### File yang dibuat:
| File | Keterangan |
|------|------------|
| `app/Livewire/Pages/SiteCatalog.php` | Component list + filter + pagination |
| `resources/views/livewire/pages/site-catalog.blade.php` | Grid view |
| `app/Livewire/Pages/SiteDetail.php` | Component detail situs |
| `resources/views/livewire/pages/site-detail.blade.php` | View detail |

---

## Fase 4 — Applicant Panel (Filament Panel Kedua)

> Panel Filament terpisah di path `/applicant` khusus untuk **applicant/pengunjung terdaftar**.
> Applicant memiliki **tabel database tersendiri** (`applicants`) yang terpisah dari `users` (internal).
> Semua fitur permohonan fasilitas dan riwayat dikelola di panel ini menggunakan Filament Resource.

### 4.1 Tabel Database: `applicants`

**Migration**: `database/migrations/xxxx_create_applicants_table.php`

```php
Schema::create('applicants', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('phone')->nullable();
    $table->string('identity_number')->nullable();       // KTP / ID instansi
    $table->string('institution_name')->nullable();       // nama instansi
    $table->text('address')->nullable();
    $table->rememberToken();
    $table->timestamps();
});
```

### 4.2 Model: `App\Models\Applicant`

**File**: `app/Models/Applicant.php`

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Applicant extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone',
        'identity_number', 'institution_name', 'address',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'applicant';
    }

    public function facilityUsageRequests(): HasMany
    {
        return $this->hasMany(FacilityUsageRequest::class, 'applicant_id');
    }
}
```

### 4.3 Auth Guard: `applicant`

**File**: `config/auth.php` — Tambahkan guard dan provider baru:

```php
'guards' => [
    'web' => [...],          // guard default untuk User (admin)
    'applicant' => [         // guard baru untuk Applicant
        'driver' => 'session',
        'provider' => 'applicants',
    ],
],

'providers' => [
    'users' => [...],        // provider default
    'applicants' => [        // provider baru
        'driver' => 'eloquent',
        'model' => App\Models\Applicant::class,
    ],
],

'passwords' => [
    'users' => [...],
    'applicants' => [        // reset password untuk applicant
        'provider' => 'applicants',
        'table' => 'password_reset_tokens',
        'expire' => 60,
    ],
],
```

### 4.4 Migrasi Tabel `facility_usage_requests`

Tambahkan kolom `applicant_id` pada tabel `facility_usage_requests`:

**Migration**: `database/migrations/xxxx_add_applicant_id_to_facility_usage_requests_table.php`

```php
Schema::table('facility_usage_requests', function (Blueprint $table) {
    $table->foreignId('applicant_id')->nullable()->after('user_id')
          ->constrained('applicants')->nullOnDelete();
});
```

Update model `FacilityUsageRequest` — tambahkan relasi:
```php
public function applicant(): BelongsTo
{
    return $this->belongsTo(Applicant::class, 'applicant_id');
}
```

### 4.5 Panel Provider: `ApplicantPanelProvider`

**File**: `app/Providers/Filament/ApplicantPanelProvider.php`

```php
class ApplicantPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('applicant')
            ->path('applicant')
            ->authGuard('applicant')             // gunakan guard applicant
            ->authPasswordBroker('applicants')   // password broker untuk reset
            ->login()
            ->registration(Registration::class)
            ->passwordReset()
            ->profile()
            ->brandName('Applicant Portal')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->spa()
            ->discoverResources(
                in: app_path('Filament/Applicant/Resources'),
                for: 'App\\Filament\\Applicant\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Applicant/Pages'),
                for: 'App\\Filament\\Applicant\\Pages'
            )
            ->discoverWidgets(
                in: app_path('Filament/Applicant/Widgets'),
                for: 'App\\Filament\\Applicant\\Widgets'
            )
            ->pages([
                ApplicantDashboard::class,
            ])
            ->middleware([...])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
```

### 4.6 Custom Registration

**File**: `app/Filament/Applicant/Pages/Auth/Registration.php`

Form registrasi dengan field tambahan khusus applicant:

```php
class Registration extends \Filament\Pages\Auth\Register
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel(),
                        TextInput::make('identity_number')
                            ->label('No. KTP / ID Instansi'),
                        TextInput::make('institution_name')
                            ->label('Nama Instansi (opsional)'),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
            ),
        ];
    }
}
```

### 4.7 Applicant Dashboard

**File**: `app/Filament/Applicant/Pages/ApplicantDashboard.php`

| Widget | Keterangan |
|--------|------------|
| `TotalPermohonanWidget` | Jumlah total permohonan milik applicant (diajukan, disetujui, ditolak) |
| `PermohonanTerbaruWidget` | Daftar 5 permohonan terakhir dengan status badge |
| `NotifikasiWidget` | Notifikasi update status permohonan |

### 4.8 Resource: Permohonan Penggunaan Fasilitas

**File**: `app/Filament/Applicant/Resources/FacilityUsageRequestResource.php`

#### Halaman List (Riwayat Permohonan)
- Query: `->modifyQueryUsing(fn ($query) => $query->where('applicant_id', auth('applicant')->id()))`
- Kolom: nomor permohonan, lokasi/situs, jenis kegiatan, tanggal, status (badge warna)
- Filter: status, rentang tanggal

#### Halaman Create (Wizard/Step)

- **Step 1 — Pilih Lokasi**: `Select` HeritageSite (`is_facility_available = true`, status `aktif`)
- **Step 2 — Jadwal**: `DatePicker` tanggal mulai & selesai + validasi H-7 + cek konflik
- **Step 3 — Detail Permohonan**:
  - Nama, No. KTP, instansi (auto-fill dari profil applicant)
  - Jenis kegiatan, deskripsi, jumlah peserta
  - Upload surat permohonan (wajib)
- **Mutate**: Otomatis set `applicant_id` dari `auth('applicant')->id()`

#### Halaman View (Detail Permohonan)
- Infolist detail + status badge + catatan reviewer + download surat izin

#### Kebijakan Akses (Policy)
- Applicant **hanya bisa melihat permohonan miliknya sendiri**
- Applicant **bisa membuat** permohonan baru
- Applicant **tidak bisa mengedit/menghapus** permohonan yang sudah diajukan
- Applicant **tidak bisa mengubah status** permohonan

### 4.9 Integrasi dengan Halaman Publik

- Tombol **"Masuk"** / **"Daftar"** di navbar → `/applicant/login` dan `/applicant/register`
- Tombol **"Ajukan Penggunaan Fasilitas"** di halaman detail situs:
  - Belum login → `/applicant/login`
  - Sudah login → `/applicant/facility-usage-requests/create`

### Ringkasan Arsitektur Auth

| Aspek | Panel Admin (`/admin`) | Applicant Panel (`/applicant`) |
|-------|------------------------|---------------------------|
| **Tabel DB** | `users` | `applicants` |
| **Model** | `App\Models\User` | `App\Models\Applicant` |
| **Guard** | `web` | `applicant` |
| **Pengguna** | Admin, Pengelola Situs, Pimpinan | Masyarakat / Instansi applicant |
| **Registrasi** | Tidak (dibuat admin) | Ya (self-register) |
| **Fitur** | Kelola seluruh data sistem | Ajukan & pantau permohonan |

### File yang dibuat:
| File | Keterangan |
|------|------------|
| `database/migrations/xxxx_create_applicants_table.php` | [NEW] Migration tabel applicants |
| `database/migrations/xxxx_add_applicant_id_to_facility_usage_requests_table.php` | [NEW] Tambah kolom applicant_id |
| `app/Models/Applicant.php` | [NEW] Model Applicant |
| `app/Models/FacilityUsageRequest.php` | [MODIFY] Tambah relasi applicant() |
| `config/auth.php` | [MODIFY] Tambah guard & provider applicant |
| `app/Providers/Filament/ApplicantPanelProvider.php` | [NEW] Applicant panel provider |
| `app/Filament/Applicant/Pages/Auth/Registration.php` | [NEW] Custom registration |
| `app/Filament/Applicant/Pages/ApplicantDashboard.php` | [NEW] Applicant Dashboard |
| `app/Filament/Applicant/Widgets/TotalPermohonanWidget.php` | [NEW] Widget statistik |
| `app/Filament/Applicant/Widgets/PermohonanTerbaruWidget.php` | [NEW] Widget permohonan terbaru |
| `app/Filament/Applicant/Resources/FacilityUsageRequestResource.php` | [NEW] Resource permohonan |
| `app/Filament/Applicant/Resources/FacilityUsageRequestResource/Pages/` | [NEW] List, Create, View pages |
| `app/Policies/ApplicantFacilityUsageRequestPolicy.php` | [NEW] Policy akses applicant |

---

## Fase 6 — Komponen UI Reusable (Blade Components)

Komponen Blade yang dipakai berulang di semua halaman:

| Komponen | Path | Fungsi |
|----------|------|--------|
| `<x-public.navbar>` | `resources/views/components/public/navbar.blade.php` | Navigasi utama (responsive + mobile hamburger) |
| `<x-public.footer>` | `resources/views/components/public/footer.blade.php` | Footer instansi |
| `<x-public.hero>` | `resources/views/components/public/hero.blade.php` | Hero section reusable |
| `<x-public.site-card>` | `resources/views/components/public/site-card.blade.php` | Card situs untuk grid/catalog |
| `<x-public.category-card>` | `resources/views/components/public/category-card.blade.php` | Card kategori |
| `<x-public.status-badge>` | `resources/views/components/public/status-badge.blade.php` | Badge status situs/permohonan |
| `<x-public.breadcrumb>` | `resources/views/components/public/breadcrumb.blade.php` | Breadcrumb navigasi |
| `<x-public.stat-counter>` | `resources/views/components/public/stat-counter.blade.php` | Angka statistik dengan animasi |

---

## Fase 7 — Routing

### `routes/web.php` (Halaman Publik)
```php
use App\Livewire\Pages\Home;
use App\Livewire\Pages\MapExplorer;
use App\Livewire\Pages\SiteCatalog;
use App\Livewire\Pages\SiteDetail;

// Halaman publik (tanpa auth)
Route::get('/', Home::class)->name('home');
Route::get('/peta', MapExplorer::class)->name('map');
Route::get('/situs', SiteCatalog::class)->name('sites.index');
Route::get('/situs/{slug}', SiteDetail::class)->name('sites.show');
```

### Routing Filament (Otomatis)
| Path | Fungsi | Dikelola oleh |
|------|--------|---------------|
| `/admin/login` | Login admin/pengelola | `AdminPanelProvider` |
| `/applicant/login` | Applicant login | `ApplicantPanelProvider` |
| `/applicant/register` | Applicant registration | `ApplicantPanelProvider` |
| `/applicant` | Applicant Dashboard | `ApplicantPanelProvider` |
| `/applicant/facility-usage-requests` | Kelola permohonan | `ApplicantPanelProvider` |

---

## Fase 8 — Desain & Polish

### 8.1 Skema Warna
- **Primary**: Warna emas/cokelat tua (nuansa heritage/budaya Jawa)
- **Secondary**: Hijau tua (nuansa alam/pelestarian)
- **Accent**: Merah bata (aksen tradisional)
- **Background**: Putih gading / krem halus
- **Dark mode**: Opsional (fase lanjutan)

### 8.2 Tipografi
- Heading: **Outfit** (Google Fonts) — tegas, modern
- Body: **Inter** (Google Fonts) — bersih, mudah dibaca

### 8.3 Animasi & Interaksi
- Scroll reveal untuk section di beranda (IntersectionObserver / Alpine.js `x-intersect`)
- Hover effect pada card (scale, shadow)
- Smooth page transition via Livewire `wire:navigate`
- Loading skeleton saat data dimuat
- Counter animasi pada statistik beranda

### 8.4 Responsivitas
- Mobile-first design
- Navbar → hamburger menu di mobile
- Grid card → 1 kolom di mobile, 2 di tablet, 3-4 di desktop
- Peta → full-width di mobile, sidebar collapse

---

## Fase 9 — Multibahasa (Internationalization / i18n)

> **Bahasa yang didukung**: Indonesia (`id`) & English (`en`)  
> **Infrastruktur yang sudah ada**:
> - `laravel-lang/lang` (dev dependency)
> - `bezhansalleh/filament-language-switch` untuk panel admin
> - Model `HeritageSite`, `SiteCategory`, `SitePhoto` sudah menggunakan `Spatie\Translatable\HasTranslations`
> - Locale dikonfigurasi: `['en', 'id']`

### 9.1 File Terjemahan (Language Files)

Buat file terjemahan JSON untuk teks statis UI frontend:

```
resources/lang/
├── id.json      ← terjemahan Bahasa Indonesia
└── en.json      ← terjemahan Bahasa Inggris
```

**Contoh `id.json`**:
```json
{
    "Beranda": "Beranda",
    "Peta Interaktif": "Peta Interaktif",
    "Katalog Situs": "Katalog Situs",
    "Permohonan Fasilitas": "Permohonan Fasilitas",
    "Riwayat Permohonan": "Riwayat Permohonan",
    "Masuk": "Masuk",
    "Daftar": "Daftar",
    "Jelajahi Peta": "Jelajahi Peta",
    "Cari lokasi cagar budaya...": "Cari lokasi cagar budaya...",
    "Total Situs": "Total Situs",
    "Kategori": "Kategori",
    "Situs Unggulan": "Situs Unggulan",
    "Lihat Detail": "Lihat Detail",
    "Ajukan Penggunaan Fasilitas": "Ajukan Penggunaan Fasilitas",
    "Deskripsi": "Deskripsi",
    "Informasi Praktis": "Informasi Praktis",
    "Lokasi": "Lokasi",
    "Jam Operasional": "Jam Operasional",
    "Harga Tiket": "Harga Tiket",
    "Nomor Registrasi": "Nomor Registrasi",
    "Tahun Penetapan": "Tahun Penetapan",
    "Status": "Status",
    "aktif": "Aktif",
    "dalam_renovasi": "Dalam Renovasi",
    "tutup_sementara": "Tutup Sementara",
    "diajukan": "Diajukan",
    "diverifikasi": "Diverifikasi",
    "disetujui": "Disetujui",
    "ditolak": "Ditolak",
    "selesai": "Selesai"
}
```

**Contoh `en.json`**:
```json
{
    "Beranda": "Home",
    "Peta Interaktif": "Interactive Map",
    "Katalog Situs": "Site Catalog",
    "Permohonan Fasilitas": "Facility Request",
    "Riwayat Permohonan": "Request History",
    "Masuk": "Sign In",
    "Daftar": "Register",
    "Jelajahi Peta": "Explore Map",
    "Cari lokasi cagar budaya...": "Search cultural heritage sites...",
    "Total Situs": "Total Sites",
    "Kategori": "Category",
    "Situs Unggulan": "Featured Sites",
    "Lihat Detail": "View Details",
    "Ajukan Penggunaan Fasilitas": "Request Facility Usage",
    "Deskripsi": "Description",
    "Informasi Praktis": "Practical Info",
    "Lokasi": "Location",
    "Jam Operasional": "Operating Hours",
    "Harga Tiket": "Ticket Price",
    "Nomor Registrasi": "Registration Number",
    "Tahun Penetapan": "Designation Year",
    "Status": "Status",
    "aktif": "Active",
    "dalam_renovasi": "Under Renovation",
    "tutup_sementara": "Temporarily Closed",
    "diajukan": "Submitted",
    "diverifikasi": "Verified",
    "disetujui": "Approved",
    "ditolak": "Rejected",
    "selesai": "Completed"
}
```

### 9.2 Penggunaan di Blade Template

Semua teks statis di view menggunakan helper `__()` atau directive `@lang()`:
```blade
{{-- Contoh penggunaan --}}
<h1>{{ __('Katalog Situs') }}</h1>
<a href="/peta">{{ __('Jelajahi Peta') }}</a>
<span class="badge">{{ __('aktif') }}</span>
<input placeholder="{{ __('Cari lokasi cagar budaya...') }}">
```

### 9.3 Konten Translatable dari Database

Model yang sudah menggunakan `HasTranslations` (`HeritageSite`, `SiteCategory`, `SitePhoto`) otomatis mengembalikan teks sesuai locale aktif:
```php
// Di Livewire component — tidak perlu perlakuan khusus
// Spatie Translatable otomatis mengembalikan teks sesuai app()->getLocale()
$site->name;        // otomatis id/en sesuai locale
$site->description; // otomatis id/en sesuai locale
$site->address;     // otomatis id/en sesuai locale
```

### 9.4 Language Switcher di Frontend

Tambahkan komponen pemilih bahasa di navbar:

| Komponen | Path | Fungsi |
|----------|------|--------|
| `<x-public.language-switcher>` | `resources/views/components/public/language-switcher.blade.php` | Dropdown/toggle pilih bahasa (ID/EN) |

**Mekanisme**:
- Klik tombol bahasa → hit route `GET /locale/{locale}` → simpan locale di session → redirect back
- Middleware `SetLocale` membaca session dan set `app()->setLocale()`

**Route**:
```php
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');
```

**Middleware**: `App\Http\Middleware\SetLocale`
```php
public function handle($request, Closure $next)
{
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
    return $next($request);
}
```

### 9.5 SEO Multibahasa
- Tambahkan tag `<html lang="{{ app()->getLocale() }}">` di layout
- Tambahkan `<link rel="alternate" hreflang="id" href="...">` dan `hreflang="en"` di `<head>`
- Meta description disesuaikan per bahasa

### File yang dibuat/dimodifikasi:
| File | Keterangan |
|------|------------|
| `resources/lang/id.json` | [NEW] Terjemahan Indonesia |
| `resources/lang/en.json` | [NEW] Terjemahan Inggris |
| `app/Http/Middleware/SetLocale.php` | [NEW] Middleware set locale dari session |
| `resources/views/components/public/language-switcher.blade.php` | [NEW] Komponen pemilih bahasa |
| `bootstrap/app.php` | [MODIFY] Daftarkan middleware `SetLocale` |
| `routes/web.php` | [MODIFY] Tambah route `/locale/{locale}` |
| Semua view blade di `resources/views/livewire/` dan `resources/views/components/public/` | [MODIFY] Ganti teks hardcoded → `__('...')` |

---

## Urutan Implementasi (Prioritas)

| Urutan | Fase | Estimasi |
|--------|------|----------|
| 1 | Fase 0 — Persiapan & Instalasi | 0.5 hari |
| 2 | Fase 6 — Komponen UI Reusable | 1 hari |
| 3 | Fase 9 — Multibahasa (i18n) | 0.5 hari |
| 4 | Fase 1 — Halaman Beranda | 1 hari |
| 5 | Fase 3 — Katalog Situs + Detail | 1.5 hari |
| 6 | Fase 2 — Peta Interaktif | 1.5 hari |
| 6 | Fase 2 — Peta Interaktif | 1.5 hari |
| 7 | Fase 4 — Applicant Panel (Filament + DB) | 2.5 hari |
| 8 | Fase 6 — Routing (dikerjakan bersamaan) | — |
| 9 | Fase 7 — Polish & Responsivitas | 1 hari |

**Total estimasi: ±10 hari kerja**

---

## Ringkasan File Baru yang Akan Dibuat

```
database/
├── migrations/
│   ├── xxxx_create_applicants_table.php        ← tabel applicant baru
│   └── xxxx_add_applicant_id_to_facility_usage_requests_table.php
app/
├── Models/
│   └── Applicant.php                           ← model applicant (Authenticatable)
├── Filament/
│   └── Applicant/                                ← Filament Applicant Panel
│       ├── Pages/
│       │   ├── Auth/
│       │   │   └── Registration.php            ← custom register + field tambahan
│       │   └── ApplicantDashboard.php            ← Applicant Dashboard
│       ├── Widgets/
│       │   ├── TotalPermohonanWidget.php
│       │   └── PermohonanTerbaruWidget.php
│       └── Resources/
│           └── FacilityUsageRequestResource/   ← resource permohonan fasilitas
│               └── Pages/
│                   ├── ListFacilityUsageRequests.php
│                   ├── CreateFacilityUsageRequest.php
│                   └── ViewFacilityUsageRequest.php
├── Policies/
│   └── ApplicantFacilityUsageRequestPolicy.php
├── Http/
│   └── Middleware/
│       └── SetLocale.php                       ← middleware set locale dari session
├── Livewire/
│   └── Pages/
│       ├── Home.php
│       ├── MapExplorer.php
│       ├── SiteCatalog.php
│       └── SiteDetail.php
├── Providers/
│   └── Filament/
│       ├── AdminPanelProvider.php               ← (sudah ada) panel admin
│       └── ApplicantPanelProvider.php             ← Applicant Panel baru
config/
└── auth.php                                    ← [MODIFY] tambah guard & provider applicant
resources/
├── lang/
│   ├── id.json                                 ← terjemahan Bahasa Indonesia
│   └── en.json                                 ← terjemahan Bahasa Inggris
├── views/
│   ├── components/
│   │   ├── layouts/
│   │   │   ├── public.blade.php                ← layout utama publik
│   │   │   └── app.blade.php                   ← Livewire layout wrapper
│   │   └── public/
│   │       ├── navbar.blade.php
│   │       ├── footer.blade.php
│   │       ├── hero.blade.php
│   │       ├── site-card.blade.php
│   │       ├── category-card.blade.php
│   │       ├── status-badge.blade.php
│   │       ├── breadcrumb.blade.php
│   │       ├── stat-counter.blade.php
│   │       └── language-switcher.blade.php     ← pemilih bahasa
│   └── livewire/
│       └── pages/
│           ├── home.blade.php
│           ├── map-explorer.blade.php
│           ├── site-catalog.blade.php
│           └── site-detail.blade.php
├── js/
│   └── map.js                                  ← Leaflet.js initialization
routes/
└── web.php                                     ← routing publik + locale switch
```

---

> **Catatan**: Rencana ini menambahkan tabel `applicants` dan kolom `applicant_id` pada `facility_usage_requests`. Model dan migrasi lainnya tidak berubah. Sistem menggunakan **2 panel Filament** (`/admin` dengan guard `web` + tabel `users`, `/applicant` dengan guard `applicant` + tabel `applicants`) dan **halaman publik Livewire** (beranda, peta, katalog) yang tidak memerlukan login.

