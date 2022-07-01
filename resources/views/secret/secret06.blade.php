<x-layout>
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>マッチングする秘訣</span>
			</div>
		</div><!-- /.breadcrumb -->

		<x-parts.flash-msg />

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="secretWrap">
						<div class="secretBox">
							<p class="secretHd"><img src="img/secret/hd_secret.svg" alt="上手にマッチングする秘訣"></p>
							<p class="secretImg"><img src="img/secret/img_secret06.png" alt=""></p>
							<p class="secretStep">STEP 6</p>
							<p class="secretTitle"><span>「自分の強み」を伝える</span></p>
							<p class="secretTxt">購入者は、あなたを含む複数の出品者の中から比較検討していることがあります。そこで、購入者が自分と契約する事によりどのようなメリットがあるか、「自分の強み」を伝えましょう。例えば、過去の対応経験を示すのも一つの手です。実際の事例・ポートフォリオなどを見せられる場合は参考資料として添付しましょう。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret05') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option value="{{ route('secret01') }}">1/6</option>
								<option value="{{ route('secret02') }}">2/6</option>
								<option value="{{ route('secret03') }}">3/6</option>
								<option value="{{ route('secret04') }}">4/6</option>
								<option value="{{ route('secret05') }}">5/6</option>
								<option value="{{ route('secret06') }}" selected>6/6</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret01') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
