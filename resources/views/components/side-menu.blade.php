<x-app>
    <div>
        <aside id="side" class="pc">
            <div class="sidePerson">
                <div class="sidePersonPic">
                    @if(!empty($user_profile->icon))
                        <p class="img"><img style="width: 120px;height: 120px;object-fit: cover;" src="{{asset('/storage/'.$user_profile->icon) }}" alt=""></p>
                    @else
                        <p class="img"><img src="/img/mypage/pic_head.png" alt=""></p>
                    @endif
                </div>
                <p class="sidePersonName">{{ $user_profile->user->name }}</p>
                <p class="sidePersonEdit"><a href="#fancybox_person" class="fancybox fancybox_profile">
                        <img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></p>
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
                    <li><a href="{{ route('member') }}" class="">会員情報</a></li>
                    <li><a href="{{ route('showWithdrawForm') }}" class="">退会</a></li>
                </ul>
            </div>
            <div class="sideItem">
                <p class="sideHd">出品者向け</p>
                <ul class="sideUl01">
                    <li><a href="#" class="">スキル / 経歴</a></li>
                    <li><a href="#" class="">ポートフォリオ</a></li>
                    <li><a href="#">ブログ</a></li>
                    <li><a href="{{ route('publication') }}" class="">掲載内容一覧</a></li>
                    <li><a href="{{ route('draft') }}">掲載内容の下書き</a></li>
                </ul>
            </div>
            <div class="sideItem">
                <p class="sideHd">カリビトについて</p>
                <ul class="sideUl01">
                    <li><a href="#">お問い合わせ</a></li>
                    <li><a href="{{ route('support') }}">ご利用ガイド</a></li>
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
</x-app>
<script>
	$(function(){

		// バリデーションエラーの際、モーダルを最初から表示する
        if (@json($errors->has('identification_path'))){
                $('.fancybox_register').trigger('click');
                $('html').addClass('fancybox-margin');
                $('html').addClass('fancybox-lock');
                $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
        }

		else if (@json($errors->any())) {
					$('.fancybox').trigger('click');
                    $('html').addClass('fancybox-margin fancybox-lock');
                    $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
		}

        
	})
</script>