<div class="mypageShare"><p>お友達を紹介して300pt GETする</p></div>


<div class="modal hidden">
    <button class="modal__close" type="button"><span class="modal__close--icon">&times;</span></button>
    <div class="modal__box">
        <div class="shareSnsEmail">
            <h3>SNSやメールで{{-- チケットを --}}シェアする</h3>
            <div class="sns">
                <a href="#" target="_blank"><img src="/img/mypage/ico_facebook.svg" alt=""></a>
                <a href="#" target="_blank"><img src="/img/mypage/ico_line.svg" alt=""></a>
                <a href="#" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a>
                <a href="#" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a>
            </div>
            <form>
                <table>
                    <tr>
                        <th>あなたの招待コードURL</th>
                        <td>
                            <div class="copy">
                                <input type="text" readonly class="url" id="copyInput" value="{{ url('register') . '?introduced_user_id=' . Auth::user()->id}}">
                                <span class="btn" onclick="copy()">コピーする</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>あなたの招待コード</th>
                        <td><input type="text" class="small" value="{{ Auth::user()->userProfile->my_code }}"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="overlayDetail"></div>

<script>
    function copy() {
        // id:copyInput要素を取得
        var urcopyInputl = document.getElementById("copyInput");
        // 取得したcopyInput要素のテキストを選択する
        copyInput.select();
        // テキスト内容全体を選択する
        copyInput.setSelectionRange(0, 99999);
        // 選択されたテキスト内容をクリップボードにコピーする
        document.execCommand("copy");
    }
    </script>