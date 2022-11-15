<x-layout>
    <x-parts.flash-msg/>
    <x-parts.post-button/>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>お問い合わせ</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="oneColumnPage">
            <div class="inner">
                <div id="main">
                    <div class="subPagesWrap">
                        <h2 class="subPagesHd">お問い合わせ</h2>
                        <div class="contactBox">
                            <p class="contactTop">当サービスへのお問い合わせは、下記フォームにご入力いただき、送信いただきますようお願いいたします。</p>
                            <form action="{{ route('contact') }}" method="post">
                                @csrf
                                <div class="labelName"><input type="text" name="name" placeholder="名前" @if(\Auth::User()) value="{{ \Auth::User()->name }}" @endif required></div>
                                <div class="labelMail"><input type="email" name="mail" placeholder="メールアドレス" @if(\Auth::User()) value="{{ \Auth::User()->email }}" @endif required></div>
                                <div class="labelType">
                                    <select name="type" style="color:#000;">
                                        @foreach (App\Models\ContactMailHistory::CONTACT_TYPES as $i => $option)
                                            <option value='{{ $i }}' @if ($i == App\Models\ContactMailHistory::REPORT) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="labelMail">{{-- 商品名 --}}
                                    <p style="opacity: 70%;">
                                        @if (isset($report_product_title))
                                            商品名:{{ $report_product_title }}
                                        @elseif (isset($report_job_request_title))
                                            リクエスト名:{{ $report_job_request_title }}
                                        @endif
                                    </p>
                                </div>
                                <div class="labelMessage">
                                    <p>お問い合わせ内容</p>
                                    <textarea name="message" placeholder="入力してください" required></textarea>
                                </div>
                                @if (isset($report_product_id))
                                    <input type="hidden" name="product_id" value="{{ $report_product_id }}"> {{-- 商品ID --}}
                                @elseif (isset($report_job_request_id))
                                    <input type="hidden" name="job_request_id" value="{{ $report_job_request_id }}"> {{-- リクエストID --}}
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
