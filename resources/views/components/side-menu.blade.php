<div>
    <aside id="side" class="pc">
        <div class="sidePerson">
            <div class="sidePersonPic">
                <p class="img"><img src="img/mypage/pic_head.png" alt=""></p>
            </div>
            <p class="sidePersonName">クリエイター名</p>
            <p class="sidePersonEdit"><a href="#fancybox_person" class="fancybox"><img src="img/mypage/btn_person.svg" alt="プロフィールを編集"></a></p>
        </div>
        <div class="sideItem">
            <ul class="sideUl01">
                <li><a href="{{ route('mypage') }}" class="">マイページ</a></li>
                <li><a href="/sample/favorite" class="">お気に入り</a></li>
                <li><a href="#" class="">進行中の取引</a></li>
                <li><a href="/sample/past" class="">過去の取引</a></li>
                <li><a href="/sample/payment_history" class="">決済履歴</a></li>
                <li><a href="/sample/point_history" class="">ポイント取得・利用履歴</a></li>
                <li><a href="/sample/friends" class="">フォロー・フォロワー</a></li>
                <li><a href="/sample/news" class="">お知らせ</a></li>
                <li><a href="/sample/faq" class="">カリビト知恵袋</a></li>
                <li><a href="#" class="">クーポン</a></li>
                <li><a href="#" class="">DM</a></li>
                <li><a href="/sample/member" class="">会員情報</a></li>
            </ul>
        </div>
        <div class="sideItem">
            <p class="sideHd">出品者向け</p>
            <ul class="sideUl01">
                <li><a href="#" class="">スキル / 経歴</a></li>
                <li><a href="#" class="">ポートフォリオ</a></li>
                <li><a href="#">ブログ</a></li>
                <li><a href="/sample/publication" class="">掲載内容一覧</a></li>
                <li><a href="{{ route('draft') }}">掲載内容の下書き</a></li>
            </ul>
        </div>
        <div class="sideItem">
            <p class="sideHd">カリビトについて</p>
            <ul class="sideUl01">
                <li><a href="#">お問い合わせ</a></li>
                <li><a href="{{ route('guide') }}">ご利用ガイド</a></li>
                <li><a href="#">カテゴリー項目追加依頼</a></li>
                <li><a href="{{ route('privacy-policy') }}">個人情報の取り扱いについて</a></li>
                <li><a href="#">特定商取引法に基づく表記</a></li>
                <li><a href="{{ route('terms-of-service') }}">利用規約</a></li>
                <li><a href="{{ route('company') }}">運営会社について</a></li>
                <li><div class="edition">バージョン <span>00.0000,00</span></div></li>
            </ul>
        </div>
    </aside>
</div>