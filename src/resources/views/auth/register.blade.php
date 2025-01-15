@extends('layouts.app')

@section('content')
    <h1>ユーザー登録</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
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
        <!-- パスワード確認 -->
        <div>
            <label for="password_confirmation">パスワード確認:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">登録する</button>
    </form>
@endsection

@section('styles')
    <style>
        .error {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }
    </style>
@endsection

