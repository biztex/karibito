<div id="fancybox_register" class="fancyboxWrap">
    <div style="display:flex;justify-content:space-between">
        <a href="#" class="fancyPersonCancel" style="padding-left:10px; font-size:20px;">×</a>
        <p class="fancyboxHd">本人確認</p>
        <div></div>
    </div>
            
        <div class="fancyboxCont">

                @error('identification_path')
                    <div class="alert alert-danger" style="margin:10px auto; font-size:14px;text-align:center;">{{ $message }}</div>
                @enderror

            <div class="fancyRegisterItem">
                <p class="txt">本人確認には、プロフィールの氏名/生年月日/ご住所のご登録が必要です。<br>登録するプロフィール情報と、提出する本人確認の書類の氏名/生年月日/ご住所が一致しているか必ずご確認ください。</p>
                <p class="notice">＊1点でも一致しない場合、申請をお受け出来ませんのでご注意ください。</p>
                <p class="txt">プロフィール編集は<a href="#fancybox_person" class="fancybox colorBlue">こちら</a></p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt"><strong>■本人確認とは</strong><br>本人確認とは、お互いの信頼性を高めるため、本人であることを証明する書類を提出する手続きです。<br>身分証明書が承認されると、プロフィールに本人確認済みマークが表示されます。</p><br>
                <p>また、本人確認が承認されると、プロフィールに「秘密保持契約（NDA)締結可」マークを表示させることができます。このマークを表示させている方同士のチャット画面には、カリビトチャット内で秘密保持契約（NDA)を締結するための「NDAを送付する」ボタンが表示されます。</p><br>
{{--                TODO: 別のガイドページが作成された後、変更する--}}
                <p>「秘密保持契約（NDA）締結可」マークの表示は<a href="{{ route('karibitoguide_nda_mark_show') }}" class="fancybox colorBlue" target="_blank">こちら</a></p>
                <p>秘密保持契約（NDA)の締結は<a href="{{ route('karibitoguide_nda_sign') }}" class="fancybox colorBlue" target="_blank">こちら</a></p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt"><strong>■本人確認に利用できる書類</strong><br>ご本人であることを確認するため、下記の書類のうち一つをご提出ください。</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt"><strong>【個人の場合】</strong><br>・運転免許所<br>・健康保険証/被保険者証<br>・旅券/パスポート<br>・住民票<br>・住人基本台帳カード<br>・外国人証明書<br>・マイナンバーカード</p>
                <p class="notice">＊ご氏名、生年月日、ご住所が記載されているページ全てを添付ください。<br>＊有効期限内の書類をご提出ください。</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt"><strong>【法人の場合】</strong><br>・履歴書事項全部証明書</p>
                <p class="notice">＊3か月以内に取得したものをご提出ください。</p>
            </div>
        </div>
            <div style="margin:0 0 20px 20px;height:10px;"><p class="identification-file-name" style='color:#696969;'></p></div>
            <p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox colorBlue">プロフィール編集はこちら</a></p>
        @if(!empty(Auth::user()->userProfile->zip) && !empty(Auth::user()->userProfile->address) && !empty(Auth::user()->userProfile->birthday))
            <form action="{{ route('identification') }}" method="POST" name="upload" enctype="multipart/form-data">
                @csrf
                <label>
                    <input type="file" name="identification_path" style="display:none;" id="identification_file_path" accept="image/png,image/jpeg,">
                    <p class="fancyRegisterUpload">身分証明書をアップロード</p>
                </label>
                
                <p class="fancyRegisterSubmit"><a href="#" onclick="document.upload.submit()">提出する</a></p>
            </form>

        @else
            <div class="fancyRegisterItem">
                <p class="txt">本人確認にはご住所 / 本名/ 生年月日のご登録が必要です。<br/>本人認証に利用されるものと同じ姓名でご登録ください。<br/>「プロフィール編集はこちら」より、郵便番号・住所の登録をお願いいたします。</p>
            </div>
        @endif
    </div>