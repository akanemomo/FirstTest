document.addEventListener('DOMContentLoaded', function () {
    // モーダルウィンドウとその要素を取得
    const modal = document.getElementById('detailModal');
    const closeButton = modal.querySelector('.close'); // モーダルの閉じるボタン
    const deleteButton = document.getElementById('deleteButton'); // 削除ボタン
    let currentContactId = null; // 現在選択中のコンタクトID
    let currentRow = null; // 削除対象の行

    // モーダルウィンドウが最初に表示されないようにする
    modal.style.display = 'none'; // 初期状態では非表示に設定

    // 詳細ボタンのクリックイベントを設定
    const detailButtons = document.querySelectorAll('.detail-button');
    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            const contactId = this.getAttribute('data-id');
            currentContactId = contactId;
            currentRow = this.closest('tr'); // ボタンの親行を取得

            // Ajaxでサーバーから詳細情報を取得
            fetch(`/admin/contact/${contactId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('データの取得に失敗しました');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        alert('データが見つかりません');
                    } else {
                        // 取得したデータをモーダルに表示
                        document.getElementById('detailName').textContent = data.last_name + ' ' + data.first_name;
                        document.getElementById('detailEmail').textContent = data.email;
                        document.getElementById('detailGender').textContent = data.gender === 1 ? '男性' : data.gender === 2 ? '女性' : 'その他';
                        document.getElementById('detailCategory').textContent = data.category.content;
                        document.getElementById('detailDetail').textContent = data.detail;

                        // モーダルを表示
                        modal.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('エラー:', error);
                    alert(error.message);
                });
        });
    });

    // モーダルウィンドウを閉じる処理（×ボタン）
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none'; // モーダルを非表示に
    });

    // モーダル外をクリックしても閉じる処理
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none'; // モーダルを非表示に
        }
    });

    // 削除ボタンがクリックされたときの処理
    deleteButton.addEventListener('click', function () {
        if (currentContactId !== null && currentRow !== null) {
            // 削除ボタンを無効化して、二重にクリックできないようにする
            deleteButton.disabled = true;

            // 削除リクエストを送る
            fetch(`/admin/contact/${currentContactId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    // 削除に失敗した場合のエラーハンドリング
                    throw new Error('削除に失敗しました');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // 削除成功時の処理
                    modal.style.display = 'none'; // モーダルを非表示に
                    currentRow.remove(); // 該当の行をDOMから削除
                    alert('データが削除されました'); // 一度だけアラートを表示
                } else {
                    // 成功フラグが false の場合
                    alert('削除に失敗しました');
                }
            })
            .catch(error => {
                // 削除リクエストでエラーが発生した場合
                console.error('エラー:', error);
                alert(error.message);
            })
            .finally(() => {
                // 削除処理が完了したら削除ボタンを再度有効化
                deleteButton.disabled = false;
            });
        }
    });
});
