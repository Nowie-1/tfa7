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
    {{-- Navigation links to all four pages --}}
    <header>
        <a href="{{ route('landing') }}">Landing</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('customers.list') }}">Customer Accounts</a>
        <a href="{{ route('users.list') }}">User Accounts</a>
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
