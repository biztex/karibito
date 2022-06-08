<x-app>		


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
						<p class="txt">カリビトアプリのプロフィールで、住所・氏名・生年月日はしっかり記載していますか?<br>身分証明書との一致が確認できないと本人確認はできないのでご注意ください!<br>登録いただいた３営業日以内にご返信します。</p>
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
						<p class="txt">安心安全のため、本人確認承認後はご住所 / 本名/ 生年月日のご変更ができなくなっておりますので、本人確認承認後にご住所 / 本名 / 生年月日をご変更されたい場合は、カリビト事務局へ、お問い合わせください</p>
					</div>
				</div>
				<p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集はこちら</a></p>

				<form action="{{ route('identification') }}" method="POST" name="upload" enctype="multipart/form-data">
					@csrf
					<label>
						<input type="file" name="identification_path" style="display:none;"  accept=".png,.jpg">
						<p class="fancyRegisterUpload">身分証明書をアップロード</p>
					</label>
					
					<p class="fancyRegisterSubmit"><a href="#" onclick="document.upload.submit()">提出する</a></p>
				</form>
			</div>

		<!-- プロフィール編集モーダル -------------------------------------------------------------- -->
		@if(!empty($user_profile))
			<div id="fancybox_person" class="fancyboxWrap" style="display:none;">
				<form method="POST" action="{{ route('user_profile.update') }}" enctype="multipart/form-data">
				@csrf @method('PUT')
					<p class="fancyboxHd">プロフィールを編集</p>
					<div class="fancyboxCont">

						<div class="mypageCover mypageCoverUpdate">
							@if(empty($user_profile->cover))
								<img id="preview_cover" alt="" src="/img/mypage/img_rainbow.png" style="">
							@else
								<img id="preview_cover" alt="" src="{{asset('/storage/'.$user_profile->cover) }}" style="">
							@endif
								<input type="file" name="cover" class="cover2" accept="image/*" style="display:none;">
								<a href="#"><img clsaa="center_cam" src="/img/mypage/icon_camera01.svg" alt="" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"></a>
						</div>

							<div class="fancyPersonPic">
								<p class="img">
									@if(empty($user_profile->icon))
										<img id="preview_icon" alt=""  src="/img/mypage/pic_head.png" style="width: 140px;height: 140px;object-fit: cover;">
									@else
										<img id="preview_icon" alt=""  src="{{asset('/storage/'.$user_profile->icon) }}" style="width: 140px;height: 140px;object-fit: cover;">
									@endif
									<input type="file" name="icon" accept="image/*" style="display:none;">
									<a href="#"><img clsaa="center_cam" src="/img/mypage/icon_camera01.svg" alt="" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"></a>
								</p>
							</div>

							<div class="fancyImgBtn">
								<a href="{{route('cover.delete')}}">カバーを削除する</a>
								<a href="{{route('icon.delete')}}">アイコンを削除する</a>
							</div> 

								@error('icon')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								@error('cover')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

						<div class="fancyPersonTable">	
							<dl class="">
								<dt>ニックネーム</dt>
								@error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<dd><input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{old('name',\Auth::user()->name)}}"></dd>
							</dl>
								<dl>
								
								</dl>
								<dl style="margin-bottom:0px">
									@if($errors->has('first_name'))
										<div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('first_name')}}</div>
									@elseif($errors->has('last_name'))
										<div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('last_name')}}</div>
									@else
										<!--  -->
									@endif
								</dl>
							<dl class=" inlineFlex">
								<dt>姓<span>(本名は非公開です)</span></dt>
								<dd><input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" value="{{old('first_name',$user_profile->first_name)}}"></dd>
							</dl>
							<dl class=" inlineFlex">
								<dt>名<span>(本名は非公開です)</span></dt>
								<dd><input type="text" name="last_name" class="@error('last_name') is-invalid @enderror" value="{{old('last_name',$user_profile->last_name)}}"></dd>
							</dl>
							<dl>
								<dt>性別</dt>
								<dd>
									<select name="gender">
									@error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
										<option disabled>選択してください</option>
										<option value="1" @if('1' == (int)old('gender',$user_profile->gender)) selected @endif>男</option>
										<option value="2" @if('2' == (int)old('gender',$user_profile->gender)) selected @endif>女</option>
									</select>
								</dd>
							</dl>
							<dl>
								<dt>生年月日<span>(年代のみ公開されます)</span></dt>
									@error('birthday')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
								<dd>
									<select class="year" name="year">
										<option value="">年</option>
										@for ($i = 1900; $i < 2023; $i++ )
											<option value="{{$i}}" @if($i == old('year', date("Y",strtotime($user_profile->birthday)))) selected @endif>{{$i}}</option>
										@endfor
									</select>
									<select class="month" name="month">
										<option value="">月</option>
										@for ($i = 1; $i < 13; $i++ )
											<option value="{{$i}}" @if($i == old('month', date("n",strtotime($user_profile->birthday)))) selected @endif>{{$i}}</option>
										@endfor
									</select>
									<select class="day" name="day" type="day">
										<option value="">日</option>
										@for ($i = 1; $i < 32; $i++ )
											<option value="{{$i}}" @if($i == old('day', date("j",strtotime($user_profile->birthday)))) selected @endif>{{$i}}</option>
										@endfor
									</select>
								</dd>
							</dl>
							<dl>
								<dt>住所<span>(都道府県のみ表示されます)</span></dt>
								    @error('zip')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
								<dd>
									<p class="addrNumber"><input class="short" type="text" name="zip" value="{{old('zip',$user_profile->zip)}}"></p>
									<div class="addrSelect">
										<select class="short" name="prefecture">
										    <option value="">選択してください</option>
											@foreach($prefectures as $prefecture)
												<option value="{{$prefecture->id}}" @if($prefecture->id == (int)old('prefecture',$user_profile->prefecture_id)) selected @endif>{{$prefecture->name}}</option>
											@endforeach
										</select>
									</div>
									@error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
									<p><input type="text" name="address" placeholder="市区町村" value="{{old('address',$user_profile->address)}}"></p>
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
									<p class="specialtyBtn"><span><img src="/img/mypage/icon_add.svg" alt="">得意分野を追加</span></p>
								</div>
							</div>
							<dl>
									@error('introduction')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
								<dt>自己紹介</dt>
								<dd><textarea name="introduction">{{old('introduction',$user_profile->introduction)}}</textarea></dd>
							</dl>
						</div>
					</div>
					<div class="fancyPersonBtn">
						<a href="#" class="fancyPersonCancel">キャンセル</a>
						<button type="submit" class="fancyPersonSign">登録する</button>
					</div>
				</form>
			</div>
		@endif

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
									<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">学歴・経歴を追加</span></p>
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
									<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">免許・資格</span></p>
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


</x-app>