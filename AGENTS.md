# AGENTS.md

## Stack

Laravel 13 + Blade + Tailwind CSS 4 (via `@tailwindcss/vite`) + Vite.  
PHP ^8.3, SQLite (dev & test), MySQL optional.  
No frontend framework. Indonesian content.

## Commands

| Command | What it does |
|---------|-------------|
| `composer setup` | Full first-time setup: install deps, copy `.env`, `key:generate`, `migrate --force`, `npm install --ignore-scripts`, `npm run build` |
| `composer dev` | Runs 4 concurrently: `php artisan serve`, `queue:listen --tries=1 --timeout=0`, `pail --timeout=0`, `npm run dev` |
| `composer test` | `php artisan config:clear` then `php artisan test` (SQLite in-memory) |
| `npm run dev` | Vite dev server only (Blade hot reload) |
| `npm run build` | Vite production build |
| `./vendor/bin/pint` | Laravel Pint (PSR-12, no config file) |

## Architecture

- **Admin panel**: `/johen-admin-secret` (obfuscated, `routes/web.php:32`). Has its own layout (`admin.layout`).
- **Entrypoints**: `public/index.php` (app), `resources/css/app.css` + `resources/js/app.js` (Vite inputs; `js/app.js` is empty).
- **Fonts**: public layout (`layouts/app`) and admin layout (`admin/layout`) both use inline `<style>` and import **Poppins** directly from Google Fonts — NOT the `bunny()`-served 'Instrument Sans' set in `app.css`/Vite config.
- **Public layout**: `resources/views/layouts/app.blade.php` — all public Blade templates extend it.
- **Layouts**: both public and admin use inline `<style>` blocks with CSS variables, not Tailwind utility classes in templates. `app.css` uses Tailwind v4 syntax (`@import 'tailwindcss'`, `@source`, `@theme`).
- **Logo**: `{{ asset('img/logo/johen_logo.png') }}` in header partial.
- **Models** (7): `User`, `Produk`, `Berita`, `Lowongan`, `Pelamar`, `PesanKontak`, `KontenDigital`. Only `User` has a factory (`UserFactory.php`).
- **Model scopes**: `scopeAktif()` on `Produk`, `Berita`, `Lowongan`, `KontenDigital`. `scopeUnggulan()` on `Produk` and `KontenDigital`.
- **Berita model**: custom `generateSlug()` static method, computed `getRingkasanAttribute()` (strip_tags + Str::limit 150).
- **Admin controllers**: `App\Http\Controllers\Admin\*`. Auth is plain Laravel (no Breeze/Jetstream). Logout is POST-only with CSRF.
- **Seeder** (`DatabaseSeeder.php`) creates admin user (`admin@johengaming.com` / `Johen2025!`) + hardcoded content for all content models.
- **Paginator**: custom view at `vendor.pagination.simple` set in `AppServiceProvider`.
- **Email**: notification template at `emails.notif_kontak`. Failure is silently caught (empty `catch`).

## Key patterns

- **Kontak form**: single CS form (`tujuan = cs` hidden input). Controller validates `tujuan => required|in:cs`. The email template `notif_kontak.blade.php` still has stale `jual`/`beli` branches that are unreachable with current validation — left as-is, but don't reintroduce jual/beli validation unless the template is also updated.
- **CV uploads**: `$request->file('cv')->store('cv', 'public')` → `storage/app/public/cv/`. Requires `php artisan storage:link`.
- **Composer `setup` auto-copies `.env.example` → `.env`** if missing (via `post-root-package-install` and the setup script itself).
- **Admin routes** use resource controllers `->except(['show'])` for Produk, Berita, Lowongan, KontenDigital. Pelamar and Pesan are read-only (index + destroy; Pesan also has show).

## Gotchas

- **`.npmrc`**: `ignore-scripts=true`. Adding packages with postinstall scripts (e.g. `esbuild`) needs `npm install --ignore-scripts=false <pkg>`.
- **`.env.example` defaults**: `DB_CONNECTION=sqlite`, `SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`.
- **APP_LOCALE**: defaults to `en` (not set in `.env.example`) despite all content being Indonesian.
- **Vite fonts**: `bunny()` CDN for 'Instrument Sans' is configured but **unused** — both layouts use Poppins via direct Google Fonts link.
- **Asset paths**: logo loaded from `public/img/logo/johen_logo.png`, hero backgrounds from `public/img/bg/bg1.jpeg` etc. These are gitignored in default Laravel setup — verify they exist after clone.

## Testing

- `phpunit.xml` forces `APP_ENV=testing`, SQLite `:memory:`, array cache/mail/session, sync queue.
- `RefreshDatabase` trait used in `Feature\ExampleTest.php`.
- Only 2 example tests exist (`Feature/ExampleTest.php`, `Unit/ExampleTest.php`).
- Order: always `config:clear` before running tests (`composer test` does this).
