@extends('layouts.app')

@section('content')
    <div class="contact-form">
        <h1 class="form-title">お問い合わせフォーム</h1>

        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.confirm') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="last_name">姓:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>
            <div class="form-group">
                <label for="first_name">名:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
            </div>
            <div class="form-group">
                <label for="gender">性別:</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>選択してください</option>
                    <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="tel">電話番号:</label>
                <input type="tel" name="tel" id="tel" class="form-control" value="{{ old('tel') }}" required>
            </div>
            <div class="form-group">
                <label for="address">住所:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <div class="form-group">
                <label for="building">建物名:</label>
                <input type="text" name="building" id="building" class="form-control" value="{{ old('building') }}">
            </div>
            <div class="form-group">
                <label for="category_id">お問い合わせ種別:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="detail">お問い合わせ内容:</label>
                <textarea name="detail" id="detail" rows="5" class="form-control" required>{{ old('detail') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </form>
    </div>
@endsection
