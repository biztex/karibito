<x-layout>
<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<span>カリビト知恵袋</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="#"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
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
				<form>
					<p class="fancyboxHd">プロフィールを編集</p>
					<div class="fancyboxCont">
						<div class="mypageCover">
							<a href="#"><img src="/img/mypage/icon_camera01.svg" alt=""></a>
						</div>
						<div class="fancyPersonPic">
							<p class="img"><img src="/img/mypage/pic_head.png" alt=""></p>
							<a href="#"><img src="/img/mypage/icon_camera02.svg" alt=""></a>
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
									<p class="specialtyBtn"><span><img src="/img/mypage/icon_add.svg" alt="">得意分野を追加</span></p>
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
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="faqDtWrap">
						<div class="faqDtTop">
							<div class="faqDtTopHd">
								<p class="txt">回答受付終了まであと1日</p>
								<p class="number">3回答</p>
							</div>
							<dl class="faqDtUser">
								<dt><img src="/img/service/ico_head.png" alt=""></dt>
								<dd>
									<p class="name">クリエイター名</p>
									<p class="date">2021年7月26日　13:43</p>
								</dd>
							</dl>
							<div class="faqDtTxt">
								<p>この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
							</div>
							<p class="faqDtBtn"><a href="#">ログインして回答する</a></p>
						</div>
						<div class="faqDtAnswer">
							<p class="faqDtAnswerHd">回答ユーザー</p>
							<div class="faqDtAnswerItem">
								<div class="faqDtAnswerBest"><input id="best01_01" type="radio" name="best01"><label for="best01_01"><span>ベスト回答に選ぶ</span></label></div>
								<dl class="faqDtUser">
									<dt><img src="/img/service/ico_head.png" alt=""></dt>
									<dd>
										<p class="name">クリエイター名</p>
										<p class="date">2021年7月26日　13:43</p>
									</dd>
								</dl>
								<div class="faqDtTxt">
									<p>この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
									<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								</div>
							</div>
							<div class="faqDtAnswerItem">
								<div class="faqDtAnswerBest"><input id="best01_02" type="radio" name="best01"><label for="best01_02"><span>ベスト回答に選ぶ</span></label></div>
								<dl class="faqDtUser">
									<dt><img src="/img/service/ico_head.png" alt=""></dt>
									<dd>
										<p class="name">クリエイター名</p>
										<p class="date">2021年7月26日　13:43</p>
									</dd>
								</dl>
								<div class="faqDtTxt">
									<p>この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
									<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								</div>
							</div>
							<div class="faqDtAnswerItem">
								<div class="faqDtAnswerBest"><input id="best01_03" type="radio" name="best01"><label for="best01_03"><span>ベスト回答に選ぶ</span></label></div>
								<dl class="faqDtUser">
									<dt><img src="/img/service/ico_head.png" alt=""></dt>
									<dd>
										<p class="name">クリエイター名</p>
										<p class="date">2021年7月26日　13:43</p>
									</dd>
								</dl>
								<div class="faqDtTxt">
									<p>この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
									<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<aside id="side" class="pc">
					<div class="sidePerson">
						<div class="sidePersonPic">
							<p class="img"><img src="/img/mypage/pic_head.png" alt=""></p>
						</div>
						<p class="sidePersonName">クリエイター名</p>
						<p class="sidePersonEdit"><a href="#fancybox_person" class="fancybox"><img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></p>
					</div>
					<div class="sideItem">
						<ul class="sideUl01">
							<li><a href="#" class="">マイページ</a></li>
							<li><a href="#" class="">お気に入り</a></li>
							<li><a href="#" class="">過去の取引</a></li>
							<li><a href="#" class="">掲載内容一覧</a></li>
							<li><a href="#" class="">決済履歴</a></li>
							<li><a href="#" class="">ポイント取得・利用履歴</a></li>
							<li><a href="#" class="">フォロー・フォロワー</a></li>
							<li><a href="#" class="">プロモーション・お知らせ</a></li>
							<li><a href="#" class="is_active">カリビト知恵袋</a></li>
							<li><a href="#" class="">会員情報</a></li>
							<li><a href="#" class="">掲載内容の下書き</a></li>
							<li><a href="#" class="">見積書の作成・管理</a></li>
							<li><a href="#" class="">履歴書の作成・管理</a></li>
							<li><a href="#" class="">お知らせ機能の設定</a></li>
						</ul>
					</div>
					<div class="sideItem">
						<p class="sideHd">クーポン</p>
						<ul class="sideUl02">
							<li><a href="#" class="icon01">クーポン</a></li>
							<li><a href="#" class="icon02">招待して０００ポイントGET</a></li>
						</ul>
					</div>
					<div class="sideItem">
						<p class="sideHd">アプリについて</p>
						<ul class="sideUl01">
							<li><a href="#">お問い合わせ</a></li>
							<li><a href="#">ご利用ガイド</a></li>
							<li><a href="#">カテゴリー項目追加依頼</a></li>
							<li><a href="#">個人情報の取り扱いについて</a></li>
							<li><a href="#">特定商取引法に基づく表記</a></li>
							<li><a href="#">利用規約</a></li>
							<li><a href="#">運営会社について</a></li>
							<li><div class="edition">バージョン <span>00.0000,00</span></div></li>
						</ul>
					</div>
				</aside><!-- /#side -->
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
	</article>
</x-layout>