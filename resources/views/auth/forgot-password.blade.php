<x-layout>
	<article>
		<div id="contents" class="oneColumnPage02">
			<div class="inner">
				<div id="main">
					<div class="loginWrap">
						<h2 class="registerHd registerHd_confirm">パスワード再設定</h2>

						<p style="text-align: center;margin-bottom:10px;">{{session('status')}}</p>

						<div class="contactBox">
							<form method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="labelCategory">
									<p>メールアドレス</p>
									@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<p><input type="email" name="email" value="{{ old('email') }}" required autofocus></p>
								</div>
								<ul class="loginFormBtn">
									<li><input type="submit" class="submit" value="パスワード再設定リンクを送信"></li>
									<li><a href="{{ route('login') }}" class="submit gray">戻る</a>
								</ul>
							</form>
						</div>
					</div>
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
