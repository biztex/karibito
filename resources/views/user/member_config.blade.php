<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>メンバー情報</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>

		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

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
										<a class="configLink" href="{{ route('member_config_email') }}">変更する</a>
									</dd>
								</dl>
								<dl class="memberConfigDl">
									<dt>パスワード</dt>
									<dd>
										<a class="configLink" href="{{ route('member_config_pass') }}">変更する</a>
									</dd>
								</dl>
								<dl class="memberConfigDl">
									<dt>電話番号</dt>
									<dd>
										<a class="configLink" href="#">確認する</a>
									</dd>
								</dl>
							</div>
							<div class="memberConfigItem">
								<h3 class="memberConfigHd">各種認証申請</h3>
								<dl class="memberConfigDl">
									<dt>出品者情報</dt>
									<dd>
										<span class="status_span status_confirmed">登録済み</span>
										<a class="configLink" href="#">編集する</a>
									</dd>
								</dl>
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
