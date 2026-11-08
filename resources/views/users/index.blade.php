@extends('layouts.app')

@section('page_title', 'User Accounts')

@section('body')
    <h1>User Accounts</h1>

    <div class="actions">
        <a class="btn" href="{{ route('users.create') }}">+ Add User</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- One table row for each User model retrieved from the database --}}
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{-- avatar_url falls back to the placeholder image when no file was uploaded --}}
                        <img class="avatar" src="{{ $user->avatar_url }}" alt="Avatar of {{ $user->full_name }}">
                    </td>
                    <td>U-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td><a href="{{ route('users.edit', $user) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
