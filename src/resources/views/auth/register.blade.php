// resources/views/auth/register.blade.php

@extends('layouts.app')

@section('content')
    <main>
        <h1>ユーザー登録</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">お名前:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email">メールアドレス:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password">パスワード:</label>
                <input type="password" name="password" id="password">
                @error('password') <p>{{ $message }}</p> @enderror
            </div>
            <button type="submit">登録</button>
        </form>
    </main>
@endsection
