<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Todo')</title> <!-- タイトルの設定 -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css') <!-- 任意で追加のCSS -->
</head>

<body>
    <header class="header">
        <div class="header__inner">
        <a class="header__logo" href="/">
        Todo
        </a>
        <nav class="header__nav">
            <a href="{{ route('login') }}">ログイン</a> <!-- ログインページへのリンク -->
        </nav>
        </div>
    </header>

    <main>
        @yield('content') <!-- 個別ページのコンテンツ -->
    </main>

    <footer>
        <p>© 2025 Todo Application</p>
    </footer>
    </body>
</html>
