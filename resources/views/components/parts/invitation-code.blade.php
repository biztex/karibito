<form>
    <table>
        <tr>
            <th>あなたの招待コードURL</th>
            <td>
                <div class="copy">
                    <input type="text" readonly class="url" id="copyInput" value="https://1111111">
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