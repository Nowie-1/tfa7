<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // User Accounts page (/users).
    public function list()
    {
        $users = User::orderBy('id')->get();

        return view('users.index', ['users' => $users]);
    }

    // Show the empty Create User form (/users/create).
    public function create()
    {
        return view('users.create', ['user' => new User()]);
    }

    // Validate the submitted form, then insert the record.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => ['required', 'string', 'max:50', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
        ]);

        User::create($validated);

        return redirect()->route('users.list')
            ->with('status', 'User created successfully.');
    }

    // Show the edit form pre-filled with the existing record.
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    // Validate the form (including the avatar), then update the record.
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            // unique, but ignore this user's own row so saving without changing it works
            'username'  => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'full_name' => ['required', 'string', 'max:255'],
            'avatar'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'avatar.uploaded' => 'The profile picture could not be uploaded. Please choose a file of 2 MB or less.',
            'avatar.image'    => 'The profile picture must be an image file.',
            'avatar.mimes'    => 'The profile picture must be a JPG, PNG or WebP image.',
            'avatar.max'      => 'The profile picture must not be larger than 2 MB.',
        ]);

        $user->username  = $validated['username'];
        $user->full_name = $validated['full_name'];

        if ($request->hasFile('avatar')) {
            $newPath = $this->storeAvatar($request);

            // Remove the previous picture so old files do not pile up.
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $newPath; // only the path is saved in the database
        }

        $user->save();

        return redirect()->route('users.list')
            ->with('status', 'User updated successfully.');
    }

    /**
     * Prepare a display-ready 200x200 WebP copy of the upload and store it on the public disk.
     * Returns the stored path (for example "avatars/<uuid>.webp").
     */
    private function storeAvatar(Request $request): string
    {
        $bytes = $request->image('avatar')
            ->orient()          // fix phone-camera rotation
            ->cover(200, 200)   // crop to a square thumbnail
            ->toWebp()
            ->quality(80)
            ->toBytes();

        $path = 'avatars/' . Str::uuid() . '.webp';

        Storage::disk('public')->put($path, $bytes);

        return $path;
    }
}
