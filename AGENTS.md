# AGENTS.md — PT. Johen Sukses Abadi (Johen Gaming)

## Stack

Laravel 13 + Blade + Tailwind CSS 4 (`@tailwindcss/vite`) + Vite.
PHP ^8.3, SQLite (dev & test). Konten Indonesia (tidak ada `lang/`).

## Commands

| Command | Notes |
|---------|-------|
| `composer setup` | Install dep, copy `.env`, key:generate, migrate --force, `npm install --ignore-scripts`, `npm run build` |
| `composer dev` | `php artisan serve` + `queue:listen` + `pail` + Vite concurrently (color-coded) |
| `composer test` | `config:clear` then `php artisan test` |
| `npm run dev` | Vite only |
| `./vendor/bin/pint` | PSR-12 formatter, no config |
| `php artisan db:seed` | Run after migrate (admin: `admin@johengaming.com` / `Johen2025!`) |
| `php artisan storage:link` | Required for CV upload & image visibility |

## Architecture

- **Admin**: prefix `/johen-admin-secret`, name `admin.*`. Bare Laravel auth (no Breeze/Jetstream). Logout **must** be POST + `@csrf`.
- **14 public routes**: home, tentang, produk index, 4 sub-kategori (`top-up`, `joki-ml`, `jual-beli-akun`, `live-commerce`), berita index+show, karir GET+POST, konten-digital, kontak GET+POST.
- **Layouts**: public = `layouts.app` → `partials.header` + `partials.footer`; admin = `admin.layout`. Both use inline `<style>` + Poppins (Google Fonts).
- **7 Models**: `User` (only one with factory), `Produk`, `Berita`, `Lowongan`, `Pelamar`, `PesanKontak`, `KontenDigital`. Scopes: `Aktif()` on 4 content models, `Unggulan()` on Produk & KontenDigital.
- **Seeder**: hardcoded content. Produk & KontenDigital sorted by `urutan` column.
- **Paginator**: custom `vendor.pagination.simple` (prev/next) via `AppServiceProvider`.
- **Email**: `emails.notif_kontak` with dormant `jual`/`beli` branches (unused — migration schema also has `jual|beli|cs` but controller only allows `cs`).
- **Tailwind v4**: config via `resources/css/app.css` (`@import 'tailwindcss'` + `@source` directives), no `tailwind.config.js`.
- **No CI**.

## Gotchas

- **`.npmrc`**: `ignore-scripts=true` — adding packages with postinstall (esbuild, etc.) needs `npm install --ignore-scripts=false <pkg>`.
- **`.env.example`**: `DB_CONNECTION=sqlite`, `SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`, `MAIL_MAILER=log`, `APP_LOCALE=en`.
- **APP_LOCALE=en** despite Indonesian content — **don't use** `__()`/`trans()`, hardcode text in Blade.
- **CV upload** (`karir.lamar`): `$request->file('cv')->store('cv', 'public')` → `storage/app/public/cv/`. Requires `storage:link`.
- **PesanKontak**: controller validates `tujuan => required|in:cs` only. Migration has `jual`/`beli`/`cs` enum but those values & email branches are dormant — **don't activate**.
- **Produk sub-kategori**: 4 controller methods (`topUp`, `jokiMl`, `jualBeliAkun`, `liveCommerce`), all use `produk-kategori.blade.php`.
- **Admin CRUD**: `->except(['show'])` for Produk, Berita, Lowongan, KontenDigital. Pelamar = read-only (index/destroy). Pesan = index/show/destroy.
- **`backup-desain-lama/` & `screenshot-figma/`**: design assets, not application code.
- **`.opencode/opencode.json`**: has Figma MCP configured (`figma-developer-mcp` with an API key).
- **`resources/js/app.js`**: empty (`//`), no JS framework.
- **No `storage:link`** in `composer setup` — must be run manually after setup.

## Testing

- `phpunit.xml`: `APP_ENV=testing`, SQLite `:memory:`, array cache/mail/session, sync queue.
- 2 test skeletons. Feature tests use `RefreshDatabase`.
