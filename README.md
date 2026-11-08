# Corner Store POS (IT0049 - TFA7)

A small Laravel POS with four pages: Landing (`/`), About (`/about`), Customer Accounts (`/customers`) and User Accounts (`/users`), plus create and edit forms for both (`/customers/create`, `/users/create`, and `/customers/{id}/edit`, `/users/{id}/edit`). The two account pages now read their data from a database through Eloquent models (TFA6), and the forms add validation and avatar upload (TFA7). Migrations create the `customers` and `users` tables and seeders fill them with sample data.

## What you need

PHP 8.3 or newer (XAMPP has it), Composer, and Git.

## How to run it

1. Clone the repo and open the folder: `git clone <your-repo-url>` then `cd <folder-name>`
2. Install packages: `composer install`
3. Create your environment file: `copy .env.example .env` on Windows, or `cp .env.example .env`
4. Generate the app key: `php artisan key:generate`
5. Link the public storage folder (needed so uploaded avatars can be displayed): `php artisan storage:link`
6. Create the tables and sample data: `php artisan migrate --seed` (with the default SQLite setting, answer **yes** if Artisan offers to create `database/database.sqlite`). For MySQL, set `DB_CONNECTION=mysql` and the `DB_*` values in `.env` first.
7. Start the server: `php artisan serve`
8. Visit http://127.0.0.1:8000

## Database

- `customers`: id, full_name, email, phone, timestamps
- `users`: id, username (unique), full_name, avatar (nullable, stores a path such as `avatars/<uuid>.webp`), timestamps

Migrations are in `database/migrations`, seeders in `database/seeders` (CustomerSeeder, UserSeeder), models in `app/Models` (Customer, User). To rebuild everything from scratch: `php artisan migrate:fresh --seed`.

## Forms, validation and avatars (TFA7)

- Customer: `full_name` required, `email` required and valid, `phone` optional.
- User: `username` required and unique, `full_name` required.
- Avatar (user Edit page only): must be a JPG, PNG or WebP image no larger than 2 MB. The upload is cropped to a 200x200 WebP thumbnail with Laravel's image API (powered by Intervention Image, GD driver), saved with `Storage::disk('public')`, and only its path (e.g. `avatars/<uuid>.webp`) is stored in `users.avatar`. Users without an avatar show `public/images/avatar-placeholder.svg`.
- The image feature needs the PHP **GD** extension and the `intervention/image` package (already listed in `composer.json`, so `composer install` installs it). Make sure `extension=gd` is enabled in `php.ini` (XAMPP: `C:\xampp\php\php.ini`)..

## Where things are

Routes are in `routes/web.php`. Controllers are in `app/Http/Controllers` (PageController, CustomerController, UserController). Blade views are in `resources/views`, with the shared layout in `layouts/app.blade.php`.

## Live site

<your-hosted-url>
