<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['username', 'full_name', 'avatar'])]
class User extends Model
{
    /**
     * URL of the prepared avatar, or the placeholder image when none was uploaded.
     * Use it in Blade as $user->avatar_url.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(fn () => $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('images/avatar-placeholder.svg'));
    }
}
