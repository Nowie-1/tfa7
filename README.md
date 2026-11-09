# Corner Store POS (IT0049 - TFA8)

Laravel POS app with a database (TFA6), create/edit forms and avatar upload (TFA7), and
resource controllers with Laravel Breeze authentication (TFA8).

## Pages
- Public: Landing (`/`), About (`/about`), Login (`/login`), Register (`/register`)
- Login required: Dashboard (`/dashboard`), Customer Accounts (`/customers`), User Accounts (`/users`)
  and their create, show, edit and delete pages. Visiting a protected page while logged out redirects to `/login`.

## Requirements
PHP 8.3+ with the GD extension, Composer, Node.js and npm, and MySQL (or SQLite for quick local runs).

## Setup
1. Clone the repository and open the folder.
2. `composer install`
3. Copy `.env.example` to `.env`, then `php artisan key:generate`
4. For MySQL, set `DB_CONNECTION=mysql` and the `DB_*` values in `.env` (SQLite works with the defaults; answer **yes** if Artisan offers to create `database/database.sqlite`).
5. `php artisan storage:link` (needed so uploaded avatars can be displayed)
6. `php artisan migrate --seed`
7. `npm install` then `npm run build` (builds the Breeze login/register styles; use `npm run dev` while developing)
8. `php artisan serve`, then open http://127.0.0.1:8000

## Logging in
Click **Register** to create an account (full name, email, password). The seeded sample users have no
email or password, so they cannot log in; they are only records shown on the User Accounts page.

## Routing and authentication
- `Route::resource('customers', CustomerController::class)` and `Route::resource('users', UserController::class)` map the standard
  index, create, store, show, edit, update and destroy methods.
- Both resources (and the dashboard and profile pages) sit inside `Route::middleware('auth')->group(...)` in `routes/web.php`.
- Authentication was scaffolded with Laravel Breeze (Blade stack). Its routes are in `routes/auth.php`.
- Breeze expects `name`, `email` and `password`. The POS `users` table keeps `username` and `full_name`, so `User` maps
  `name` to `full_name` and generates a unique `username` from the email when someone registers. Passwords are hashed by Laravel's default `hashed` cast.

## Database
- customers: id, full_name, email, phone, timestamps
- users: id, username (unique), full_name, avatar, email (unique, nullable), email_verified_at, password (nullable), remember_token, timestamps

Rebuild everything with `php artisan migrate:fresh --seed`.

## Avatars
Avatar upload (user Edit page): JPG, PNG or WebP up to 2 MB, cropped to a 200x200 WebP with Laravel's image API
(Intervention Image, GD driver), stored with `Storage::disk('public')`; only the path is saved in `users.avatar`.

## Live demo
<paste your hosted URL here>
