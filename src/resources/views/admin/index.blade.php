<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <h1>管理画面</h1>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if ($contact->gender === 1)
                        男性
                    @elseif ($contact->gender === 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <button class="detail-button" data-id="{{ $contact->id }}">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダルウィンドウ -->
    <div id="detailModal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>詳細情報</h2>
            <p>名前: <span id="detailName"></span></p>
            <p>メールアドレス: <span id="detailEmail"></span></p>
            <p>性別: <span id="detailGender"></span></p>
            <p>お問い合わせ種類: <span id="detailCategory"></span></p>
            <p>内容: <span id="detailDetail"></span></p>
            <button id="deleteButton" data-id="">削除</button>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.detail-button');
            const modal = document.getElementById('detailModal');
            const closeBtn = modal.querySelector('.close');
            const deleteBtn = document.getElementById('deleteButton');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // 詳細ボタンクリック
            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const contactId = this.getAttribute('data-id');
                    fetch(`/admin/contact/${contactId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('データ取得エラー');
                            }
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('detailName').textContent = `${data.last_name} ${data.first_name}`;
                            document.getElementById('detailEmail').textContent = data.email;
                            document.getElementById('detailGender').textContent = data.gender === 1 ? '男性' : data.gender === 2 ? '女性' : 'その他';
                            document.getElementById('detailCategory').textContent = data.category.content;
                            document.getElementById('detailDetail').textContent = data.detail;

                            // 削除ボタンにIDをセット
                            deleteBtn.setAttribute('data-id', data.id);

                            // モーダルを表示
                            modal.classList.remove('hidden');
                        })
                        .catch(error => {
                            alert('詳細情報の取得に失敗しました。');
                            console.error(error);
                        });
                });
            });

            // モーダルを閉じる
            closeBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            // 削除ボタンクリック
            deleteBtn.addEventListener('click', function () {
                const contactId = this.getAttribute('data-id');

                fetch(`/admin/contact/${contactId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('削除エラー');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('削除しました。');
                            location.reload();
                        } else {
                            alert('削除に失敗しました。');
                        }
                    })
                    .catch(error => {
                        alert('削除処理に失敗しました。');
                        console.error(error);
                    });
            });
        });
    </script>
</body>
</html>
