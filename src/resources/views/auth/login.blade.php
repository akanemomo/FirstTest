// resources/views/auth/login.blade.php

@extends('layouts.app')

@section('content')
    <main>
        <h1>ログイン</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
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
            <button type="submit">ログイン</button>
        </form>
    </main>
@endsection
