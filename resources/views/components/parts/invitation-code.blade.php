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
            <td><input type="text" readonly class="small" value="{{Auth::user()->userProfile->my_code}}"></td>
        </tr>
    </table>
</form>
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
