<x-admin-layout>
		<article>
			<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
			
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="registerHd registerHd_confirm">パスワード再設定</h2>
							<div class="contactBox">
								<form method="POST" action="{{ route('admin.password.update') }}">
            						@csrf					

									<!-- Password Reset Token -->
									<input type="hidden" name="token" value="{{ $request->route('token') }}">


									<div class="labelCategory">
                                        
										<p>メールアドレス</p>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
										<p><input type="email" name="email" value="{{old('email', $request->email)}}" required readonly></p>

                                        
										<p class="add_mt20">パスワード（半角英数字 8文字 〜 100文字）</p>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
										<p><input type="password" name="password" required autofocus></p>
										<p class="add_mt20">パスワード（再確認）</p>
										<p><input type="password" name="password_confirmation"  required></p>
									</div>
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit" value="パスワード再設定" style="background-color:#17A2B8;"></li>
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