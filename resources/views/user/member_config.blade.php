<x-layout>
<body id="member-page">
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>メンバー情報</span>
			</div>
		</div><!-- /.breadcrumb -->
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
									<dd>000000000000</dd>
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
                                            <a class="configLink" href="{{ route('member_config_tel') }}">登録する</a>
                                        @endif
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">各種認証申請</h3>
								<dl class="memberConfigDl">
									<dt>本人確認	</dt>
									<dd>
										<span class="status_span">未承認</span>
										<a class="configLink" href="#">申請する</a>
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
										<a class="configLink" href="member_config_card_edit.html">変更する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">お知らせ機能</h3>
								<dl class="memberConfigDl">
									<dt>お知らせ受信を設定</dt>
									<dd>
										<div class="labelBox">
											<label><input type="checkbox" name="checkbox_config">いいね！</label>
											<label><input type="checkbox" name="checkbox_config">フォロー中の方の掲載</label>
											<label><input type="checkbox" name="checkbox_config">お気に入りの再掲載</label>
											<label><input type="checkbox" name="checkbox_config">保存した検索条件の新着</label>
											<label><input type="checkbox" name="checkbox_config">お知らせ・ニュース</label>
											<label><input type="checkbox" name="checkbox_config">プロモーション</label>
										</div>
									</dd>
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
