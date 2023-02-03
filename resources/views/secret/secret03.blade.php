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
							<p class="secretImg"><img src="img/secret/img_secret03.png" alt=""></p>
							<p class="secretStep">STEP 3</p>
							<p class="secretTitle"><span>納期・スケジュールを<br class="sp">「具体的に」記載する</span></p>
							<p class="secretTxt">依頼をする購入者にとって急ぎの場合、こちらの希望する納期に間に合うかどうか・どのようなスケジュールで進行するかは非常に重要なポイントです。納期・スケジュールが具体的に記載されていると、購入者は安心して提案を購入する事ができます。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret02') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
								<option value="{{ route('secret01') }}">1/6</option>
								<option value="{{ route('secret02') }}">2/6</option>
								<option value="{{ route('secret03') }}" selected>3/6</option>
								<option value="{{ route('secret04') }}">4/6</option>
								<option value="{{ route('secret05') }}">5/6</option>
								<option value="{{ route('secret06') }}">6/6</option>
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
