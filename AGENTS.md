# AGENTS.md

## Stack

Laravel 13 + Blade + Tailwind CSS 4 (via `@tailwindcss/vite`) + Vite.  
PHP ^8.3, SQLite (dev & test), MySQL opsional.  
Tidak pakai frontend framework. Konten bahasa Indonesia.

## Perintah

| Perintah | Fungsi |
|---------|-------------|
| `composer setup` | Setup pertama: install dep, salin `.env`, `key:generate`, `migrate --force`, `npm install --ignore-scripts`, `npm run build` |
| `composer dev` | Jalankan 4 proses concurrently (server, queue, pail logs, Vite) dengan warna berbeda |
| `composer test` | `php artisan config:clear --ansi` lalu `php artisan test` (SQLite in-memory) |
| `npm run dev` | Vite dev server saja (Blade hot reload) |
| `npm run build` | Vite production build |
| `./vendor/bin/pint` | Laravel Pint (PSR-12, tanpa file konfigurasi) |

## Arsitektur

- **Panel admin**: prefix `/johen-admin-secret`, name `admin.*` (`routes/web.php:32`). Middleware `guest` untuk login (GET+POST); middleware `auth` untuk sisanya (logout POST-only, dashboard, semua CRUD).
- **Rute publik** (9): home, tentang, produk, berita index+show, karir (GET+POST lamar), konten-digital, kontak (GET+POST kirim).
- **Entrypoints**: `public/index.php` (app), `resources/css/app.css` + `resources/js/app.js` (input Vite; `js/app.js` kosong).
- **Font**: layout publik dan admin sama-sama pakai inline `<style>` import **Poppins** dari Google Fonts — BUKAN 'Instrument Sans' dari `bunny()` di `app.css`/Vite config.
- **Layout**: keduanya pakai inline `<style>` dengan CSS variable, bukan utility class Tailwind.
- **Logo**: `{{ asset('img/logo/johen_logo.png') }}` di partial header. Hero background dari `public/img/bg/bg1.jpeg` dll. Semua di-gitignore — cek keberadaannya setelah clone.
- **Model** (7): `User`, `Produk`, `Berita`, `Lowongan`, `Pelamar`, `PesanKontak`, `KontenDigital`. Hanya `User` punya factory.
- **Scope model**: `scopeAktif()` di Produk, Berita, Lowongan, KontenDigital. `scopeUnggulan()` di Produk dan KontenDigital.
- **Berita model**: method static `generateSlug()` sendiri, accessor `getRingkasanAttribute()` (strip_tags + Str::limit 150).
- **Controller admin**: `App\Http\Controllers\Admin\*`. Auth pakai Laravel bawaan (tanpa Breeze/Jetstream). Logout wajib POST + CSRF.
- **Seeder** (`DatabaseSeeder.php`) buat admin (`admin@johengaming.com` / `Johen2025!`) + konten hardcoded untuk semua model konten.
- **Paginator**: custom view di `vendor.pagination.simple` diset di `AppServiceProvider` (prev/next saja, tanpa nomor halaman).
- **Email**: template notifikasi di `emails.notif_kontak`. Gagal terkirim diamkan (catch kosong).
- **Tidak ada CI**: direktori `.github/` tidak ada.

## Pola penting

- **Upload CV**: `$request->file('cv')->store('cv', 'public')` → `storage/app/public/cv/`. Wajib `php artisan storage:link` setelah clone.
- **Rute admin**: resource controller `->except(['show'])` untuk Produk, Berita, Lowongan, KontenDigital. Pelamar dan Pesan read-only (index + destroy; Pesan juga ada show).
- **PesanKontak**: migrasi punya `tujuan` enum `jual/beli/cs` dengan kolom lengkap (nama_game, level_akun, harga_harapan, game_dicari, budget_maksimal, request_khusus, sudah_dibaca), tapi **controller hanya validasi `tujuan => required|in:cs`**. Template email `notif_kontak.blade.php` masih punya cabang `jual`/`beli` yang tidak terpakai — biarkan saja, jangan aktifkan validasi jual/beli kecuali template juga diupdate.
- **Template** Blade extends `layouts.app` (publik) atau `admin.layout` (admin). Kedua layout pakai inline `<style>` — bukan utility class Tailwind di HTML.
- **Tidak ada direktori `lang/`** — semua teks hardcode bahasa Indonesia di Blade template.

## Jebakan

- **`.npmrc`**: `ignore-scripts=true`. Menambah package dengan postinstall script (misal `esbuild`) perlu `npm install --ignore-scripts=false <pkg>`.
- **Default `.env.example`**: `DB_CONNECTION=sqlite`, `SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`, `MAIL_MAILER=log`.
- **`APP_LOCALE`**: default `en` (tidak diset di `.env.example`) padahal semua konten bahasa Indonesia.
- **Font Vite**: `bunny()` CDN untuk 'Instrument Sans' sudah dikonfigurasi di `vite.config.js` tapi **tidak dipakai** — kedua layout pakai Poppins via Google Fonts langsung.

## Testing

- `phpunit.xml` paksa `APP_ENV=testing`, SQLite `:memory:`, array cache/mail/session, sync queue.
- Pakai `RefreshDatabase` trait di `Feature\ExampleTest.php`.
- Hanya 2 test skeleton (`Feature/ExampleTest.php`, `Unit/ExampleTest.php`).
- Urutan: selalu `config:clear` sebelum test (`composer test` sudah otomatis).
