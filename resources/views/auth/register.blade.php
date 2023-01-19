<x-layout>
	<article>
		<body id="register" class="none-modal">
			
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="subPagesHd">会員登録</h2>
							<ul class="stepUl">
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">仮登録</p>
								</li>
								<li>
									<p class="stepDot"></p>
									<p class="stepTxt">基本情報</p>
								</li>
								<li>
									<p class="stepDot"></p>
									<p class="stepTxt">完了</p>
								</li>
							</ul>
							<form method="POST" action="{{ route('register') }}">
								@csrf
								@if (session('flash_alert'))
									<div class="alert alert-danger mb05" style="z-index: 9999;">
										{{ session('flash_alert') }}
									</div>
								@endif
								<ul class="loginSns">
									<li><a href="/register/facebook" target="_blank"><img src="img/login/login_facebook.svg"
										alt="Facebookで登録する"></a></li>
										<li><a href="/register/google" target="_blank"><img src="img/login/login_google.svg"
											alt="Googleで登録する"></a></li>
										</ul>
								<div class="contactBox">
									<p class="loginHd"><span>または</span></p>
									<p class="loginInfo">※迷惑メールの設定によっては、カリビトからのメールが届かない場合があります。カリビトからのメールが受信できるようにドメイン指定受信で「karibito.co.jp」を許可するように設定してください。</p>

									<div class="labelCategory">
										<p>メールアドレス（半角英数字128文字以内）</p>
										@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
										<p><input type="email" name="email" placeholder="例） email@karibito.jp" value="{{old('email')}}" required></p>
									</div>
									<div class="labelCategory">
										<p>メールアドレス（再確認）</p>
										<p><input type="email" name="email_confirmation" placeholder="例） email@karibito.jp"value="{{old('email_confirmation')}}" required></p>
									</div>
									<div class="labelCategory">
										<p>パスワード（半角英数字 8文字 〜 100文字）</p>
										@error('password')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
										<p><input type="password" name="password" placeholder="" required></p>
									</div>
									<div class="labelCategory">
										<p>パスワード（再確認）</p>
										<p><input type="password" name="password_confirmation" placeholder="" required></p>
									</div>

									<div class="labelCategory">
										@error('terms')
										<div class="alert alert-danger" style="text-align: center;">{{ $message }}</div>
										@enderror
										<div class="checkBox">
											<label><input type="checkbox" name="terms" value="checked" @if(old('terms') == 'checked') checked @endif required>
												<a href="{{ route('terms-of-service') }}">利用規約</a>と<a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>に同意する
											</label>
											<label><input type="checkbox" name="over_15" value="checked" @if(old('over_15') == 'checked') checked @endif required>
												15歳以下の方はご利用できません。15歳以上ですか?
											</label>
										</div>
									</div>

									<ul class="loginFormBtn">
										<li><input type="submit" class="submit" value="送信"></li>
									</ul>
								</form>
								<div class="loginBottom">
									<p class="loginBottomRegister"><a href="{{route('login')}}">ログインはこちらから</a></p>
								</div>
							</div>
						</div>
					</div><!-- /#main -->
				</div>
				<!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-layout>
<script>
	$(function(){
		// 利用規約/プライバシーポリシー リンク別ウィンドウで開く
		$(document).ready(function(){
			$('.checkBox a').click(function(){
			window.open(this.href,'');
			return false;
			});
		});
	});
</script>