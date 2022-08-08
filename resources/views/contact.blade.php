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
                                <div class="labelName"><input type="text" name="name" placeholder="名前" required></div>
                                <div class="labelMail"><input type="email" name="mail" placeholder="メールアドレス" required></div>
                                <div class="labelType"><select name="type">
                                    @foreach (App\Models\ContactMailHistory::CONTACT_TYPES as $i => $option)
                                        <option value='{{ $i }}'>{{ $option }}</option>
                                    @endforeach
                                </select></div>
                                <div class="labelMessage">
                                    <p>お問い合わせ内容</p>
                                    <textarea name="message" placeholder="入力してください" required></textarea>
                                </div>
                                <p class="formBtn"><input type="submit" class="submit" value="送信する"></p>
                            </form>
                        </div>
                    </div>
                </div><!-- /#main -->
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>
