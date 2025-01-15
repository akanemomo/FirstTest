{{-- resources/views/welcome.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            {{-- ログインしている場合 --}}
            <h1>ようこそ、{{ Auth::user()->name }} さん！</h1>
            <p>あなたは現在ログインしています。</p>
            <a href="{{ route('home') }}" class="btn btn-primary">ホームページへ</a>
            <a href="{{ route('logout') }}" class="btn btn-secondary"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            {{-- ログインしていない場合 --}}
            <h1>ようこそ！</h1>
            <p>ログインして、さらに多くの機能を利用できます。</p>
            <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">新規登録</a>
        @endauth
    </div>
@endsection
