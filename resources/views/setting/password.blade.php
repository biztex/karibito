<x-layout>
<body id="setting-page">
<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>パスワード変更</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">パスワードの変更</h2>
							<form method="POST" action="{{ route('setting.password.update') }}">
								@csrf
								<div class="configEditBox">
									<dl class="configEditDl01">
										<dt>　　　　現在のパスワード</dt>
										<dd>
											@error('current_password')<div class="alert alert-danger">{{ $message }}</div>@enderror
											<div class="mypageEditInput">
												<input type="password" name="current_password" autocomplete="on" required>
											</div>
										</dd>
									</dl>
									<dl class="configEditDl01">
										<dt>　　　　新しいパスワード</dt>
										<dd>
											@error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror
											<div class="mypageEditInput">
												<input type="password" name="password" required>
											</div>
										</dd>
									</dl>
									<dl class="configEditDl01">
										<dt>新しいパスワードの再入力</dt>
										<dd>
											@error('password_confirmation')<div class="alert alert-danger">{{ $message }}</div>@enderror
											<div class="mypageEditInput">
												<input type="password" name="password_confirmation" required>
											</div>
											<p class="noticeP">※同じパスワードを確認のため入力してください</p>
										</dd>
									</dl>
									<div class="configEditButton">
										<input type="submit" value="変更する">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
