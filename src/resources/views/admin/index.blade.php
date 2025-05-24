<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button type="submit" class="logout" style="background:none; border:none; padding:0; color:#00f; cursor:pointer;">
        logout
    </button>
</form>
    </header>
     

    <main>

        @if (session('success'))
            <p class="alert-success">{{ session('success') }}</p>
        @endif
        <h1>FashionablyLate</h1>
        <h2>Admin</h2>
        <form method="GET" action="{{ route('admin.index') }}" class="search-form">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
            <select name="gender">
                <option value="">性別</option>
                <option value="男性" {{ request('gender' ) == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性"{{ request('gender' ) == '女性' ? 'selected' : '' }}>女性</option>
                <option value="その他"{{ request('gender' ) == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category">
                <option value="">お問い合わせの種類</option>
                <option value="交換" {{ request('category') == '交換' ? 'selected' : '' }}>商品の交換について</option>
                <option value="返品"{{ request('category') == '返品' ? 'selected' : '' }}>商品の返品について</option>
                <option value="返品"{{ request('category') == 'トラブル' ? 'selected' : '' }}>商品トラブルについて</option>
                <option value="返品"{{ request('category') == 'その他' ? 'selected' : '' }}>その他</option>

            </select>
            <input type="date" name="date">
            <button type="submit">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
        </form>
        <div class="export-pagination-wrapper">
    <div class="export-button">
        <form method="GET" action="{{ route('admin.export') }}">
            <button type="submit">エクスポート</button>
        </form>
    </div>
    @if ($contacts->hasPages())
    <div class="custom-pagination">
        {{-- 前へ --}}
        @if ($contacts->onFirstPage())
            <span class="disabled">&laquo;</span>
        @else
            <a href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
            @if ($page ==      $contacts->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
            @endforeach

        {{-- 次へ --}}
            @if ($contacts->hasMorePages())
              <a href="{{ $contacts->nextPageUrl() }}" rel="next">&raquo;</a>
            @else
              <span class="disabled">&raquo;</span>
            @endif
    </div>
@endif
</div>
        

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                  <tr>
                    <td>{{ $contact->fullname }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category }}</td>
                    <td>
                        <button class="detail-btn"
                         data-id="{{ $contact->id }}"
                         data-fullname="{{ $contact->fullname }}"
                         data-gender="{{ $contact->gender }}"
                         data-email="{{ $contact->email }}"
                         data-address="{{ $contact->address }}"
                         data-building="{{ $contact->building_name }}"
                         data-category="{{ $contact->category }}"
                         data-content="{{ $contact->content }}">
                         詳細
                        </button>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </table>

        <!-- モーダルの背景 -->
<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>

        <h3>お問い合わせ詳細</h3>
        <table class="detail-table">
            <tr><th>お名前</th><td id="modal-name"></td></tr>
            <tr><th>性別</th><td id="modal-gender"></td></tr>
            <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
            <tr><th>電話番号</th><td id="modal-tel"></td></tr>
            <tr><th>住所</th><td id="modal-address"></td></tr>
            <tr><th>建物名</th><td id="modal-building"></td></tr>
            <tr><th>お問い合わせ種類</th><td id="modal-category"></td></tr>
            <tr><th>内容</th><td id="modal-content"></td></tr>
        </table>

        

        <form method="POST" action="" id="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">削除</button>
        </form>
    </div>
</div>



        <div id="detailModal" class="modal" style="display: none;">
        <div class="modal-content">
        <span class="close">&times;</span>
        <h3>お問い合わせ詳細</h3>
        <p><strong>お名前：</strong> <span id="modal-fullname"></span></p>
        <p><strong>性別：</strong> <span id="modal-gender"></span></p>
        <p><strong>メールアドレス：</strong> <span id="modal-email"></span></p>
        <p><strong>住所：</strong> <span id="modal-address"></span></p>
        <p><strong>建物名：</strong> <span id="modal-building"></span></p>
        <p><strong>お問い合わせの種類：</strong> <span id="modal-category"></span></p>
        <p><strong>お問い合わせ内容：</strong> <span id="modal-content"></span></p>

        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">削除</button>
        </form>
    </div>
</div>

    </main>

    <script>
    document.querySelectorAll('.detail-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('modal-fullname').textContent = this.dataset.fullname;
            document.getElementById('modal-gender').textContent = this.dataset.gender;
            document.getElementById('modal-email').textContent = this.dataset.email;
            document.getElementById('modal-address').textContent = this.dataset.address;
            document.getElementById('modal-building').textContent = this.dataset.building;
            document.getElementById('modal-category').textContent = this.dataset.category;
            document.getElementById('modal-content').textContent = this.dataset.content;

            // 削除フォームのaction設定
            document.getElementById('deleteForm').action = '/admin/' + this.dataset.id;

            // モーダル表示
            document.getElementById('detailModal').style.display = 'block';
        });
    });

    // 閉じる処理
    document.querySelector('.close').addEventListener('click', function () {
        document.getElementById('detailModal').style.display = 'none';
    });

    // モーダル外をクリックしたら閉じる
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('detailModal');
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
</script>


</body>
</html>


