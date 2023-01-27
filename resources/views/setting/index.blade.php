<x-layout>
<body id="setting">
<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>会員情報</span>
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
										{{ Auth::user()->email }}　<a class="configLink" href="{{ route('setting.email.edit') }}">変更する</a>
									</dd>
								</dl>
								@if (Auth::user()->sub_email)
									<dl class="memberConfigDl">
										<dt>サブメールアドレス</dt>
										<dd>
											{{ Auth::user()->sub_email }}　<a class="configLink" href="{{ route('sub_mail_create') }}">変更する</a> 
										</dd>
									</dl>
									<p class="memberConfigSupplement">＊登録するとこちらからもお知らせ通知を受け取ることができます。</p>
								@else
									<dl class="memberConfigDl">
										<dt>サブメールアドレス</dt>
										<dd>
											<a class="configLink" href="{{ route('sub_mail_create') }}">登録する</a> 
										</dd>
									</dl>
									<p class="memberConfigSupplement">＊登録するとこちらからもお知らせ通知を受け取ることができます。</p>
								@endif
								@can('exist.password')
									<dl class="memberConfigDl">
										<dt>パスワード</dt>
										<dd>
											<a class="configLink" href="{{ route('setting.password.edit') }}">変更する</a>
										</dd>
									</dl>
								@endcan
								<dl class="memberConfigDl">
									<dt>電話番号</dt>
									<dd>
                                        @if (Auth::user()->tel)
                                            {{ Auth::user()->tel }}　<a class="configLink" href="{{ route('setting.tel.edit') }}">変更する</a>
                                        @else
                                            <a class="configLink" href="{{ route('setting.tel.edit') }}">登録する</a>
                                        @endif
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">各種認証申請</h3>
								<dl class="memberConfigDl">
									<dt>本人確認</dt>
									<dd>
										@if(Auth::user()->userProfile->is_identify === 1)
											<span class="status_span status_confirmed">承認</span>
										@elseif(Auth::user()->userProfile->is_identify === 0 && Auth::user()->userProfile->identification_path != null)
											<span class="status_span">申請中</span>
										@else
											<span class="status_span">未承認</span>
											<a href="#fancybox_register"  class="fancybox fancybox_register">申請する</a>
										@endif
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">お支払い方法</h3>
								<dl class="memberConfigDl">
									<dt>クレジットカード</dt>
									<dd>
										<a class="configLink" href="{{ route('setting.card.create') }}">変更する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">受取口座の登録・変更</h3>
								<dl class="memberConfigDl">
									<dt>受取口座</dt>
									<dd>
										<a class="configLink" href="{{ route('setting.bank.edit') }}">変更する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">お知らせ機能</h3>
								<dl class="memberConfigDl">
									<dt>お知らせ受信を設定</dt>
									<form class="" method="post" action="{{ route('setting.notification.update') }}" enctype="multipart/form-data">
										@csrf @method("PUT")
										<dd>
											<input type="hidden" name="is_like" value="0">
											<input type="hidden" name="is_news" value="0">
											<input type="hidden" name="is_message" value="0">
											<input type="hidden" name="is_posting" value="0">
											<input type="hidden" name="is_fav" value="0">
											<div class="labelBox">
												<label><input type="checkbox" name="is_like" value="1" @if(Auth::user()->userNotificationSetting->is_like === 1)checked @endif>いいね！</label>
												<label><input type="checkbox" name="is_news" value="1" @if (Auth::user()->userNotificationSetting->is_news === 1)checked @endif>お知らせ・ニュース</label>
												<label><input type="checkbox" name="is_message" value="1" @if (Auth::user()->userNotificationSetting->is_message === 1)checked @endif>ユーザーからのメッセージ</label>
												<label><input type="checkbox" name="is_posting" value="1" @if (Auth::user()->userNotificationSetting->is_posting === 1)checked @endif>フォロー中の方の掲載</label>
												<label><input type="checkbox" name="is_fav" value="1" @if (Auth::user()->userNotificationSetting->is_fav === 1)checked @endif>お気に入りの更新</label>
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
	</article>
</x-layout>
