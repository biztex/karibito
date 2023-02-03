<x-layout>
<x-parts.post-button/>
	<article id="secret">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>カリビトチャットのコツ</span>
			</div>
		</div><!-- /.breadcrumb -->

		<x-parts.ban-msg/>
		<x-parts.flash-msg />

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="secretWrap">
						<div class="secretBox">
							<p class="secretHd"><img src="img/secret/hd_secret.svg" alt="上手にマッチングする秘訣"></p>
							<p class="secretImg"><img src="img/secret/img_secret04.png" alt=""></p>
							<p class="secretStep">STEP 4</p>
							<p class="secretTitle"><span>お見積りを提出する際には必ず<br class="sp">「内訳」を記入する</span></p>
							<p class="secretTxt">見積金額にはトータルの金額だけではなく、金額の内訳を明記しておきましょう。例えば、「提案内容」の欄にこのように記載するイメージです。</p>
							<div class="secretPrice">
								<p class="txt">（例）お店のショップカードの製作依頼<br class="pc">合計：50,000 円</p>
								<p class="txt">＜内訳＞ データ制作：30,000 円<br>　　　　 印刷代金：15,000 円<br>　　　　 ai データのお渡し：5,000 円</p>
								<p class="img"><img src="img/secret/img_price.png" alt=""></p>
							</div>
							<p class="secretTxt">金額の内訳を明記しておくことで、何にいくらかかるのかを購入者が把握できるとともに、見積り金額の納得感が増します。全体の作業内容の確認にもなり、トラブル防止にもつながります。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret03') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/6</option>
								<option value="{{ route('secret02') }}">2/6</option>
								<option value="{{ route('secret03') }}">3/6</option>
								<option value="{{ route('secret04') }}" selected>4/6</option>
								<option value="{{ route('secret05') }}">5/6</option>
								<option value="{{ route('secret06') }}">6/6</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret05') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
