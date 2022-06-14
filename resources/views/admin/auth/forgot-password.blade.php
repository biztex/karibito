<x-admin-layout>
		<article>
			<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
			
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="registerHd registerHd_confirm">パスワード再設定</h2>

                            <p style="text-align: center;margin-bottom:10px;">{{session('status')}}</p>

							<style>
								@media screen and (min-width: 767px) {
									.registerHd_confirm {
										font-size: 2.4rem;
									}
								}
								.registerHd_confirm {
									margin-top: 40px;
								}

								@media screen and (max-width: 767px) {
									.registerHd_confirm {
										margin-top: 20px;
									}
								}
							</style>
							<div class="contactBox">
                                <form method="POST" action="{{ route('admin.password.email') }}">
                                    @csrf
									<div class="labelCategory">
										<p>メールアドレス</p>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
										<p><input type="email" name="email" value="{{ old('email') }}" required autofocus></p>
									</div>
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit" value="パスワード再設定リンクを送信" style="background-color:#17A2B8;"></li>
										<li><a href="{{ route('admin.login') }}" class="submit gray">戻る</a>
									</ul>
								</form>
							</div>
						</div>
					</div><!-- /#main -->

				</div>
				<!--inner-->
			</div><!-- /#contents -->
			<x-hide-modal/>
		</article>
</x-admin-layout>
