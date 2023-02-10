<x-layout>
<x-parts.post-button/>
	<article>
	<body id="secret">
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
							<p class="secretHd"><img src="img/secret/hd_secret.svg" alt="カリビトチャットのコツ"></p>
							<p class="secretImg"><img src="img/secret/img_secret01.png" alt=""></p>
							<p class="secretStep">point 1</p>
							<p class="secretTitle"><span>丁寧な言葉遣いをしましょう！</span></p>
							<p class="secretTxt">カリビトチャットは顔の見えない人同士のやり取りとなります。その為、言葉の印象がダイレクトにあなたの印象に結びつきます。</p>
							<p class="secretTxt">例えば、せっかく購入者の方が素敵なスキルだと感じても、出品車の方のチャットがタメ口であれば、不快に感じてしまい購入に繋がりません。また、購入者の方のチャットが不躾な印象を与えてしまうと、出品者から「サービスの提供」通知が送られてこない場合もあります。</p>
							<p class="secretTxt">どのような場面でも敬語を使うことを大切にし、相手の方に配慮した言葉遣いを心がけましょう。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret05') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}" selected>1/5</option>
								<option value="{{ route('secret02') }}">2/5</option>
								<option value="{{ route('secret03') }}">3/5</option>
								<option value="{{ route('secret04') }}">4/5</option>
								<option value="{{ route('secret05') }}">5/5</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret02') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
