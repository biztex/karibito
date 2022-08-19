<div id="fancybox_register" class="fancyboxWrap">
    <div style="display:flex;justify-content:space-between">
        <a href="#" class="fancyPersonCancel" style="padding-left:10px; font-size:20px;">×</a>
        <p class="fancyboxHd">身分証明証の登録</p>
        <div></div>
    </div>
            
        <div class="fancyboxCont">

                @error('identification_path')
                    <div class="alert alert-danger" style="margin:10px auto; font-size:14px;text-align:center;">{{ $message }}</div>
                @enderror

            <div class="fancyRegisterItem">
                <p class="txt">「身分証明書を登録する」とは、<br>信頼性を高めるため、本人であることを証明する書類を提出する手続きです。<br>身分証明書が承認されると、プロフィールに身分証明書提出済マークが表示されます。</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="notice">注意事項</p>
                <p class="txt">カリビトアプリのプロフィールで、住所・氏名・生年月日はしっかり記載していますか?<br>身分証明書との一致が確認できないと本人確認はできないのでご注意ください!<br>登録いただいた３営業日以内にご返信します。<br>また、アップロードできる画像形式はJPEG/PNGのみです。</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt">提出可能な本人確認書類は、下記となっております。</p>
                <p class="txt">【個人の場合】<br>運転免許証・健康保険証 / 被保険者証・旅券 / <br>パスポート・住民票・住民基本台帳カード・外国人証明書</p>
                <p class="txt">【法人の場合】<br>履歴事項全部証明書　(※3 ヵ月以内のものに限ります)</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt">【カリビトアプリ登録情報】<br>都道府県:{{ Auth::user()->userProfile->prefecture->name }}<br>住所:{{ Auth::user()->userProfile->address }}<br>氏名:{{ Auth::user()->userProfile->first_name.Auth::user()->userProfile->last_name }}
                                                       <br>生年月日:@if(Auth::user()->userProfile->birthday !== null){{ date("Y年n月j日",strtotime(Auth::user()->userProfile->birthday)) }}@endif</p>
            </div>
            <div class="fancyRegisterItem">
                <p class="txt">安心安全のため、本人確認承認後はご住所 / 本名/ 生年月日のご変更ができなくなっておりますので、本人確認承認後にご住所 / 本名 / 生年月日をご変更されたい場合は、カリビト事務局へ、お問い合わせください</p>
            </div>
        </div>
        <p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集はこちら</a></p>
        @if(!empty(Auth::user()->userProfile->zip) && !empty(Auth::user()->userProfile->address) && !empty(Auth::user()->userProfile->birthday))
            <form action="{{ route('identification') }}" method="POST" name="upload" enctype="multipart/form-data">
                @csrf
                <label>
                    <input type="file" name="identification_path" style="display:none;"  accept="image/png,image/jpeg,">
                    <p class="fancyRegisterUpload">身分証明書をアップロード</p>
                </label>
                
                <p class="fancyRegisterSubmit"><a href="#" onclick="document.upload.submit()">提出する</a></p>
            </form>
        @else
            <div class="fancyRegisterItem">
                <p class="txt">本人確認にはご住所 / 本名/ 生年月日のご登録が必要です。<br/>「プロフィール編集はこちら」より、郵便番号・住所の登録をお願いいたします。</p>
            </div>
        @endif
    </div>