{{-- Shared by create and edit. $user is a new User on create, an existing one on edit. --}}
@php($editing = $user->exists)

<form method="POST" action="{{ $editing ? route('users.update', $user) : route('users.store') }}"
      enctype="multipart/form-data" novalidate>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="username">Username *</label>
        <input type="text" id="username" name="username"
               value="{{ old('username', $user->username) }}"
               class="@error('username') input-error @enderror">
        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="full_name">Full Name *</label>
        <input type="text" id="full_name" name="full_name"
               value="{{ old('full_name', $user->full_name) }}"
               class="@error('full_name') input-error @enderror">
        @error('full_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    @if ($editing)
        <div class="form-group">
            <label for="avatar">Profile Picture</label>
            <img class="avatar-large" src="{{ $user->avatar_url }}" alt="Current avatar of {{ $user->full_name }}">
            <input type="file" id="avatar" name="avatar" accept="image/png,image/jpeg,image/webp"
                   class="@error('avatar') input-error @enderror">
            <div class="hint">JPG, PNG or WebP, up to 2 MB. Leave empty to keep the current picture.</div>
            @error('avatar')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    @else
        <p class="hint">You can add a profile picture after the account is created, from its Edit page.</p>
    @endif

    <button type="submit" class="btn">{{ $editing ? 'Save Changes' : 'Create User' }}</button>
    <a class="btn btn-secondary" href="{{ route('users.list') }}">Cancel</a>
</form>
