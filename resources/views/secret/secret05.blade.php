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
							<p class="secretImg"><img src="img/secret/img_secret05.png" alt=""></p>
							<p class="secretStep">STEP 5</p>
							<p class="secretTitle"><span>相手にも伝わるよう<br class="sp">「分かりやすい言葉」を使う</span></p>
							<p class="secretTxt">依頼する側が必ずしもその分野に詳しいとは限りません。言葉一つで認識の齟齬が生まれてしまうことがあります。やり取りにあたっては専門用語などの難しい言葉は避け、できるだけ噛み砕いて、相手にも伝わるような分かりやすい言葉を使うようにしましょう。</p>
							<ul class="secretUl">
								<li>専門用語は控えて分かりやすい言葉で</li>
								<li>丁寧な言葉遣いを気にするといいよ</li>
							</ul>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret04') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/6</option>
								<option value="{{ route('secret02') }}">2/6</option>
								<option value="{{ route('secret03') }}">3/6</option>
								<option value="{{ route('secret04') }}">4/6</option>
								<option value="{{ route('secret05') }}" selected>5/6</option>
								<option value="{{ route('secret06') }}">6/6</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret06') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
