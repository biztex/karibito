<div class="bottom">
    <div class="inner">
        <div class="serviceLinks">
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="{{ route('home') }}">サービスを探す</a><span></li>
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
                    <li><span class="footerlist_text"><a href="#">ヘルプ</a><span></li>
                    <li><a href="#">カリビト攻略法</a></li>
                    <li><a href="#">カリビトガイド</a></li>
                    <li><a href="#">よくある質問</a></li>
                    <li><a href="#">運営会社について</a></li>
                    <li><a href="#">個人情報の取り扱いについて</a></li>
                    <li><a href="#">特定商取引法に基づく表記</a></li>
                    <li><a href="#">利用規定</a></li>
                    <li><a href="#">カテゴリ項目追加依頼</a></li>        
                    <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
                </ul>
            </div>
            <div class=footer_list1>
                <ul>
                    <li><span class="footerlist_text"><a href="#">マイページ</a><span></li>
                    <li><a href="#">お気に入り</a></li>
                    <li><a href="#">過去の取引</a></li>
                    <li><a href="#">掲載内容一覧</a></li>
                    <li><a href="#">決済履歴</a></li>
                    <li><a href="#">ポイント取引・利用履歴</a></li>
                    <li><a href="#">フォロー・フォロワー</a></li>
                    <li><a href="#">プロモーション・お知らせ</a></li>
                    <li><a href="#">カリビト知恵袋</a></li>        
                    <li><a href="#">会員情報</a></li>
                    <li><a href="#">掲載内容の下書き</a></li>
                    <li><a href="#">見積書の作成・管理</a></li>
                    <li><a href="#">履歴書の作成・管理</a></li>
                    <li><a href="#">お知らせ機能の設定</a></li>
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