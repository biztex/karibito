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
							<p class="secretImg"><img src="img/secret/img_secret03.png" alt=""></p>
							<p class="secretStep">point 3</p>
							<p class="secretTitle"><span>相手に伝わる言い方を心がけましょう！</span></p>
							<p class="secretTxt">自分のイメージや要望は、相手に正しく伝わるよう具体的な言葉を用いましょう。例えば「おしゃれなデザイン」といっても、シンプルで洗練されたデザインなのか、カラフルで華やかなデザインなのか、受け取り方は人それぞれです。お互いのイメージにズレが生じないよう、具体的な言葉や表現で伝えましょう。チャットは資料も添付できるので、画像などを使って伝えるのも効果的です。</p>
							<p class="secretTxt">また、納期や金額などは曖昧な表現ではなく具体的な数字を使うようにしましょう。お互いが正確な数字を擦り合わせておくことで、トラブルやキャンセルの防止になります。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret02') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/5</option>
								<option value="{{ route('secret02') }}">2/5</option>
								<option value="{{ route('secret03') }}" selected>3/5</option>
								<option value="{{ route('secret04') }}">4/5</option>
								<option value="{{ route('secret05') }}">5/5</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret04') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
