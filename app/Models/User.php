<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

// "name" is listed because Breeze's register and profile forms send it.
#[Fillable(['username', 'full_name', 'avatar', 'name', 'email', 'password'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // passwords are always stored hashed
        ];
    }

    protected static function booted(): void
    {
        // Breeze's register form has no username field, so build a unique one from the email.
        static::creating(function (User $user) {
            if (blank($user->username)) {
                $base = Str::slug(Str::before((string) $user->email, '@'), '_') ?: 'user';
                $username = $base;
                $i = 1;

                while (static::where('username', $username)->exists()) {
                    $username = $base . '_' . $i++;
                }

                $user->username = $username;
            }
        });
    }

    /**
     * Breeze reads and writes "name"; this table stores it in full_name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->full_name,
            set: fn ($value) => ['full_name' => $value],
        );
    }

    /**
     * URL of the prepared avatar, or the placeholder image when none was uploaded.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(fn () => $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('images/avatar-placeholder.svg'));
    }
}
