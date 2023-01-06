<div>
    <aside id="side" class="pc">

        <div class="sidePerson">
            <div class="sidePersonPic">
                @if(!empty(Auth::user()->userProfile->icon))
                    <p class="img"><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt=""></p>
                @else
                    <p class="img"><img src="/img/mypage/no_image.jpg" alt=""></p>
                @endif
            </div>

            <p class="sidePersonName">{{ Auth::user()->name }}</p>
            <p class="sidePersonEdit">
                <a href="#fancybox_person" class="fancybox">
                    <img src="/img/mypage/btn_person.svg" alt="プロフィールを編集">
                </a>
            </p>
        </div>

        <div class="sideItem">
            <ul class="sideUl01">
                <li><a href="{{ route('mypage') }}" class="">マイページ</a></li>
                <li><a href="{{ route('favorite.index') }}" class="">お気に入り</a></li>
                <li><a href="{{ route('chatroom.active') }}" class="">進行中の取引</a></li>
                <li><a href="{{ route('chatroom.inactive') }}" class="">過去の取引</a></li>
                <li><a href="{{ route('evaluation') }}" class="">評価一覧</a></li>
                <li><a href="{{ route('payment.index') }}" class="">支払い履歴</a></li>
                <li><a href="{{ route('point.index') }}" class="">ポイント取得・利用履歴</a></li>
                <li><a href="{{ route('follow.index') }}" class="">フォロー・フォロワー</a></li>
                <li><a href="{{ route('user_notification.index') }}" class="">お知らせ</a></li>
                {{-- <li><a href="/sample/faq" class="">カリビト知恵袋</a></li> --}}
                <li><a href="{{ route('secret01') }}" class="">マッチングする秘訣</a></li>
                <li><a href="{{ route('coupon.index') }}" class="">クーポン</a></li>
                <li><a href="{{ route('dm.index') }}" class="">DM</a></li>
                <li><a href="{{ route('setting.index') }}" class="">会員情報</a></li>
                <li><a href="{{ route('showWithdrawForm') }}" class="">退会</a></li>
            </ul>
        </div>
        {{-- @can('identify') --}}
            <div class="sideItem">
                <p class="sideHd">出品者向け</p>
                <ul class="sideUl01">
                    <li><a href="{{ route('resume.show') }}" class="">スキル / 経歴</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="">ポートフォリオ</a></li>
                    <li><a href="{{ route('blog.index') }}">ブログ</a></li>
                    <li><a href="{{ route('publication') }}" class="">掲載内容一覧</a></li>
                    <li><a href="{{ route('draft') }}">掲載内容の下書き</a></li>
                    <li><a href="{{ route('profit.index') }}" class="">売上管理・振込申請</a></li>
            </ul>
            </div>
        {{-- @endcan --}}
        <div class="sideItem">
            <p class="sideHd">カリビトについて</p>
            <ul class="sideUl01">
                <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
                <li><a href="{{ route('support') }}">ご利用ガイド</a></li>
                <li><a href="#">カテゴリー項目追加依頼</a></li>
                <li><a href="{{ route('privacy-policy') }}">個人情報の取り扱いについて</a></li>
                <li><a href={{ route('notation') }}>特定商取引法に基づく表記</a></li>
                <li><a href="{{ route('terms-of-service') }}">利用規約</a></li>
                <li><a href="{{ route('company') }}">運営会社について</a></li>
                <li><div class="edition">バージョン <span>00.0000,00</span></div></li>
            </ul>
        </div>
    </aside>
</div>
