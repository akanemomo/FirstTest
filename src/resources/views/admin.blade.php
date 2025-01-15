@extends('layouts.app')

@section('content')
    <h1>管理画面</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('admin.search') }}" method="GET">
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ request()->name }}">
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="text" name="email" id="email" value="{{ request()->email }}">
        </div>
        <div>
            <label for="gender">性別:</label>
            <select name="gender" id="gender">
                <option value="">性別</option>
                <option value="1" {{ request()->gender == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request()->gender == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request()->gender == '3' ? 'selected' : '' }}>その他</option>
            </select>
        </div>
        <div>
            <label for="category_id">お問い合わせの種類:</label>
            <select name="category_id" id="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="date">日付:</label>
            <input type="date" name="date" id="date" value="{{ request()->date }}">
        </div>
        <button type="submit">検索</button>
        <button type="reset" onclick="window.location.href='{{ route('admin.index') }}'; return false;">リセット</button>

    </form>

    <h2>検索結果</h2>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせの種類</th>
                <th>日付</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button data-toggle="modal" data-target="#contactModal{{ $contact->id }}">詳細</button>
                        <form action="{{ route('admin.delete', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>

                <!-- モーダルウィンドウ -->
                <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>名前:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
                                <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                                <p><strong>性別:</strong> {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</p>
                                <p><strong>お問い合わせの種類:</strong> {{ $contact->category->content }}</p>
                                <p><strong>お問い合わせ内容:</strong> {{ $contact->detail }}</p>
                                <p><strong>日付:</strong> {{ $contact->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $contacts->links() }}
    </div>
@endsection

