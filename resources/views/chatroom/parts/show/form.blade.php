<!-- 入力エリア -->
<form id="form" action="{{ route('chatroom.message', $chatroom->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="item">
            @error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <div class="evaluation">
                <textarea name="text" placeholder="依頼する内容を入力してください" class="templateText"></textarea>
            </div>
            
            @error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
            <div class="btns">

                <p class="chatroom_file_input">資料を添付する</p>
                <input type="file" name="file_path" id="file_path" style="display:none;">
                <input type="hidden" name="file_name" value="">

                <a href="javascript:;" class="templateOpen">定型分を使う</a>

            </div>
            <div class="about mt25">
                <p class="tit">【資料を添付する】について</p>
                <p>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
            </div>
            <div class="cancelTitle">
                <p>送信されたチャットを必要に応じてカリビト確認・削除することに同意し、</p>
            </div>
            <div class="functeBtns">
                <input type="submit" class="orange loading-disabled" value="送信する">
            </div>
        </div>
    </form>

<div class="templatePopup">
    <div class="templateOverlay"></div>
    <div class="templateArea tabSelectArea">
        <div class="templateClose"></div>
        <h2 class="templateTitle">定型文の挿入</h2>
        <div class="templateSelect">
            <select class="tabSelectLinks">
                <option value="#template01">あいさつ１</option>
                <option value="#template02">あいさつ２</option>
                <option value="#template03">あいさつ３</option>
            </select>
        </div>
        <div class="templateBox tabSelectBox is-active" id="template01">
            <textarea readonly>
                お世話になっております。
                一般社団法人日本ビジネスメール協会、●●担当の山田太郎と申します。

                このたびは、●●●●についてお問い合わせいただき
                誠にありがとうございます。

                ご請求いただいた資料は、本日郵送にてお送りいたします。
                今週中にはお手元に届くかと存じます。

                ご確認よろしくお願いいたします。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template02">
            <textarea readonly>あいさつ２あいさつ２あいさつ２あいさつ２あいさつ２</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template03">
            <textarea readonly>あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３</textarea>
        </div>
        <div class="templateButton"><button type="button" class="templateInput">挿入する</button></div>
    </div>
</div>