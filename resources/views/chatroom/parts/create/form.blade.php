<!-- 入力エリア -->
@if($service_type === 'Product')
    <form id="form" action="{{ route('chatroom.create.product', $service->id) }}" method="POST" enctype="multipart/form-data">
@else <!-- JobRequest-->
    <form id="form" action="{{ route('chatroom.create.job_request', $service->id) }}" method="POST" enctype="multipart/form-data">
@endif
        @csrf
        <div class="item">
            @error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <div class="evaluation">
                <textarea id="templateText" name="text" placeholder="本文を入力してください" class="templateText" onkeyup="ShowLength(value);"></textarea>
				<p class="max-string" id="inputlength">{{ mb_strlen(old('text')) }}/3000</p>
            </div>

            @error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
            <div class="btns">
                <div>
                    <p class="chatroom_file_input">資料を添付する</p>
                    <input type="file" name="file_path" id="file_path" style="display:none;">
                    <input type="hidden" name="file_name" value="">
                </div>
                <div>
                    <a href="javascript:;" class="templateOpen">定型文を使う</a>
                </div>
                <div>
                    <a href="#" onclick="insertProfile()">プロフィールを送付する</a>
                </div>
                <div>
                    <a href="https://codeforfun.jp/tools/estimate/" target="_blank">見積書を作成する（外部リンク）</a>
                </div>
                @if(!empty($service->user->userProfile->is_identify) && !empty(Auth::user()->userProfile->is_identify)
                && !empty($service->user->userProfile->is_nda) && !empty(Auth::user()->userProfile->is_nda))
                <div>
                    <a href="javascript:;" class="templateNDAOpen">NDAを送付する</a>
                    <a href="{{route('karibitoguide_nda_sign')}}" target="_blank" class="ndaWrapper">NDA締結前に必ずご確認ください</a>
                </div>
                @endif
            </div>
            <div class="cancelTitle">
                <p>送信されたチャットを必要に応じてカリビトが確認・削除することに同意します。</p>
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
                <option value="#template01">購入前の問い合わせ（購入者）▼</option>
                <option value="#template02">購入確認のあいさつ（購入者）▼</option>
                <option value="#template03">購入確認のあいさつ（出品者）▼</option>
                <option value="#template04">購入後のあいさつ（購入者）▼</option>
                <option value="#template05">購入後のあいさつ（出品者）▼</option>
                <option value="#template06">やりとりが滞ってしまったら▼</option>
                <option value="#template10">キャンセルについて（購入者）▼</option>
                <option value="#template07">キャンセルについて（出品者）▼</option>
                <option value="#template08">納品完了メール（出品者）▼</option>
                <option value="#template09">サービス受取時（購入者）▼</option>
            </select>
        </div>
        <div class="templateBox tabSelectBox is-active" id="template01">
            <textarea readonly> {{--表示が崩れるためインデント無視--}}
はじめまして。〇〇と申します。
▲▲様が出品されている「□□□」のサービスをお願いしたいと考えております。
購入にあたり、下記内容をご確認の程よろしくお願い致します。
（＊購入後のトラブル防止のため、気になることはしっかりと確認しましょう。）
お忙しいところ大変お手数ではございますが、どうぞ宜しくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template02">
            <textarea readonly>
はじめまして。
〇〇と申します。　
▲▲様が出品されている「□□□」のサービスを購入したいと思いますので、「サービスの提供」通知を送っていただけますでしょうか。
届き次第、購入手続きをさせていただきたいと思います。
どうぞよろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template03">
            <textarea readonly>
この度は、数多くあるサービスの中からご連絡いただきまして誠にありがとうございます。
さっそく「サービス提供」通知をお送りしましたので、購入手続きをお願いいたします。　
お取引完了まで、どうぞよろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template04">
            <textarea readonly>
先ほどサービスを購入させていただきました〇〇です。　
とても楽しみにしていますので、お取引完了までどうぞよろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template05">
            <textarea readonly>
この度はサービスをご購入いただき、誠にありがとうございます。
お取引完了まで、どうぞよろしくお願い致します。　
早速ですが、ご依頼内容の詳細を確認させていただきたいので、下記内容を教えてください。
よろしくお願い致します。
（＊サービス提供に必要な情報をしっかりとすり合わせましょう。）
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template06">
            <textarea readonly>
●日に送らせていただきましたご連絡について、まだご返信をいただけておりませんのでご連絡をさせていただきました。
現在の状況等、お早目にご連絡をいただければ幸いです。
お忙しいところ恐縮ではございますが、どうぞよろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template07">
            <textarea readonly>
大変申し訳ございませんが、今回のご依頼の件はキャンセルさせていただきたいと思います。
キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記します）でございます。
申請のご確認をお願いします。
お役に立てず誠に残念ですが、また機会がございましたら、どうぞよろしくお願い致します。
なお、承認をいただきましたら、代金は支払方法に応じて後日返金されると存じております。よろしくお願い致します。　　　
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template08">
            <textarea readonly>
サービスを納品させていただきますので、ご確認の程よろしくお願い致します。
修正箇所や何か確認したい点がございましたら、お手数をおかけしますが「リトライ」を選択し、ご連絡をお願い致します。
問題がないようでしたら、「承認」を選択していただき、評価にお進みいただけますでしょうか？
よろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template09">
            <textarea readonly>
サービスの確認をさせていただきました。
こちらで問題ございませんので、「承認」とさせて頂きます。
どうもありがとうございます。
この後評価をさせていただきますので、取引終了までよろしくお願い致します。
            </textarea>
        </div>
        <div class="templateBox tabSelectBox" id="template10">
            <textarea readonly>
大変申し上げにくいのですが、今回のご依頼の件はキャンセルをお願いしたく存じます。
キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記する）でございます。申請のご確認をお願いします。
こちらから依頼したにもかかわらず大変恐縮ですが、ご了承いただけますようお願い致します。
            </textarea>
        </div>
        <div class="templateButton"><button type="button" class="templateInput">挿入する</button></div>
    </div>
</div>

<div class="templateNDAPopup">
@if($service_type === 'Product')
<form id="form" action="{{ route('chatroom.create.product', ['product' => $service->id, 'nda' => 1]) }}" method="POST" enctype="multipart/form-data">
@else <!-- JobRequest-->
<form id="form" action="{{ route('chatroom.create.job_request', ['job_request' => $service->id, 'nda' => 1]) }}" method="POST" enctype="multipart/form-data">
@endif
@csrf
    <div class="templateOverlay"></div>
    <div class="templateArea tabSelectArea">
        <div class="templateClose"></div>
        <h2 class="templateTitle">NDAの送付</h2>
        <div class="templateBox" id="templateNDA">
            <textarea name="text"> {{--表示が崩れるためインデント無視--}}
●●発注者（以下「甲」という。）と ●●受注者（以下「乙」という。）は、甲乙間において、カリビト上でやりとりするにあたり（以下「本目的」という。）、相互に開示又は提供する秘密情報の保持につき、次のとおり秘密保持契約（以下「本契約」という。）を締結する（以下、秘密情報を開示又は提供した当事者を「開示者」、秘密情報の開示又は提供を受けた当事者を「受領者」という。）。

第1条（目的）
本契約は、甲が乙のサービスを利用するにあたり、甲または乙がそれぞれ保有する情報を、相手方に提供または開示する際の条件を定めることを目的とします。

第2条（機密情報）
1.本契約において機密情報とは、甲または乙が本契約の有効期間中に提供または開示された、次の各号に定める情報をいいます。
　1.乙のサービスを利用して甲が提供する役務等の購入者（以下「サービス購入者」という）に関する一切の情報
　2.サービス購入者が、甲に対して相談または依頼した事実、または、甲が提供する役務等を購入した事実
　3.甲が提供する役務等の購入の前後を問わず、サービス購入者から受領した一切の情報

2.前項の規定にかかわらず、次の各号に定める情報は、機密情報から除外するものとします。
　1.開示者から開示を受ける前に、被開示者が正当に保有していたことを証明できる情報
　2.開示者から開示を受ける前に、公知となっていた情報
　3.開示者から開示を受けた後に、被開示者の責に帰すべからざる事由により公知となった情報
　4.被開示者が、正当な権限を有する第三者から機密保持義務を負うことなく正当に入手した情報
　5.被開示者が、開示された情報によらず独自に開発した情報

第3条（機密保持）
1.甲は、機密情報を掲載した画面を閲覧する際は、第三者に閲覧されないよう注意を払うとともに、閲覧した情報を機密として保持し、第三者への開示または漏洩をしてはならないものとします。
2.甲および乙は、相手方から開示された機密情報を機密として保持し、事前に開示者の書面による承諾を得ることなく、第三者への開示または漏洩、乙のサービス上で利用する以外の目的での使用をしてはならないものとします。
3.甲および乙は、相手方から開示された機密情報について、自己の役員または使用人のうち、当該機密情報を業務遂行上知る必要のある者に限定して開示するものとし、それ以外の役員または使用人に対して開示または漏洩してはならないものとします。
4.甲および乙は、相手方から開示された機密情報について、乙のサービス上で、業務遂行上必要な範囲で複製することができるものとします。ただし、複製した情報も機密情報として取り扱わなければならないものとします。

第4条（被開示者の責務）
1.甲および乙は、相手方から開示された機密情報を知得した自己の役員または使用人（機密情報を知得後退職した者も含む）に対し、本契約に定める機密保持契約の順守を徹底させるものとします。
2.甲および乙は、相手方から開示された機密情報を知得後に退職した自己の役員または使用人の本契約条項に違反する行為について、相手方に対して一切の責を負うものとします。

第5条（第三被開示者）
1.甲及び乙は、相手方の事前の承諾に基づき、第三者に相手方の機密情報を開示したときは（以下、当該第三者を「第三被開示者」という。）、第三被開示者に対し、本契約に基づき自己が負うのと同一の責任ないし義務を課し、遵守させなくてはならないものとします。
2.前項の規定にかかわらず、第三被開示者に相手方の機密情報を開示した当事者は、第三被開示者の本契約条項に違反する行為について、相手方に対して一切の責を負うものとします。

第6条（管理責任）
甲および乙は、相手方から開示された機密情報の機密を保持するため、当該機密情報の一部または全部を含む資料、記憶媒体およびそれらの複写物等（以下、「機密情報資料」という。）につき、機密が不当に開示されまたは漏洩されないよう、他の資料等と明確に区別を行い、善良な管理者の注意義務をもって管理しなければならないものとします。

第7条（返還義務）
甲および乙は、本契約終了後、相手方から要請があったときは、開示された機密情報の一部または全部を含む機密情報資料（複写物を含む）を、相手方の指示にしたがい、返還または破棄するものとし、破棄したときはその旨を書面にて相手方に通知するものとします。

第8条（損害賠償）
甲または乙は、本契約条項に違反したときは、相手方が被った損害を賠償する責を負うものとします。

第9条（有効期間）
本契約は、本契約締結の日から、甲または乙が、本契約を終了する旨、相手方に申し入れるまで有効に存続するものとします。ただし、本契約の終了後といえども、第3条、第4条、第5条、第7条、第8条、第10条および本条但書の規定については、本契約終了後も3年間存続するものとします。

第10条（合意管轄）
甲および乙は、本契約に関連して生じた紛争については、●●●●裁判所を第一審の専属的合意管轄裁判所とします。

第11条（協議）
甲および乙は、本契約に定めのない事項または本契約の条項の解釈に疑義が生じたときは、本契約締結の趣旨に則り、甲乙誠意をもって協議の上解決するものとします。

●●●●年●●月●●日

甲：●●●●●●●●●●●●●●●●●（住所
　　●●●●●●●●●●●●●●●●●（社名・屋号
　　●●●●●●●●（お名前

乙：●●●●●●●●●●●●●●●●●（住所
　　●●●●●●●●●●●●●●●●●（社名・屋号
　　●●●●●●●●（お名前

            </textarea>
        </div>
        <div class="templateButton"><button type="submit" class="templateNDAInput">送信する</button></div>
    </div>
</form>
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

    // マイページURLを送付
    function insertProfile() {
        var templateText = document.getElementById("templateText");
        var mypageUrl = '◎プロフィールURL ' + '{{ config('app.url') }}' + '/user/' + '{{ Auth::user()->id }}' + '/mypage';
        templateText.value += mypageUrl;
        return false;
    }
</script>
