<x-layout>
<body id="member-page">
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('member') }}">メンバー情報</a>　>　<span>会員情報</span>
			</div>
		</div><!-- /.breadcrumb -->

		<x-parts.ban-msg/>
		<x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="memberConfigWrap">
						<h2 class="subPagesHd">会員情報</h2>
						<div class="memberConfigBox">
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">プロフィール</h3>
								<dl class="memberConfigDl">
									<dt>プロフィール</dt>
									<dd>
										<a class="configLink fancybox" href="#fancybox_person">変更する</a>
									</dd>
								</dl>
								<dl class="memberConfigDl">
									<dt>ユーザーID</dt>
									<dd>{{ Auth::user()->id }}</dd>
								</dl>
								<dl class="memberConfigDl">
									<dt>メールアドレス</dt>
									<dd>
										{{ Auth::user()->email }}　<a class="configLink" href="{{ route('member_config.email.edit') }}">変更する</a>
									</dd>
								</dl>
								@can('exist.password')
									<dl class="memberConfigDl">
										<dt>パスワード</dt>
										<dd>
											<a class="configLink" href="{{ route('member_config.password.edit') }}">変更する</a>
										</dd>
									</dl>
								@endcan
								<dl class="memberConfigDl">
									<dt>電話番号</dt>
									<dd>
                                        @if (Auth::user()->tel)
                                            {{ Auth::user()->tel }}　<a class="configLink" href="{{ route('member_config.tel.edit') }}">変更する</a>
                                        @else
                                            <a class="configLink" href="{{ route('member_config.tel.edit') }}">登録する</a>
                                        @endif
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">各種認証申請</h3>
								<dl class="memberConfigDl">
									<dt>本人確認</dt>
									<dd>
										<span class="status_span">@if(Auth::user()->userProfile->is_identify === 1)承認@elseif (Auth::user()->userProfile->is_identify === 0)未承認@endif</span>
										@if(Auth::user()->userProfile->is_identify === 0)
										<a href="#fancybox_register"  class="fancybox fancybox_register">申請する</a>
										@endif
										{{-- @dd(Auth::user()->userProfile->is_identify) --}}
									</dd>
								</dl>
								<dl class="memberConfigDl">
									<dt>機密保持契約（NDA）</dt>
									<dd>
										<span class="status_span">未承認</span>
										<a class="configLink" href="#">確認する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">お支払い方法</h3>
								<dl class="memberConfigDl">
									<dt>クレジットカード</dt>
									<dd>
										<a class="configLink" href="{{ route('member_config.card.edit') }}">変更する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">お知らせ機能</h3>
								<dl class="memberConfigDl">
									<dt>お知らせ受信を設定</dt>
									<form class="" method="post" action="{{ route('member_config.notification.update') }}" enctype="multipart/form-data">
										@csrf @method("PUT")
										<dd>
											<input type="hidden" name="is_like" value="0">
											<input type="hidden" name="is_posting" value="0">
											<input type="hidden" name="is_fav" value="0">
											<input type="hidden" name="is_arrival" value="0">
											<input type="hidden" name="is_news" value="0">
											<input type="hidden" name="is_promo" value="0">
											<div class="labelBox">
												<label><input type="checkbox" name="is_like" value="1" @if(Auth::user()->userNotificationSetting->is_like === 1)checked @endif>いいね！</label>
												<label><input type="checkbox" name="is_posting" value="1" @if (Auth::user()->userNotificationSetting->is_posting === 1)checked @endif>フォロー中の方の掲載</label>
												<label><input type="checkbox" name="is_fav" value="1" @if (Auth::user()->userNotificationSetting->is_fav === 1)checked @endif>お気に入りの再掲載</label>
												<label><input type="checkbox" name="is_arrival" value="1" @if (Auth::user()->userNotificationSetting->is_arrival === 1)checked @endif>保存した検索条件の新着</label>
												<label><input type="checkbox" name="is_news" value="1" @if (Auth::user()->userNotificationSetting->is_news === 1)checked @endif>お知らせ・ニュース</label>
												<label><input type="checkbox" name="is_promo" value="1" @if (Auth::user()->userNotificationSetting->is_promo === 1)checked @endif>プロモーション</label>
											</div>
										</dd>
										<input class="blue-button mt20" type="submit" value="変更する">
									</form>
								</dl>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
