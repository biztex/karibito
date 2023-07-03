<div class="bottom">
    <div class="inner">
        <div class="serviceLinks">
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="/product/index/keyword/search?service_flg=1&keyword=&search_flg=1">サービスを探す</a><span></li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{route('product.category.index', $category->id) }}">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="{{ route('home') }}">リクエストを探す</a><span></li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{route('job_request.category.index', $category->id) }}">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="{{ route('support') }}">ヘルプ</a><span></li>
                    <li><a href="/guide">カリビト攻略法</a></li>
                    <li><a href="/karibitoguide">カリビトガイド</a></li>
                    <li><a href="{{ route('support') }}">よくある質問</a></li>
                    <li><a href="{{ route('company') }}">運営会社について</a></li>
                    <li><a href="{{ route('privacy-policy') }}">個人情報の取り扱いについて</a></li>
                    <li><a href="{{ route('notation') }}">特定商取引法に基づく表記</a></li>
                    <li><a href="{{ route('terms-of-service') }}">利用規約</a></li>
                    <li><a href="{{ route('contact').'?type=7' }}">カテゴリ項目追加依頼</a></li> <!-- 未実装 -->
                    <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
                </ul>
            </div>
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="{{ route('mypage') }}">マイページ</a><span></li>
                    <li><a href="{{ route('favorite.index') }}">お気に入り</a></li>
                    <li><a href="{{ route('chatroom.buyer') }}">購入に関するやりとり</a></li>
                    <li><a href="{{ route('evaluation') }}">評価一覧</a></li>
                    <li><a href="{{ route('payment.index') }}">支払い履歴</a></li>
                    <li><a href="{{ route('point.index') }}">ポイント取引・利用履歴</a></li>
                    <li><a href="{{ route('follow.index') }}">フォロー・フォロワー</a></li>
                    <li><a href="{{ route('user_notification.index') }}">お知らせ</a></li>
                    <li><a href="{{ route('secret01') }}">カリビトチャットのコツ</a></li>
                    <li><a href="{{ route('coupon.index') }}">クーポン</a></li>
                    <li><a href="{{ route('dm.index') }}">DM</a></li>
                    <li><a href="{{ route('setting.index') }}">会員情報</a></li>
                    <li><a href="{{ route('withdraw') }}">退会</a></li>
                    <li><a href="{{ route('resume.show') }}">スキル / 経歴</a></li>
                    <li><a href="{{ route('portfolio.index') }}">ポートフォリオ</a></li>
                    <li><a href="{{ route('blog.index') }}">ブログ</a></li>
                    <li><a href="{{ route('chatroom.index') }}">出品に関するやりとり</a></li>
                    <li><a href="{{ route('publication') }}">掲載内容一覧</a></li>
                    <li><a href="{{ route('draft') }}">掲載内容の下書き</a></li>
                    <li><a href="{{ route('profit.index') }}">売上管理・振込申請</a></li>
                </ul>
                <a href="#" target="_blank" ><img src="/img/common/footer_twitter_icon.png" alt="Twitter" class="footer_twitter"></a>
            </div>
            <!--<a href="#">約款特定</a> 
            <a href="{{ route('notation') }}">商取引法に基づく表示</a>
            <a href="#">よくある質問</a>
            <a href="{{ route('contact') }}">お問い合わせ</a>-->
        </div>
        <div class="sns sp">
            <a href="#" target="_blank"><img src="/img/common/ico_facebook.png" alt="Facebook"></a>
            <a href="#" target="_blank"><img src="/img/common/ico_twitter.png" alt="Twitter"></a>
            <a href="#" target="_blank"><img src="/img/common/ico_instragram.png" alt="Instragram"></a>
            <a href="#" target="_blank"><img src="/img/common/ico_line.png" alt="LINE"></a>
        </div>
       
    </div>
    <p id="copyright">©{{ now()->year }} karibito, Inc.</p>
</div>