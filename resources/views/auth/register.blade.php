<x-layout>
	<article>
		<body id="register">
			<!-- <div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
			<div class="hide">
				<div id="fancybox_register" class="fancyboxWrap">
					<p class="fancyboxHd">身分証明証の登録</p>
					<div class="fancyboxCont">
						<div class="fancyRegisterItem">
							<p class="txt">
								「身分証明書を登録する」とは、<br>信頼性を高めるため、本人であることを証明する書類を提出する手続きです。<br>身分証明書が承認されると、プロフィールに身分証明書提出済マークが表示されます。
							</p>
						</div>
						<div class="fancyRegisterItem">
							<p class="notice">注意事項</p>
							<p class="txt">
								カリビトアプリのプロフィールで、住所・氏名・生年月日はしっかり記載していますか?<br>身分証明書との一致が確認できないと本人確認はできないのでご注意ください!<br>登録いただいた３営業日以内にご返信します。
							</p>
						</div>
						<div class="fancyRegisterItem">
							<p class="txt">提出可能な本人確認書類は、下記となっております。</p>
							<p class="txt">【個人の場合】<br>運転免許証・健康保険証 / 被保険者証・旅券 / <br>パスポート・住民票・住民基本台帳カード・外国人証明書</p>
							<p class="txt">【法人の場合】<br>履歴事項全部証明書　(※3 ヵ月以内のものに限ります)</p>
						</div>
						<div class="fancyRegisterItem">
							<p class="txt">【カリビトアプリ登録情報】<br>都道府県:〇〇〇〇〇〇<br>住所:〇〇〇〇〇〇<br>氏名:〇〇〇〇〇〇<br>生年月日:〇〇〇〇〇〇</p>
						</div>
						<div class="fancyRegisterItem">
							<p class="txt">安心安全のため、本人確認承認後はご住所 / 本名/ 生年月日のご変更ができなくなっておりますので、本人確認承認後にご住所 / 本名 /
								生年月日をご変更されたい場合は、カリビト事務局へ、お問い合わせください</p>
						</div>
					</div>
					<p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集はこちら</a></p>
					<p class="fancyRegisterUpload"><a href="#">身分証明書をアップロード</a></p>
					<p class="fancyRegisterSubmit"><a href="#">提出する</a></p>
				</div>
				<div id="fancybox_person" class="fancyboxWrap">
					<form>
						<p class="fancyboxHd">プロフィールを編集</p>
						<div class="fancyboxCont">
							<div class="mypageCover">
								<a href="#"><img src="img/mypage/icon_camera01.svg" alt=""></a>
							</div>
							<div class="fancyPersonPic">
								<p class="img"><img src="img/mypage/pic_head.png" alt=""></p>
								<a href="#"><img src="img/mypage/icon_camera02.svg" alt=""></a>
							</div>
							<div class="fancyPersonTable">
								<dl class="">
									<dt>ニックネーム</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class="">
									<dt>メールアドレス</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class=" inlineFlex">
									<dt>姓<span>(本名は非公開です)</span></dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class=" inlineFlex">
									<dt>名<span>(本名は非公開です)</span></dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl>
									<dt>性別</dt>
									<dd>
										<select>
											<option selected="" disabled="">選択してください</option>
											<option>男</option>
											<option>女</option>
										</select>
									</dd>
								</dl>
								<dl>
									<dt>生年月日<span>(年代のみ公開されます)</span></dt>
									<dd>
										<select class="year">
											<option selected="" disabled="">年</option>
											<option>2021</option>
											<option>2022</option>
										</select>
										<select class="month">
											<option selected="" disabled="">月</option>
											<option>12</option>
											<option>01</option>
										</select>
										<select class="day">
											<option selected="" disabled="">日</option>
											<option>18</option>
											<option>19</option>
										</select>
									</dd>
								</dl>
								<dl>
									<dt>住所<span>(都道府県のみ表示されます)</span></dt>
									<dd>
										<p class="addrNumber"><input class="short" type="text" name=""></p>
										<div class="addrSelect">
											<select class="short">
												<option selected="" disabled="">選択してください</option>
												<option>xx県</option>
												<option>xx県</option>
											</select>
										</div>
										<p><input type="text" name="" placeholder="市区町村"></p>
									</dd>
								</dl>
								<div class="specialtyBox">
									<div class="specialtyItem">
										<div class="clone">
											<dl>
												<dt>得意分野</dt>
												<dd>
													<select class="short">
														<option selected="" disabled="">選択してください</option>
														<option>家の掃除</option>
														<option>料理代行</option>
														<option>パソコン修理</option>
														<option>高齢者のお世話</option>
														<option>写真撮影代行</option>
														<option>ロゴデザイン</option>
													</select>
												</dd>
											</dl>
											<dl>
												<dt>得意分野詳細</dt>
												<dd>
													<input type="text" name="">
												</dd>
											</dl>
										</div>
										<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg"
													alt="">得意分野を追加</span></p>
									</div>
								</div>
								<dl>
									<dt>自己紹介</dt>
									<dd><textarea></textarea></dd>
								</dl>
							</div>
						</div>
						<div class="fancyPersonBtn">
							<a href="#" class="fancyPersonCancel">キャンセル</a>
							<a href="#" class="fancyPersonSign">登録する</a>
						</div>
					</form>
				</div>
				<div id="fancybox_resume" class="fancyboxWrap">
					<form>
						<p class="fancyboxHd">履歴書の作成</p>
						<div class="fancyboxCont">
							<div class="fancyPersonTable">
								<dl class=" inlineFlex">
									<dt>姓</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class=" inlineFlex">
									<dt>名</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class=" inlineFlex">
									<dt>セイ</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl class=" inlineFlex">
									<dt>メイ</dt>
									<dd><input type="text" name=""></dd>
								</dl>
								<dl>
									<dt>生年月日</dt>
									<dd>
										<select class="year">
											<option selected="" disabled="">年</option>
											<option>2021</option>
											<option>2022</option>
										</select>
										<select class="month">
											<option selected="" disabled="">月</option>
											<option>12</option>
											<option>01</option>
										</select>
										<select class="day">
											<option selected="" disabled="">日</option>
											<option>18</option>
											<option>19</option>
										</select>
									</dd>
								</dl>
								<dl>
									<dt>住所</dt>
									<dd>
										<p class="addrNumber"><input class="short" type="text" name=""></p>
										<div class="addrSelect">
											<select class="short">
												<option selected="" disabled="">選択してください</option>
												<option>xx県</option>
												<option>xx県</option>
											</select>
										</div>
										<p><input type="text" name="" placeholder="市区町村"></p>
									</dd>
								</dl>
								<dl>
									<dt>電話番号</dt>
									<dd><input type="text" name="" placeholder=""></dd>
								</dl>
								<dl>
									<dt>メールアドレス</dt>
									<dd><input type="text" name="" placeholder=""></dd>
								</dl>
								<div class="specialtyBox">
									<div class="specialtyItem">
										<div class="clone">
											<dl>
												<dt>学歴・経歴</dt>
												<dd>
													<p class="addrSelect"><input type="text" name="" placeholder=""></p>
													<select class="short">
														<option selected="" disabled="">年</option>
														<option>2021</option>
														<option>2022</option>
													</select>
												</dd>
											</dl>
										</div>
										<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg"
													alt="">学歴・経歴を追加</span></p>
									</div>
									<div class="specialtyItem">
										<div class="clone">
											<dl>
												<dt>免許・資格</dt>
												<dd>
													<p class="addrSelect"><input type="text" name="" placeholder=""></p>
													<select class="short">
														<option selected="" disabled="">年</option>
														<option>2021</option>
														<option>2022</option>
													</select>
												</dd>
											</dl>
										</div>
										<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg"
													alt="">免許・資格</span></p>
									</div>
								</div>
								<dl>
									<dt>志望動機</dt>
									<dd><textarea></textarea></dd>
								</dl>
								<dl>
									<dt>趣味・特技・PRポイント</dt>
									<dd><textarea></textarea></dd>
								</dl>
							</div>
						</div>
						<div class="fancyPersonBtn">
							<a href="#" class="fancyPersonCancel">キャンセル</a>
							<a href="#" class="fancyPersonSign">登録する</a>
						</div>
					</form>
				</div>
			</div> -->
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="subPagesHd">会員登録</h2>
							<ul class="stepUl">
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">ログイン</p>
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
								<ul class="loginSns">
									<li><a href="/register/facebook" target="_blank"><img src="img/login/login_facebook.svg"
										alt="Facebookでログイン"></a></li>
										<li><a href="/register/google" target="_blank"><img src="img/login/login_google.svg"
											alt="Googleでログイン"></a></li>
										</ul>
								<div class="contactBox">
									<p class="loginHd"><span>または</span></p>

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