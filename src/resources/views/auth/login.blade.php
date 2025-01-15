@extends('layouts.app')

@section('content')
    <h1>ログイン</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">ログインする</button>
    </form>
    <p>まだアカウントをお持ちでないですか？ <a href="{{ route('register') }}">登録</a></p>
@endsection
