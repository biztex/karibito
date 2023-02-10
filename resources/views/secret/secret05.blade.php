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
							<p class="secretHd"><img src="img/secret/hd_secret.svg" alt="カリビトチャットのコツ"></p>
							<p class="secretImg"><img src="img/secret/img_secret05.png" alt=""></p>
							<p class="secretStep">point 5</p>
							<p class="secretTitle"><span>やり取りは必ずカリビトチャット内で<br class="sp">行いましょう！</span></p>
							<p class="secretTxt">お互いが安心・安全に取引を進めるために、やり取りはすべてカリビトチャット内で行うようしましょう。</p>
							<p class="secretTxt">ZoomやLINEなどの外部ツールを使ったり、直接的にやり取りをされた場合、万が一トラブルが発生しても運営側のサポートが一切受けられなくなります。安全に取引を進めるために、やり取りは必ずカリビトチャットを通じて行いましょう。</p>
							<p class="secretTxt">気持ちよくサービスをご利用いただくために、カリビトでは外部取引や、メールアドレスやURLを送るなどの外部誘導、またそれらに応じる行為を禁止しております。<br>もしそのような提案をされた場合は、運営側にご相談ください。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret04') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/5</option>
								<option value="{{ route('secret02') }}">2/5</option>
								<option value="{{ route('secret03') }}">3/5</option>
								<option value="{{ route('secret04') }}">4/5</option>
								<option value="{{ route('secret05') }}" selected>5/5</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret01') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
