<x-layout>
<article>
	<body id="mypage">
		<div id="breadcrumb">
			<div class="inner">
				<a href="/sample">ホーム</a>　>　<span>マイページ</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="#"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		<div class="unregisteredP">△身分証明書の登録が必要です。 <a href="#fancybox_register" class="fancybox">登録する</a></div>
		<div class="hide">
			<div id="fancybox_register" class="fancyboxWrap">
				<p class="fancyboxHd">身分証明証の登録</p>
				<div class="fancyboxCont">
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
				<p class="fancyRegisterUpload"><a href="#">身分証明書をアップロード</a></p>
				<p class="fancyRegisterSubmit"><a href="#">提出する</a></p>
			</div>
			<div id="fancybox_person" class="fancyboxWrap">
<!-- プロフィール編集モーダル -------------------------------------------------------------- -->
				<form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
				@csrf @method('put')
					<p class="fancyboxHd">プロフィールを編集</p>
					<div class="fancyboxCont">
						<div class="mypageCover" style="background: url({{asset('/storage/'.$user_profile->icon) }})no-repeat center center;">
							<!-- <a href="#"><img src="/img/mypage/icon_camera01.svg" alt=""></a> -->
								<input type="file" name="cover"><img src="/img/mypage/icon_camera01.svg" alt="">
							<!--  -->

						</div>
						<div class="fancyPersonPic">
							<!-- <p class="img"><img src="/img/mypage/pic_head.png" alt=""></p> -->
							<!-- <a href="#"><img src="/img/mypage/icon_camera02.svg" alt=""></a> -->
								<p class="img"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt=""></p>
								<input type="file" name="icon"><img src="/img/mypage/icon_camera02.svg" alt="">
							<!--  -->

						</div>
						<div class="fancyPersonTable">	
							<dl class="">
								<dt>ニックネーム</dt>
								<dd><input type="text" name="name" value="{{$user_profile->name}}"></dd>
							</dl>
							<dl class="">
								<dt>メールアドレス</dt>
								<dd><input type="text" name="email" value="{{$user_profile->email}}"></dd>
							</dl>
							<dl class=" inlineFlex">
								<dt>姓<span>(本名は非公開です)</span></dt>
								<dd><input type="text" name="first_name" value="{{$user_profile->first_name}}"></dd>
							</dl>
							<dl class=" inlineFlex">
								<dt>名<span>(本名は非公開です)</span></dt>
								<dd><input type="text" name="last_name" value="{{$user_profile->last_name}}"></dd>
							</dl>
							<dl>
								<dt>性別</dt>
								<dd>
									<select name="gender">
										<option disabled>選択してください</option>
										<option value="1" @if($user_profile->gender == 1) selected @endif>男</option>
										<option value="2" @if($user_profile->gender == 2) selected @endif>女</option>
									</select>
								</dd>
							</dl>
							<dl>
								<dt>生年月日<span>(年代のみ公開されます)</span></dt>
								<dd>
									<select class="year" name="year">
										<option selected="" disabled="">年</option>
										@for ($i = 1900; $i < 2023; $i++ )
											<option value="{{$i}}" @if(date("Y",strtotime($user_profile->birthday)) == $i) selected @endif>{{$i}}</option>
										@endfor
									</select>
									<select class="month" name="month">
										<option selected="" disabled="">月</option>
										@for ($i = 1; $i < 13; $i++ )
											<option value="{{$i}}" @if(date("n",strtotime($user_profile->birthday)) == $i) selected @endif>{{$i}}</option>
										@endfor
									</select>
									<select class="day" name="day" type="day">
										<option selected="" disabled="">日</option>
										@for ($i = 1; $i < 32; $i++ )
											<option value="{{$i}}" @if(date("j",strtotime($user_profile->birthday)) == $i) selected @endif>{{$i}}</option>
										@endfor
									</select>
								</dd>
							</dl>
							<dl>
								<dt>住所<span>(都道府県のみ表示されます)</span></dt>
								<dd>
									<p class="addrNumber"><input class="short" type="text" name="zip" value="{{$user_profile->zip}}"></p>
									<div class="addrSelect">
										<select class="short" name="prefecture">
										    <option selected="" disabled="">選択してください</option>
											@foreach($prefectures as $prefecture)
												<option value="{{$prefecture->id}}" @if($prefecture->id == $user_profile->prefecture_id) selected @endif>{{$prefecture->name}}</option>
											@endforeach
										</select>
									</div>
									<p><input type="text" name="address" placeholder="市区町村" value="{{$user_profile->address}}"></p>
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
								<dt>自己紹介</dt>
								<dd><textarea name="introduction">{{$user_profile->introduction}}</textarea></dd>
							</dl>
						</div>
					</div>
					<div class="fancyPersonBtn">
						<a href="#" class="fancyPersonCancel">キャンセル</a>
						<button type="submit" class="fancyPersonSign">登録する</button>
					</div>
				</form>
<!--　プロフィール編集モーダルここまで -------------------------------------------------------------- -->

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
						<button type="submit" class="fancyPersonSign">登録する</button>
					</div>
				</form>
			</div>
		</div>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="mypageWrap">
						<div class="mypageSec01">
							<div class="mypageCover" style="background: url({{asset('/storage/'.$user_profile->cover) }})no-repeat center center;">
								<!-- <a href="#"><img src="{{asset('/storage/'.$user_profile->cover) }}" alt="カバー写真を追加"></a> -->
									<a href="#"><img src="/img/mypage/icon_cover.svg" alt="カバー写真を追加"></a>
                                <!--  -->

							</div>
							<dl class="mypageDl01">
								<!-- <dt><img src="/img/mypage/pic_head.png" alt=""></dt> -->
								     <dt><img src="{{asset('/storage/'.$user_profile->icon) }}" alt=""></dt>
								<!--  -->
								<dd>
									<p class="mypageP01">{{$user_profile->name}} <a href="#fancybox_person" class="fancybox"><img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></p>
									<p class="mypageP02">最終ログイン：8時間前</p>
									<p class="mypageP03">({{$gender}} / {{$age}} / {{$user_prefecture}}) <span>所持ポイント：0000pt</span></p>
									<p class="mypageP04 check"><a href="#">本人確認済み</a><a href="#">機密保持契約(NDA) 可能</a></p>
									<p class="mypageP05"><a href="#" class="more">過去の評価を詳しく見る</a></p>
									<div class="mypageP06">
										<div class="evaluate three"></div><a href="#">(3.0)</a>
									</div>
								</dd>
							</dl>
							<div class="mypageIntro">
								<p class="mypageHd01">自己紹介</p>
								<p class="mypageIntroTxt">{!! nl2br(e($user_profile->introduction)) !!}</p>
							</div>
							<div class="mypageProud">
								<p class="mypageHd01">得意分野</p>
								<ul class="mypageProudUl">
									<li>家の掃除</li>
									<li>料理代行</li>
									<li>パソコン修理</li>
									<li>高齢者のお世話</li>
									<li>写真撮影代行</li>
									<li>ロゴデザイン</li>
								</ul>
							</div>
						</div>
						<div class="mypageShare"><a href="#">お友達を紹介して300pt GETする</a></div>
						<div class="mypageSec02">
							<p class="mypageHd02">お知らせ</p>
							<ul class="mypageUl02">
								<li>
									<a href="#">
										<dl>
											<dt><img src="/img/mypage/img_notice01.png" alt=""></dt>
											<dd>
												<p class="txt">事務局から個別メッセージ「ログイン通知」</p>
												<p class="time">0時間前</p>
											</dd>
										</dl>
									</a>
								</li>
								<li>
									<a href="#">
										<dl>
											<dt><img src="/img/mypage/img_notice01.png" alt=""></dt>
											<dd>
												<p class="txt">事務局から個別メッセージ「ログイン通知」</p>
												<p class="time">0時間前</p>
											</dd>
										</dl>
									</a>
								</li>
								<li>
									<a href="#">
										<dl>
											<dt><img src="/img/mypage/img_notice01.png" alt=""></dt>
											<dd>
												<p class="txt">事務局から個別メッセージ「ログイン通知」</p>
												<p class="time">0時間前</p>
											</dd>
										</dl>
									</a>
								</li>
								<li>
									<a href="#">
										<dl>
											<dt><img src="/img/mypage/img_notice01.png" alt=""></dt>
											<dd>
												<p class="txt">事務局から個別メッセージ「ログイン通知」</p>
												<p class="time">0時間前</p>
											</dd>
										</dl>
									</a>
								</li>
							</ul>
						</div>
						<div class="mypageSec03">
							<p class="mypageHd02">出品サービス<a href="#" class="more">出品サービスを編集する</a></p>
							<div class="box">
								<p class="title">出品サービス</p>
								<p class="txt">カリビトは、知識・スキル・経験を売り買いできるオンラインマーケットです。<br>あなたの ”得意” や ”経験” を必要としている人がきっといます。<br>カリビトで出品してみませんか？</p>
								<p class="link "><a href="#" class="more">追加する</a></p>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
			<div class="aboutFeatures">
				<div class="inner">
					<h2 class="hdM">カリビトの特徴</h2>
					<div class="slider">
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">検索機能</h3>
							<p class="ico ico_feat02"></p>
							<p>あなたの見たい情報を簡単に探せる<br>ために検索機能があります。<br>条件を入力するだけで簡単です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">シェア機能</h3>
							<p class="ico ico_feat03"></p>
							<p>いいなと思った仕事をSNSを使って<br>シェアすることができます。<br>仲の良いメンバーに知らせる時に便利。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">お気に入り機能</h3>
							<p class="ico ico_feat04"></p>
							<p>気になる仕事や人材を<br>お気に入り登録をする事で<br>分からなくなることがありません。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
					</div>
				</div>
			</div>
			<div class="downloadWrap">
				<div class="inner">
					<div class="img"><img src="/img/common/img_download.png" srcset="/img/common/img_download.png 1x, /img/common/img_download@2x.png 2x" alt=""><a href="#" target="_blank" class="logo sp"><img src="/img/common/ico_sns_logo.svg" alt="LOGO"></a></div>
					<div class="info">
						<h2 class="tit">さあ、はじめよう！<span class="foucs">今すぐ無料ダウンロード！</span></h2>
						<div class="links">
							<a href="#" target="_blank" class="logo pc"><img src="/img/common/ico_sns_logo.svg" alt="LOGO"></a>
							<a href="#" target="_blank"><img src="/img/common/btn_app.svg" alt="App Store"></a>
							<a href="#" target="_blank"><img src="/img/common/btn_google.svg" alt="Google"></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
	</body>
</article>
</x-layout>