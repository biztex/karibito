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
                    <li><a href="{{ route('support_detail') }}">よくある質問</a></li>
                    <li><a href="{{ route('company') }}">運営会社について</a></li>
                    <li><a href="{{ route('privacy-policy') }}">個人情報の取り扱いについて</a></li>
                    <li><a href="{{ route('notation') }}">特定商取引法に基づく表記</a></li>
                    <li><a href="{{ route('terms-of-service') }}">利用規定</a></li>
                    <li><a href="#">カテゴリ項目追加依頼</a></li> <!-- 未実装 -->
                    <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
                </ul>
            </div>
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="{{ route('mypage') }}">マイページ</a><span></li>
                    <li><a href="{{ route('favorite.index') }}">お気に入り</a></li>
                    <li><a href="{{ route('chatroom.inactive') }}">過去の取引</a></li>
                    <li><a href="{{ route('publication') }}">掲載内容一覧</a></li>
                    <li><a href="{{ route('payment.index') }}">決済履歴</a></li>
                    <li><a href="{{ route('point.index') }}">ポイント取引・利用履歴</a></li>
                    <li><a href="{{ route('follow.index') }}">フォロー・フォロワー</a></li>
                    <li><a href="{{ route('user_notification.index') }}">プロモーション・お知らせ</a></li>
                    <li><a href="#">カリビト知恵袋</a></li> <!-- 未実装 -->
                    <li><a href="{{ route('setting.index') }}">会員情報</a></li>
                    <li><a href="{{ route('draft') }}">掲載内容の下書き</a></li>
                    <li><a href="#">見積書の作成・管理</a></li> <!-- 未実装 -->
                    <li><a href="#">履歴書の作成・管理</a></li> <!-- 未実装 -->
                    <li><a href="{{ route('setting.index') }}">お知らせ機能の設定</a></li>
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