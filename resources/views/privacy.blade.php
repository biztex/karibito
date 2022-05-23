<x-layout>
	<article>
		<body id="privacy">
			<div id="breadcrumb">
				<div class="inner">
					<a href="index.html">ホーム</a>　>　<span>個人情報の取り扱いについて</span>
				</div>
			</div><!-- /.breadcrumb -->
			<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
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
										<p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">得意分野を追加</span></p>
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
			<div id="contents" class="oneColumnPage">
				<div class="inner">
					<div id="main">
						<div class="subPagesWrap">
							<h2 class="subPagesHd">個人情報の取り扱いについて</h2>
							<div class="privacyTop">
								<p>株式会社　アクティブフィーリング以下「当社」といいます。）は、お客様の個人情報に関する法令を遵守し、以下に示すポリシーに従い、適切な取扱い及び保護に努めます。</p>
							</div>
							<div class="privacyItem">
								<h3>収集、利用目的</h3>
								<p>当社では、お客様から、商品購入、プレゼントや懸賞への応募、アンケートの回答、メルマガの登録のなどの際に、ご提供頂いた個人情報を下記目的の範囲内で利用させて頂きます。<br><br>※お客様から個人情報を収集する場合は、利用目的をお知らせし、お客様からの同意を頂きご登録頂いております。</p>
								<ul>
									<li>・商品・サービスの提供の為。</li>
									<li>・情報提供の為</li>
									<li>・お客様へより良い商品・サービスを提供する為の統計、分析資料とする為。</li>
									<li>・その他、サービスや運営上必要な連絡の為。</li>
								</ul>
							</div>
							<div class="privacyItem">
								<h3>安全管理</h3>
								<p>当社では、お預かりした個人情報を適切に取り扱い・安全な管理を行います。安全対策を講じ、不正アクセス、紛失、改ざん及び漏洩などの防止に努めます。</p>
							</div>
							<div class="privacyItem">
								<h3>開示、提供</h3>
								<p>原則的には、お客様の個人情報を第三者に開示致しませんが、下記の場合は、法律に基づき開示する事があります。</p>
								<ul>
									<li>・お客様から事前に同意を得ている場合。</li>
									<li>・商品の配送等、お客様が希望されるサービスを行う為、当社が業務委託先に必要な範囲で開示、提供が必要と判断した場合。</li>
									<li>・決済会社での本人確認、請求先確認及び与信調査のため決済会社に個人情報を開示することがございます。</li>
									<li>・警察署、裁判所等、公的機関より開示の申し出があった場合。</li>
									<li>・当社の権利、財産を保護する為に必要であると判断した場合。</li>
								</ul>
							</div>
							<div class="privacyItem">
								<h3>開示、訂正、削除</h3>
								<p>お客様が、ご自身の個人情報に関する開示、訂正、削除を希望される場合には、合理的な範囲で速やかに対応させて頂きます。</p>
							</div>
							<div class="privacyItem">
								<h3>Cookie（クッキー）について</h3>
								<p>Cookieは、ウェブサイトからお客様のブラウザに送ることのできるテキスト・データで、Cookieを受け取ることを了承頂いた場合に、Cookieはお客様のご使用になられたコンピューターのハードディスクドライブ内に記憶されます。<br>お客様が本ウェブサイトを再度訪問されたときなどは、必ずCookieを有効に設定してください。なお、Cookieはお客様個人を識別するものではありません。Cookieを無効に設定されると、本ウェブサイトにおけるサービスが正常にご利用できませんので、予めご了承ください。</p>
							</div>
							<div class="privacyItem">
								<h3>SSLについて</h3>
								<p>本ウェブサイトでは会員登録の際など、個人情報が送受信されるページにおいて、SSL（Secure Socket Layer）による暗号化通信を使用し、お客様の個人情報を外部の第三者に通信傍受されても解析できないようにするための対策を行っております。</p>
							</div>
							<div class="privacyItem">
								<h3>ログについて</h3>
								<p>お客様が本ウェブサイトをアクセスされたことについて、その操作の情報をアクセスログという形で記録しています。<br>このログは個人を特定できる情報を含むものではありませんが、今後のサイトの利便性向上の為や、万が一問題が発生した際の原因追求、利用状況に関する統計・分析処理などに使用する為に採取をしており、それ以外の目的には使用致しません。</p>
							</div>
							<div class="privacyItem">
								<h3>その他</h3>
								<p>今後、当社は、プライバシーポリシーを一部又は全部を改定する事があります。重要な改定がある場合には、Webサイトにおいてお知らせいたします。</p>
							</div>
						</div>
					</div><!-- /#main -->

				</div><!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-layout>