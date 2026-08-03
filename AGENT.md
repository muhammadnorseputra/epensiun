# AGENT — epensiun (SIMPUN)

CodeIgniter 3. Laravel-style agent contract for this repo. Follow all rules unless user overrides.

## Stack
- **PHP** ≥ 5.2.7 (runtime targets PHP 8.x); CodeIgniter 3.1 (legacy `system/` + `index.php`).
- **MySQL** backend; local dev: `host=127.0.0.1 db=epensiun user=root`. Production: `host=localhost db=simpun_bkpsdm user=simpun_bkpsdm` (host-switch in `application/config/database.php`).
- **REST API** provided by `chriskacerguis/codeigniter-restserver` (see `application/controllers/api/`).
- **External API** `silka.balangankab.go.id` (SILKa Online / SSO) consumed via Guzzle + JWT (see `application/config/api.php`). Secrets: `BASE_API_URL`, `BASE_API_PATH`, `X-API-KEY`, `SECRET_KEY` — never commit `.env`.
- **Composer**: deps in `vendor/`; lock excluded by `.gitignore` → **never edit `composer.json` without running `composer install` / `composer dump-autoload`**; check `vendor/` exists before importing classes.
- **Frontend**: Bootstrap 5; assets in `template/assets/`; views in `application/views/`; master layout `application/views/layouts/app.php`.

## Project purpose (domain)
SIMPUN = Sistem Informasi Pengelolaan Usulan Pensiun. App handles **usulan pensiun ASN/PNS/PPPK** workflow:
- Create submission (5 jenis: bup, jadu, aps, udzur, mpp) → Inbox (SKPD → CETAK_USUL → KIRIM_USUL → BKPSDM verify → TTD_SK → SELEPAI approve → ARSIP).
- Dual auth: SSO (OAuth 2 / `oauth/` + `callback`) **or** local login (`auth/cek_akun`, legacy `authv0/authv1` views).
- Session holds: `nip, nama_lengkap, level (ADMIN|USER), unker, unker_id, access_token`. Auth gate via `AuthCheck` hook (CI hooks enabled in `config.php`).

## Architecture — what lives where
| Layer | Files (globs) | Notes |
|---|---|---|
| Front controller | `index.php` | CI bootstrap; env via `CI_ENV`. |
| Config | `application/config/*.php` | `config.php`, `database.php` (host-switch + session=db), `api.php` (external creds), `routes.php` (see Routes below), `autoload.php` (libs: db,session,form_validation,pagination; helpers + `api` config), `hooks.php` (AuthCheck in `post_controller_constructor`). |
| Controllers | `application/controllers/*.php` + `app/*.php` + `api/*.php` | `Auth`, `Oauth`, `Callback`, `CekStatus` (public, no auth); `app/*` (Dashboard, Pensiun, Inbox, Verifikasi, Arsip, Referensi, Laporan — auth-gated by hook); `api/TrackingUsul` (REST, RESTServer). |
| Models | `application/models/*.php` | One model per bounded context: `ModelPensiun` (core CRUD+chart queries, shared by Pensiun/Dashboard), `ModelPensiunInbox` (Inbox tables+datatables+arsip ops), `ModelPensiunVerifikasi` (admin verify tables), `ModelArsip` (archived), `ModelApi` (statistik), `ModelLaporan`. |
| Helpers | `application/helpers/*_helper.php` | 12 files. Autoloaded. `apiclient`, `tgl_indo`, `tgl_sql`, `pegawai`, `nominal`, `security`, `rand`, `tagscript`, `sensor`, `statususul`, `baseurl`, `My_error`. |
| Hooks | `application/hooks/` | `AuthCheck` — gates non-public controllers against session + CSRF. |
| Views | `application/views/**.php` (`pages/`, `pra-berkas/`, `layouts/`, `errors/`) | Master layout + per-page content injected via `$content`. |
| DB migration | `db/` | Seed SQL lives here (authoritative schema source — check before altering tables). |
| API key/secret | `.env` (excluded), `api.php` (committed) | `.env` holds env override; `.env` is secret — do NOT read/modify unless explicitly asked. Config defaults committed in `api.php`. |

## Routes
From `application/config/routes.php`:
- `login` → `auth/login`
- `oauth/sso/authorize` → `oauth/authorize`
- `oauth/sso/callback` → `oauth/callback`
- `oauth/sso/logout` → `oauth/logout`
- `default_controller` → `auth` (root `/` = login page).

## Conventions — match these exactly
- **Code style**: PSR-2-ish, tabs for indentation inside CI files; `function name()` style (no return-type decl); `defined('BASEPATH') or exit(...)`.
- **Models**: extend `CI_Model`; method names lowercase_snake (e.g. `cekusulasn`, `JmlByUsulInbox`). CI-style `$this->db->select`/`.from`/`.where`/`.join`; return `$this->db->get()` result objects (not `->result()`).
- **Controllers**: extend `CI_Controller`; load models in `__construct` via `$this->load->model(['Name' => 'alias'])`. Auth-gated controllers (Verifikasi, Arsip, Referensi, Laporan) enforce `$this->session->userdata('level') !== 'ADMIN'` at top of `__construct`.
- **Auth**: session keys exact — `nip`, `level`, `unker_id`, `access_token`, `csrf_token`. `AuthCheck::check_login` runs as hook on every request; public controllers whitelist in `application/hooks/AuthCheck.php` (`$allowed_controllers`). Never bypass.
- **API**: REST via `$this->response([...], RestController::HTTP_*)`. Helpers use `postApi(...)`/`httpclient(...)` from `apiclient_helper.php`. Always validate `$nip` input (numeric + length 18).
- **External API pattern**: construct Guzzle `Client` with `base_uri = $ci->config->item('BASE_API_URL').'/'.BASE_API_PATH`, headers `['apiKey' => ..., 'Authorization' => 'Bearer '.$access_token, 'Content-Type' => ...]`, 5s timeout. Catch `GuzzleHttp\Exception\RequestException`, decode JSON, echo `$result->getBody()`.
- **Dates**: `formatToSQL()` / `date_indo()` / `formatToSQLDateTime()` helpers — no raw `date()`.
- **Responses**: JSON status shape is `{"status": bool, "message": "...", "redirect": "..."}`; echo `json_encode($msg)`.

## Data layer facts (gleaned from models)
Core tables: `usul` (usulan pendaftaran — nip, nama, token, is_status, golru, jabatan, unit_kerja, tgl_lahir, tmt_pensiun, url_berkas|photo|sk, timestamps, verify/approve/arsip_by+at), `usul_pengantar` (pengantar surat — token, nomor, tanggal, fid_jenis_usul, is_status, created_by_unorid), `usul_jenis` (lookup id→nama/keterangan/kelompok/is_aktif), `ci_sessions` (DB sessions).

Status machine: `SKPD` → (`CETAK_USUL` | `KIRIM_USUL`) → `BKPSDM` → `TTD_SK` → `SELEPAI` → (`SELEPAI_ARSIP` | reverted via `UnArsip`). Reject branch: `SELEPAI_TMS` / `SELEPAI_BTL`.

## Environment & tooling
- `ENVIRONMENT` set in `index.php` (default: development). Local dev runs at `localhost:5001` or `192.168.2.102` (DB host-switch targets these via `$_SERVER['HTTP_HOST']`).
- `.env` exists at repo root but is excluded & secret — agent **never** reads or modifies `.env` (use `api.php` config instead). `api.php` holds committed config defaults including `SECRET_KEY`.
- `vendor/` committed-excluded (`.gitignore: /vendor/`) — after any `composer.json` change run `composer install` in `/Users/putrabungsu/Project/epensiun` (Composer 2.x / PHP 8).
- CI hooks enabled (`$config['enable_hooks'] = TRUE`); `AuthCheck` fires in `post_controller_constructor`.
- Frontend assets via CDN (select2) or local `template/assets/libs/`; DataTables only on `inbox|verifikasi|arsip` pages.
- Helpers autoloaded: `pegawai, html, nominal, url, form, number, tgl_indo, rand, security, cookie, apiclient, tgl_sql, sensor, baseurl, tagscript, date, my_error`.

## Key paths (reference, not commit targets)
- Project: `/Users/putrabungsu/Project/epensiun/` (branch: master → origin/master).
- Local DB (dev): connection `127.0.0.1`, db `epensiun`, user `root`.
- Production DB switch in `application/config/database.php` lines 97-118 (host `simpun_bkpsdm`).
- External SILKa API: `http://silka.balangankab.go.id/services/v2/`.
- `.env` — SECRET, do not read/edit (excluded by design; use `api.php` config for any overrides).

## Workflow (for agent edits)
1. **Locate**: use `search_files` for symbols; read `database.php` for table config; check `db/` for schema diffs.
2. **Edit**: prefer `patch` over `write_file`; keep PSR-2 + CI conventions (tabs, lowercase methods).
3. **After changing `composer.json`**: run `composer install` (never assume vendor present).
4. **After editing models/controllers**: run `php -l <file>` for lint (no full test suite committed; phpunit config exists at `tests/travis/sqlite.phpunit.xml`).
5. **DB changes**: check `db/` SQL files first — add migration there if schema changes.
6. **Never touch**: `.env`, `vendor/`, `system/` (CI core), committed `.gitignore`.

## Style notes
- Responses terse by default. Code-first, then 1-line skip note. No decorative emoji.
- Indonesian language accepted & preferred for user-facing text. Technical terms (DB, API, CSRF, JWT, NIP) kept verbatim.
- Keep edits minimal: YAGNI first — one working line before abstraction.

---
*Generated for epensiun/SIMPUN CodeIgniter 3 codebase. Regenerate after major structural changes.*