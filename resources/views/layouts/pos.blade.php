<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title') | Corner Store POS</title>
    <style>
        body { font-family: Verdana, sans-serif; margin: 0; background: #eef5ee; color: #1b2a1b; }
        header { background: #2e6b3a; padding: 16px 28px; }
        header a { color: #f3fff3; text-decoration: none; margin-right: 22px; }
        header a:hover { text-decoration: underline; }
        header .user { color: #f3fff3; float: right; }
        header .user form { display: inline; }
        .link-btn { background: none; border: 0; color: #f3fff3; cursor: pointer; font: inherit; padding: 0; margin-left: 14px; text-decoration: underline; }
        .btn-danger { background: #b00020; }
        .btn-danger:hover { background: #8c0019; }
        .btn-small { padding: 4px 10px; font-size: 13px; }
        .inline-form { display: inline; }
        .details { margin: 14px 0; }
        .details dt { font-weight: bold; margin-top: 10px; }
        .details dd { margin: 2px 0 0 0; }
        .content { max-width: 920px; margin: 28px auto; background: #ffffff; padding: 24px 30px; border-top: 5px solid #2e6b3a; }
        table { width: 100%; border-collapse: collapse; margin-top: 14px; }
        th, td { border: 1px solid #bcd3bc; padding: 8px 10px; text-align: left; }
        th { background: #dcebdc; }
        .actions { margin: 14px 0; }
        .btn { display: inline-block; background: #2e6b3a; color: #ffffff; padding: 8px 16px; border: 0; border-radius: 4px; text-decoration: none; font-family: inherit; font-size: 14px; cursor: pointer; }
        .btn:hover { background: #245530; }
        .btn-secondary { background: #6b7d6b; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type=text], input[type=email], input[type=file] { width: 100%; padding: 8px; border: 1px solid #bcd3bc; box-sizing: border-box; font-family: inherit; }
        input.input-error { border-color: #b00020; }
        .error { color: #b00020; font-size: 13px; margin-top: 4px; }
        .hint { color: #4b5d4b; font-size: 13px; margin-top: 4px; }
        .flash { background: #dcebdc; border-left: 5px solid #2e6b3a; padding: 10px 14px; margin-bottom: 16px; }
        .avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 1px solid #bcd3bc; vertical-align: middle; }
        .avatar-large { width: 96px; height: 96px; border-radius: 50%; object-fit: cover; border: 1px solid #bcd3bc; display: block; margin-bottom: 8px; }
    </style>
</head>
<body>
    {{-- Navigation: account pages are only linked when logged in --}}
    <header>
        <a href="{{ route('landing') }}">Landing</a>
        <a href="{{ route('about') }}">About</a>
        @auth
            <a href="{{ route('customers.index') }}">Customer Accounts</a>
            <a href="{{ route('users.index') }}">User Accounts</a>
            <span class="user">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                {{ Auth::user()->name }}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="link-btn">Logout</button>
                </form>
            </span>
        @else
            <span class="user">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </span>
        @endauth
    </header>

    <div class="content">
        {{-- One-time success message after create / update --}}
        @if (session('status'))
            <div class="flash">{{ session('status') }}</div>
        @endif

        @yield('body')
    </div>
</body>
</html>
