<!-- 入力エリア -->
<form id="form" action="{{ route('chatroom.message', $chatroom->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="item">
            @error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <div class="evaluation">
                <textarea name="text" placeholder="本文を入力してください" class="templateText" onclick="ClickShowLength(value);" oninput="ShowLength(value);">{{ old('text') }}</textarea>
				<p class="max-string" id="inputlength">{{ mb_strlen(old('text')) }}/3000</p>
            </div>
            
            @error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
            <div class="btns">

                <p class="chatroom_file_input">資料を添付する</p>
                <input type="file" name="file_path" id="file_path" style="display:none;">
                <input type="hidden" name="file_name" value="">

                <a href="javascript:;" class="templateOpen">定型文を使う</a>

            </div>
            <x-parts.file-input/>

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
                <option value="#template01">購入前の問い合わせ（購入者）</option>
                <option value="#template02">購入確認のあいさつ（購入者）</option>
                <option value="#template03">購入確認のあいさつ（出品者）</option>
                <option value="#template04">購入後のあいさつ（購入者）</option>
                <option value="#template05">購入後のあいさつ（出品者）</option>
                <option value="#template06">やりとりが滞ってしまったら</option>
                <option value="#template07">キャンセルについて（購入者）</option>
                <option value="#template08">納品完了メール（出品者）</option>
                <option value="#template09">サービス受取時（納品者）</option>
            </select>
        </div>
        <div class="templateBox tabSelectBox is-active" id="template01">
            <textarea readonly>
            はじめまして。〇〇と申します。　
            ▲▲様が出品されている「□□□」のサービスをお願いしたいと考えております。　
            購入にあたり、下記内容をご確認の程よろしくお願い致します。
            （＊購入後のトラブル防止のため、気になることはしっかりと確認しましょう。）　
            お忙しいところ大変お手数ではございますが、どうぞ宜しくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template02">
            <textarea readonly>はじめまして。
                〇〇と申します。　
                ▲▲様が出品されている「□□□」のサービスを購入したいと思いますので、「サービスの提供」通知を送っていただけますでしょうか。
                届き次第、購入手続きをさせていただきたいと思います。
                どうぞよろしくお願い致します。</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template03">
            <textarea readonly>この度は、数多くあるサービスの中からご連絡いただきまして誠にありがとうございます。
                さっそく「サービス提供」通知をお送りしましたので、購入手続きをお願いいたします。　
                お取引完了まで、どうぞよろしくお願い致します。</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template04">
            <textarea readonly>先ほどサービスを購入させていただきました〇〇です。　
                とても楽しみにしていますので、お取引完了までどうぞよろしくお願い致します。</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template05">
            <textarea readonly>この度はサービスをご購入いただき、誠にありがとうございます。
                お取引完了まで、どうぞよろしくお願い致します。　
                早速ですが、ご依頼内容の詳細を確認させていただきたいので、下記内容を教えてください。
                よろしくお願い致します。
                （＊サービス提供に必要な情報をしっかりとすり合わせましょう。）</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template06">
            <textarea readonly>●日に送らせていただきましたご連絡について、まだご返信をいただけておりませんのでご連絡をさせていただきました。
                現在の状況等、お早目にご連絡をいただければ幸いです。
                お忙しいところ恐縮ではございますが、どうぞよろしくお願い致します。</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template07">
            <textarea readonly>大変申し上げにくいのですが、今回のご依頼の件はキャンセルをお願いしたく存じます。
                キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記する）でございます。
                申請のご確認をお願いします。　</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template08">
            <textarea readonly>サービスを納品させていただきますので、ご確認の程よろしくお願い致します。
                修正箇所や何か確認したい点がございましたら、お手数をおかけしますが「リトライ」を選択し、ご連絡をお願い致します。
                問題がないようでしたら、「承認」を選択していただき、評価にお進みいただけますでしょうか？
                よろしくお願い致します。</textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template09">
            <textarea readonly>サービスの確認をさせていただきました。
                こちらで問題ございませんので、「承認」とさせて頂きます。
                どうもありがとうございます。</textarea>
        </div>
        <div class="templateButton"><button type="button" class="templateInput">挿入する</button></div>
    </div>
</div>

<script>
    // 打ち込んだ文字数の表示
    function ShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }

    // フィールドをクリックしたら文字数の表示
    function ClickShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }
</script>
