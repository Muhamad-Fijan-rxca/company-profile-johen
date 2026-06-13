# AGENTS.md — PT. Johen Sukses Abadi (Johen Gaming)

## Stack

Laravel 13 + Blade + Tailwind CSS 4 (`@tailwindcss/vite`) + Vite.
PHP ^8.3, SQLite (dev & test). Konten Indonesia — **jangan** gunakan `__()`/`trans()`, hardcode teks di Blade.
Font Awesome 6.5.0 (CDN) di kedua layout.

## Commands

| Command | Notes |
|---------|-------|
| `composer setup` | Install dep, copy `.env`, key:generate, migrate --force, `npm install --ignore-scripts`, `npm run build`. **Tidak** seed atau `storage:link`. |
| `composer dev` | `php artisan serve` + `queue:listen --tries=1 --timeout=0` + `pail --timeout=0` + Vite via `concurrently` (`--kill-others`, color-coded) |
| `composer test` | `config:clear` lalu `php artisan test` |
| `npm run dev` | Vite only |
| `./vendor/bin/pint` | PSR-12 formatter, no config |
| `php artisan db:seed` | Jalankan setelah migrate (admin: `admin@johengaming.com` / `Johen2025!`) |
| `php artisan storage:link` | Wajib untuk upload CV & visibilitas gambar |

## Architecture

- **Admin**: prefix `/johen-admin-secret`, name `admin.*`. Bare Laravel auth (no Breeze/Jetstream). Logout **wajib** POST + `@csrf`.
- **14 public routes**: home, tentang, produk+4 sub-kategori, berita index+show, karir GET+POST, konten-digital, kontak GET+POST. Tidak ada API routes.
- **Layouts**: `layouts.app` (public) → `partials.header` + `<main>` + `partials.cta` + `partials.footer`; `admin.layout` (admin). Keduanya pakai `<style>` inline + Poppins (Google Fonts).
- **8 Models**: `User`, `Produk`, `Berita`, `Lowongan`, `Pelamar`, `PesanKontak`, `KontenDigital`, `Sosmed`. Scopes: `Aktif()` pada semua model konten; `Unggulan()` pada Produk & KontenDigital; `Platform()` pada Sosmed.
- **Berita** pakai `Berita::generateSlug($judul)` (duplicate suffix `-2`, `-3`...).
- **Seeder**: hardcoded. Produk, KontenDigital, & Sosmed diurutkan via kolom `urutan`.
- **Paginator**: custom `vendor.pagination.simple` (prev/next) via `AppServiceProvider`.
- **Email**: `emails.notif_kontak` — controller hanya mengirim `cs`, ada branch `jual`/`beli` di template **jangan diaktifkan**.
- **Tailwind v4**: konfigurasi di `resources/css/app.css` (`@import 'tailwindcss'` + `@source` directives), tanpa `tailwind.config.js`.
- **Favicon**: SVG (`favicon.svg`).
- **Tidak ada CI**, tidak ada `.github/`.
- **CV upload**: validasi `required|file|mimes:pdf,doc,docx|max:2048`, store `cv/` di `public` disk. Butuh `storage:link`.

## Gotchas

- **`.npmrc`**: `ignore-scripts=true` — package dengan postinstall (esbuild, dll.) perlu `npm install --ignore-scripts=false <pkg>`.
- **`.env` non-default drivers**: `SESSION_DRIVER=database`, `QUEUE_CONNECTION=database`, `CACHE_STORE=database` — semuanya butuh migration.
- **`APP_LOCALE=en`** di `config/app.php` — jangan pakai `__()`/`trans()`, hardcode teks di Blade.
- **Font mismatch**: `vite.config.js` load Instrument Sans via Bunny CDN, tapi Blade layout pakai Poppins dari Google Fonts. Konfigurasi font Vite tidak terpakai.
- **PesanKontak**: controller validate `tujuan => required|in:cs` saja. Migration punya enum `jual`/`beli`/`cs` — **jangan aktifkan** branch dormant.
- **Produk index**: filter `where('kategori', '!=', 'Konten Digital')`. 4 method sub-kategori bypass filter ini dengan kategori hardcoded.
- **Admin CRUD**: `->except(['show'])` untuk Produk, Berita, Lowongan, KontenDigital, Partner. Pelamar = read-only (index/destroy). Pesan = index/show/destroy. Sosmed = full CRUD dengan upload avatar & thumbnails (max 4).
- **PartnerController** menggunakan model `KontenDigital` dengan filter `kategori = 'Partner'`. Admin partner menyimpan `role` & `followers` yang spesifik untuk partner, tapi disimpan di tabel `konten_digital`.
- **KontenDigitalController** (admin) sengaja mengecualikan `kategori = 'Partner'` via `whereIn('kategori', ['Live Commerce', 'Konten Digital'])` — Partner dikelola terpisah.
- **`storage:link` tidak ada di `composer setup`** — harus manual.
- **`resources/js/app.js`**: kosong (`//`), tidak ada JS framework.
- **`backup-desain-lama/` & `screenshot-figma/`**: aset desain, bukan kode aplikasi.
- **`PROFIL_PERUSAHAAN.md`**: company profile Bahasa Indonesia (visi, misi, struktur, kontak).
- **`.opencode/opencode.json`**: konfigurasi lokal OpenCode — Figma MCP dengan API key. Direktori ini di-gitignore.

## Testing

- `phpunit.xml`: `APP_ENV=testing`, SQLite `:memory:`, array cache/mail/session, sync queue.
- Feature tests pakai `RefreshDatabase`. Hanya ada 2 test file contoh (`Unit/ExampleTest`, `Feature/ExampleTest`).
