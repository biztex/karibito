<x-layout>
	<x-parts.post-button/>
	<div id="blog">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>ブログ</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.flash-msg/>

		<div id="contents" class="otherPage">
		{{-- <div id="contents" class="oneColumnPage02"> 元々はこのクラス名が指定されていたが、サイドメニューの位置がおかしくなったためコメントアウト--}}
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogDtWrap">
						<div class="">
							<p class="blogItemImg"><img src="img/blog/img_detail01_01.jpg" alt=""></p>
							<p class="blogItemHd">イラストレーター(ai)の不明な点にお答えします</p>
							<p class="blogItemBread"><a href="#">デザイン </a>　>　<span>その他デザイン</span></p>
							<dl class="blogItemPerson">
								<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
								<dd>
									<p class="nameP">クリエイター名</p>
									<p class="dateP">2021年7月26日</p>
								</dd>
							</dl>
							<div class="blogItemCont">
								<p>参考書やネットを見てもわからない点を是非、ご質問ください！<br>イラストレーターは年々、更新されており、常に新機能が追加されています。参考書やネット見ても自分のバージョンとは違って、よくわからないことがよくあると思います。<br>「アピアランスってなに？」<br>「このツールはどう使うの？」<br>「便利なスクリプトはありますか？」など<br>そんな方にメッセージと図を入れてご説明いたします。<br>デザイン会社で勤める上で便利な小ワザも併せて教えます。<br>またデザインのちょっと悩みにもお答えします。<br>「どんなレイアウトがいいのか？」<br>「見出し、小見出しのメリハリのつけ方」<br>「色の選び方など」</p>
								<p>通常はテキストのみの説明になりますが、PDFやデータによる説明をご希望の際は<br>恐れ入りますが、オプションをご購入ください。<br>※イラストレータは最新バージョンまで対応しています。<br>※その他、ご不明な点や不安な点は「ダイレクトメッセージ」にてお気軽にお問い合わせください。<br>自身もイラストレーターを扱う中でわからない点が多々出てきました。そんな時、友達や同僚でわかる人がいればいいんですが、もし、１人で悩んで何千円もする参考書を買うのであれば、是非、ご依頼ください！<br>購入にあたってのお願い</p>
								<p>・簡単な内容であれば、その日にご返答いたします。内容によってはご返答できない場合もございます。その際はキャンセルさせていただきます。恐れ入りますが、ご容赦ください。<br>・返信が10日以上無い場合など、予告なしにお取引をお断りさせていただくこともありますのでご了承ください。もし返信が遅くなる場合はメッセージをお待ちしております。</p>
							</div>
							<div class="recommendList style2 blogDtList">
								<div class="list sliderSP02">
									<div class="item">
										<a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
											<img src="img/common/img_270x160.png" alt="">
											<button class="favorite">お気に入り</button>
										</a>
										<div class="info">
											<div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
											<div class="draw">
												<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
											</div>
											<div class="single">
												<span>単発リクエスト</span>
												<a href="#">対面</a>
											</div>
											<div class="aboutUser">
												<div class="user">
													<p class="ico"><img src="img/common/ico_head.png" alt=""></p>
													<div class="introd">
														<p class="name">クリエイター名</p>
														<p>(女性/ 20代/ 東京都)</p>
													</div>
												</div>
												<p class="check"><a href="#">本人確認済み</a></p>
												<div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<ul class="detailSns">
								<li><a href="#"><img src="img/mypage/ico_facebook.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_line.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_twitter.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_mail.svg" alt=""></a></li>
							</ul>
							<div class="blogDtOther">
								<dl class="blogItemPerson">
									<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
									<dd>
										<p class="nameP">クリエイター名</p>
										<p class="dateP">(女性/ 20代/ 東京都)</p>
									</dd>
								</dl>
								<div class="blogDtOtherBtn">
									<a href="#" class="followA">フォローする</a>
									<a href="#">メッセージを送る</a>
								</div>
							</div>
							<p class="blogAll"><a href="blog.html">一覧へ戻る</a></p>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!--contents-->
	</div><!--blog-->
<x-hide-modal/>
</x-layout>