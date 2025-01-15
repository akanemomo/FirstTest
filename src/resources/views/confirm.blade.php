@extends('layouts.app')

@section('content')
    <h1>お問い合わせ内容確認</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (!isset($data['first_name']) || !isset($data['last_name']))
        <p>入力されたデータが正しく読み込まれませんでした。再度お問い合わせフォームを記入してください。</p>
        <a href="{{ route('contacts.index') }}">お問い合わせフォームに戻る</a>
    @else
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf

            <!-- 姓名 -->
            <p>お名前: {{ $data['first_name'] }} {{ $data['last_name'] }}</p>

            <!-- 性別 -->
            <p>性別:
                @if ($data['gender'] == 1)
                    男性
                @elseif ($data['gender'] == 2)
                    女性
                @elseif ($data['gender'] == 3)
                    その他
                @endif
            </p>

            <!-- メールアドレス -->
            <p>メールアドレス: {{ $data['email'] }}</p>

            <!-- 電話番号 -->
            <p>電話番号: {{ $data['tel'] }}</p>

            <!-- 住所 -->
            <p>住所: {{ $data['address'] }}</p>

            <!-- お問い合わせの種類 -->
            <p>お問い合わせの種類: 
                @php
                    $category = \App\Models\Category::find($data['category_id']);
                @endphp
                {{ $category ? $category->content : '不明' }}
            </p>

            <!-- お問い合わせ内容 -->
            <p>お問い合わせ内容: {{ $data['detail'] }}</p>

            <!-- hidden inputs for storing values -->
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">

            <button type="submit">送信する</button>
            <button type="button" onclick="history.back()">修正する</button>
        </form>
    @endif
@endsection
