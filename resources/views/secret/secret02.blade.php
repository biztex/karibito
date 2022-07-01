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
							<p class="secretImg"><img src="img/secret/img_secret02.png" alt=""></p>
							<p class="secretStep">STEP 2</p>
							<p class="secretTitle"><span>「相手が何を求めているのか」<br>カリビトチャットを使ってヒアリングできていますか？</span></p>
							<p class="secretTxt">まず相談をする前に、依頼に関する情報は十分に集まっているか確認しましょう。一度あなたの中で整理をしてみて相手の方は何を必要としているかを理解する事を考えてみましょう。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret01') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option value="{{ route('secret01') }}">1/6</option>
								<option value="{{ route('secret02') }}" selected>2/6</option>
								<option value="{{ route('secret03') }}">3/6</option>
								<option value="{{ route('secret04') }}">4/6</option>
								<option value="{{ route('secret05') }}">5/6</option>
								<option value="{{ route('secret06') }}">6/6</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret03') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
