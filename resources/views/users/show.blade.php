@extends('layouts.pos')

@section('page_title', 'User Details')

@section('body')
    <h1>User Details</h1>

    <img class="avatar-large" src="{{ $user->avatar_url }}" alt="Avatar of {{ $user->full_name }}">

    <dl class="details">
        <dt>User ID</dt>
        <dd>U-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</dd>
        <dt>Username</dt>
        <dd>{{ $user->username }}</dd>
        <dt>Full Name</dt>
        <dd>{{ $user->full_name }}</dd>
        <dt>Email</dt>
        <dd>{{ $user->email ?: '-' }}</dd>
    </dl>

    <a class="btn" href="{{ route('users.edit', $user) }}">Edit</a>
    <a class="btn btn-secondary" href="{{ route('users.index') }}">Back to list</a>
@endsection
