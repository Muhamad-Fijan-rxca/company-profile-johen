# AGENTS.md — PT. Johen Sukses Abadi (Johen Gaming)

## Stack

Laravel 13 + Blade + Tailwind CSS 4 (`@tailwindcss/vite`) + Vite.
PHP ^8.3, SQLite (dev & test). Konten Indonesia (tidak ada `lang/`).

## Commands

| Command | Notes |
|---------|-------|
| `composer setup` | Install dep, copy `.env`, key:generate, migrate --force, `npm install --ignore-scripts`, `npm run build` |
| `composer dev` | `php artisan serve` + `queue:listen` + `pail` + Vite concurrently (`--kill-others`, color-coded) |
| `composer test` | `config:clear` then `php artisan test` |
| `npm run dev` | Vite only |
| `./vendor/bin/pint` | PSR-12 formatter, no config |
| `php artisan db:seed` | Run after migrate (admin: `admin@johengaming.com` / `Johen2025!`) |
| `php artisan storage:link` | Required for CV upload & image visibility |

## Architecture

- **Admin**: prefix `/johen-admin-secret`, name `admin.*`. Bare Laravel auth (no Breeze/Jetstream). Logout **must** be POST + `@csrf`.
- **14 public routes**: home, tentang, produk index, 4 sub-kategori (`top-up`, `joki-ml`, `jual-beli-akun`, `live-commerce`), berita index+show, karir GET+POST, konten-digital, kontak GET+POST. No API routes.
- **Layouts**: public = `layouts.app` → `partials.header` + `partials.footer`; admin = `admin.layout`. Both use inline `<style>` + Poppins (Google Fonts).
- **7 Models**: `User` (only factory), `Produk`, `Berita`, `Lowongan`, `Pelamar`, `PesanKontak`, `KontenDigital`. Scopes: `Aktif()` on 4 content models, `Unggulan()` on Produk & KontenDigital.
- **Seeder**: hardcoded content. Produk & KontenDigital sorted by `urutan` column.
- **Paginator**: custom `vendor.pagination.simple` (prev/next) via `AppServiceProvider`.
- **Email**: `emails.notif_kontak` with dormant `jual`/`beli` branches — controller only allows `cs`.
- **Tailwind v4**: config via `resources/css/app.css` (`@import 'tailwindcss'` + `@source`), no `tailwind.config.js`.
- **No CI**, no `.github/` workflows.

## Gotchas

- **`.npmrc`**: `ignore-scripts=true` — packages with postinstall (esbuild, etc.) need `npm install --ignore-scripts=false <pkg>`.
- **APP_LOCALE=en** despite Indonesian content — **don't use** `__()`/`trans()`, hardcode text in Blade.
- **Font mismatch**: `vite.config.js` loads Instrument Sans via Bunny CDN, but Blade layouts load Poppins from Google Fonts. Vite font setup is unused in views.
- **CV upload**: `$request->file('cv')->store('cv', 'public')` → `storage/app/public/cv/`. Requires `storage:link`.
- **PesanKontak**: controller validates `tujuan => required|in:cs` only. Migration has `jual`/`beli`/`cs` enum — **don't activate** dormant branches.
- **Produk index**: filters `where('kategori', '!=', 'Konten Digital')`. 4 sub-kategori methods bypass this with hardcoded categories.
- **Admin CRUD**: `->except(['show'])` for Produk, Berita, Lowongan, KontenDigital. Pelamar = read-only (index/destroy). Pesan = index/show/destroy.
- **`storage:link` not in `composer setup`** — must be run manually.
- **`resources/js/app.js`**: empty, no JS framework.
- **`backup-desain-lama/` & `screenshot-figma/`**: design assets, not application code.
- **`PROFIL_PERUSAHAAN.md`**: company profile in Indonesian (vision, mission, structure, contacts).
- **`.opencode/opencode.json`**: has Figma MCP (`figma-developer-mcp` with API key).

## Testing

- `phpunit.xml`: `APP_ENV=testing`, SQLite `:memory:`, array cache/mail/session, sync queue.
- 3 files: `TestCase` (base), `Unit/ExampleTest`, `Feature/ExampleTest`. Feature tests use `RefreshDatabase`.
