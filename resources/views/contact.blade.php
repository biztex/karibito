<x-layout>
    <x-parts.post-button/>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>お問い合わせ</span>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.flash-msg/>
        <div id="contents" class="oneColumnPage">
            <div class="inner">
                <div id="main">
                    <div class="subPagesWrap">
                        <h2 class="subPagesHd">お問合せ</h2>
                        <div class="contactBox">
                            <p class="contactTop">
                                お問合せの前に、まずは<a href="/support/#support01" class="contactBoxLink">よくある質問</a>・<a href="karibitoguide" class="contactBoxLink">カリビトガイド</a>をご覧ください。
                                <br>
                                解決できない場合は、下記のお問い合わせフォームに必要事項をご記入いただきお問い合わせください。
                                <br>
                                会員登録をされていない方のお問い合わせには、回答できない場合もございます。
                            </p>
                            <?php
                                $type = $_GET['type']?? null;
                            ?>
                            <form method="post" action="{{ route('contact') }}">
                                @csrf
                                <div class="labelName">
                                    <input type="text" name="name" placeholder="名前" @if(\Auth::User()) value="{{ \Auth::User()->name }}" @endif required>
                                    @error('name')
                                    <div class="alert alert-danger" style="text-align: left;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="labelMail">
                                    <input type="email" name="mail" placeholder="メールアドレス" @if(\Auth::User()) value="{{ \Auth::User()->email }}" @endif required>
                                    @error('mail')
                                    <div class="alert alert-danger" style="text-align: left;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="labelType">
                                    <select name="type" style="color:#000;">
                                        @foreach (App\Models\ContactMailHistory::CONTACT_TYPES as $i => $option)
                                            <option value='{{ $i }}' @if (isset($type)? $type == $i: $i == App\Models\ContactMailHistory::REPORT) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="labelMail">{{-- サービス名 --}}
                                    <p style="opacity: 70%;">
                                        @if (isset($report_product_title))
                                            サービス名:{{ $report_product_title }}
                                        @elseif (isset($report_job_request_title))
                                            リクエスト名:{{ $report_job_request_title }}
                                        @endif
                                    </p>
                                </div>
                                <div class="labelMessage">
                                    <p>お問い合わせ内容</p>
                                    <textarea name="message" placeholder="入力してください" required></textarea>
                                    @error('message')
                                    <div class="alert alert-danger" style="text-align: left;">お問い合わせ内容は必ず指定してください。</div>
                                    @enderror
                                </div>
                                <p class="contactBoxText">＊お返事はお問い合わせをいただいてから３営業日以内にご返信させていただきます。数日経過しましても当社から返信がない場合は、お客様のご使用の端末/メールシステムのフォルダ設定により、「@karibito.co.jp」のメールが迷惑メールとして振り分けられた可能性がございます。メールサービスの設定をご確認の上、お手数ですが再度お問合せをお願いします。</p>
                                <p class="contactBoxText">＊土日祝日等、弊社休業日にいただいたお問い合わせにつきましては、翌営業日の受付とさせていただきます。</p>
                                <p class="mb25 contactBoxText">＊通報の際は、該当するサービス名やユーザー名を必ずご明記ください。</p>
                                @if (isset($report_product_id))
                                    <input type="hidden" name="product_id" value="{{ $report_product_id }}"> {{-- 商品ID --}}
                                @elseif (isset($report_job_request_id))
                                    <input type="hidden" name="job_request_id" value="{{ $report_job_request_id }}"> {{-- リクエストID --}}
                                @endif

                                @if(\Auth::User() == null)
                                    <div class="labelCategory">
                                        @error('terms')
                                        <div class="alert alert-danger" style="text-align: center;">{{ $message }}</div>
                                        @enderror
                                        <div class="checkBox">
                                            <label><input type="checkbox" name="terms" value="checked" @if(old('terms') == 'checked') checked @endif required>
                                                <a href="{{ route('terms-of-service') }}">利用規約</a>と<a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>に同意する
                                            </label>
                                            @error('over_15')
                                            <div class="alert alert-danger" style="text-align: center;">{{ $message }}</div>
                                            @enderror
                                            <label><input type="checkbox" name="over_15" value="checked" @if(old('over_15') == 'checked') checked @endif required>
                                                15歳以下の方はご利用できません。15歳以上ですか?
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <p class="formBtn"><input type="submit" class="submit" value="送信する"></p>
                            </form>
                        </div>
                    </div>
                </div><!-- /#main -->
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>
<script type="text/javascript">
$(function(){
    // 送信するボタン挙動
    $(".submit").on("click", function() {
        // 連打防止
        $(this).prop("disabled", true);
        $(this).closest('form').submit();
    });
})
</script>
