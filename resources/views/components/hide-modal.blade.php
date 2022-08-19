<x-app>		
@auth
	<div class="hide">
		<!-- 身分証明証提出モーダル -------------------------------------------------------------- -->
			<div id="fancybox_register" class="fancyboxWrap">
			<div style="display:flex;justify-content:space-between">
				<a href="#" class="fancyPersonCancel" style="padding-left:10px; font-size:20px;">×</a>
				<p class="fancyboxHd">身分証明証の登録</p>
				<div></div>
			</div>
					
				<div class="fancyboxCont">

						@error('identification_path')
							<div class="alert alert-danger" style="margin:10px auto; font-size:14px;text-align:center;">{{ $message }}</div>
						@enderror

					<div class="fancyRegisterItem">
						<p class="txt">「身分証明書を登録する」とは、<br>信頼性を高めるため、本人であることを証明する書類を提出する手続きです。<br>身分証明書が承認されると、プロフィールに身分証明書提出済マークが表示されます。</p>
					</div>
					<div class="fancyRegisterItem">
						<p class="notice">注意事項</p>
						<p class="txt">カリビトアプリのプロフィールで、住所・氏名・生年月日はしっかり記載していますか?<br>身分証明書との一致が確認できないと本人確認はできないのでご注意ください!<br>登録いただいた３営業日以内にご返信します。<br>また、アップロードできる画像形式はJPEG/PNGのみです。</p>
					</div>
					<div class="fancyRegisterItem">
						<p class="txt">提出可能な本人確認書類は、下記となっております。</p>
						<p class="txt">【個人の場合】<br>運転免許証・健康保険証 / 被保険者証・旅券 / <br>パスポート・住民票・住民基本台帳カード・外国人証明書</p>
						<p class="txt">【法人の場合】<br>履歴事項全部証明書　(※3 ヵ月以内のものに限ります)</p>
					</div>
					<div class="fancyRegisterItem">
						<p class="txt">【カリビトアプリ登録情報】<br>都道府県:{{ $user_profile->prefecture->name }}<br>住所:{{ $user_profile->address }}<br>氏名:{{ $user_profile->first_name.$user_profile->last_name }}
															   <br>生年月日:@if($user_profile->birthday !== null){{ date("Y年n月j日",strtotime($user_profile->birthday)) }}@endif</p>
					</div>
					<div class="fancyRegisterItem">
						<p class="txt">安心安全のため、本人確認承認後はご住所 / 本名/ 生年月日のご変更ができなくなっておりますので、本人確認承認後にご住所 / 本名 / 生年月日をご変更されたい場合は、カリビト事務局へ、お問い合わせください</p>
					</div>
				</div>
				<p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集はこちら</a></p>
				@if(!empty($user_profile->zip) && !empty($user_profile->address) && !empty($user_profile->birthday))
					<form action="{{ route('identification') }}" method="POST" name="upload" enctype="multipart/form-data">
						@csrf
						<label>
							<input type="file" name="identification_path" style="display:none;"  accept="image/png,image/jpeg,">
							<p class="fancyRegisterUpload">身分証明書をアップロード</p>
						</label>
						
						<p class="fancyRegisterSubmit"><a href="#" onclick="document.upload.submit()">提出する</a></p>
					</form>
				@else
					<div class="fancyRegisterItem">
						<p class="txt">本人確認にはご住所 / 本名/ 生年月日のご登録が必要です。<br/>「プロフィール編集はこちら」より、郵便番号・住所の登録をお願いいたします。</p>
					</div>
				@endif
			</div>

		<!-- プロフィール編集モーダル -------------------------------------------------------------- -->
		@include('components.hide-modal.profile')
		
		<!--　履歴書作成モーダル -------------------------------------------------------------- -->
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
									<p class="specialtyBtn"><span><img src="/img/mypage/icon_add.svg" alt="">学歴・経歴を追加</span></p>
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
									<p class="specialtyBtn"><span><img src="/img/mypage/icon_add.svg" alt="">免許・資格</span></p>
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
	</div>

@endauth
</x-app>
@if(isset($errors))
<script>
	$(function(){

		// バリデーションエラーの際、モーダルを最初から表示する
        if (@json($errors->has('identification_path'))){
                $('.fancybox_register').trigger('click');
                $('html').addClass('fancybox-margin');
                $('html').addClass('fancybox-lock');
                $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
        } else if (@json($errors->has('name') || $errors->has('first_name') || $errors->has('last_name') || $errors->has('gender') || $errors->has('birthday') || $errors->has('prefecture') || $errors->has('zip') || $errors->has('address') || $errors->has('introduction') || $errors->has('icon') || $errors->has('cover') || $errors->has('content') || $errors->has('arr_content') )) {
					$('.fancybox').trigger('click');
                    $('html').addClass('fancybox-margin fancybox-lock');
                    $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
		}
	})
</script>
@endif