<x-layout>
<article>
	<body id="login">
		<div class="btnFixed"><a href="#"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		{{-- フェイスブックのメアドがない場合にエラーを表示 --}}
		@if($errors->has('error_msg'))
			<div class="error-txt">{{ $errors->first('error_msg') }}</div>
		@endif
            {{-- {{ $error_msg}}; --}}
			
		<div id="contents" class="oneColumnPage02">
			<div class="inner">
				<div id="main">
					<div class="loginWrap">
						<h2 class="subPagesHd">ログイン</h2>

						@if (session('flash_alert'))
							<div class="alert alert-danger mb05" style="z-index: 9999;">
								{{ session('flash_alert') }}
							</div>
						@endif

						<ul class="loginSns">
							<li><a href="/login/facebook" target="_blank"><img src="/img/login/login_facebook.svg" alt="Facebookでログイン"></a></li>
							<li><a href="/login/google" target="_blank"><img src="/img/login/login_google.svg" alt="Googleでログイン"></a></li>
						</ul>
						<!--確認中 <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>  -->
						<div class="contactBox">
							<p class="loginHd"><span>または</span></p>

							<form method="POST" action="{{ route('login') }}">
            				@csrf
								<div class="labelCategory">
									<p>メールアドレス（半角英数字128文字以内）</p>
									@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
                            		@enderror
									<p><input type="email" name="email" placeholder="例） email@karibito.jp" value="{{old('email')}}" required></p>
								</div>
								<div class="labelCategory">
									<p>パスワード（半角英数字 8文字 〜 100文字）</p>
									@error('password')
										<div class="alert alert-danger">{{ $message }}</div>
                            		@enderror
									<p><input type="password" name="password" placeholder="" required></p>
								</div>
								<ul class="loginFormBtn">
									<li><input type="submit" class="submit" value="ログイン"></li>
								</ul>
							</form>
							<div class="loginBottom">
								<p class="loginBottomPswd">パスワードを変更したい方、または忘れた方は <a href="{{ route('password.request') }}">こちら</a></p>
								<p class="loginBottomRegister"><a href="{{route('register')}}">会員登録はこちら</a></p>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
	</body>
</article>
</x-layout>