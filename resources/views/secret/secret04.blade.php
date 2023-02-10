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
							<p class="secretImg"><img src="img/secret/img_secret04.png" alt=""></p>
							<p class="secretStep">point 4</p>
							<p class="secretTitle"><span>進捗報告しましょう！</span></p>
							<p class="secretTxt">円滑に取引を進めるためには、適切な頻度で進捗報告を行うことが重要です。進捗報告をすることで、お互いが現状をきちんと把握し、必要に応じて早い段階で軌道修正をすることができます。<br>もし進捗報告を行わず作業を進めた場合、納品されるものがイメージと大きく違うなどの問題が生じたり、修正のために納期を遅延してしまうかもしれません。そういったトラブルを未然に防ぐためにも、進捗報告は適切な頻度で行いましょう。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret03') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/5</option>
								<option value="{{ route('secret02') }}">2/5</option>
								<option value="{{ route('secret03') }}">3/5</option>
								<option value="{{ route('secret04') }}" selected>4/5</option>
								<option value="{{ route('secret05') }}">5/5</option>
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
