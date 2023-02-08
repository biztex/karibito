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
							<p class="secretImg"><img src="img/secret/img_secret02.png" alt=""></p>
							<p class="secretStep">point 2</p>
							<p class="secretTitle"><span>メッセージには素早く反応しましょう！</span></p>
							<p class="secretTxt">届いたチャットには、出来る限り迅速に返信しましょう。迅速に返信することで、やり取りが円滑に進むだけでなく、お互いの信頼性もアップします。もし、すぐに確かな返信ができない場合は、「承知いたしました。〇時までにご返信いたします。」と一言送ることで、相手に安心してもらえます。</p>
							<p class="secretTxt">チャット内のやり取りや通知は、メールで受け取ることができます。通知によっては返信期限が設定されているものもあるので、「うっかり見過ごしてしまった」ということがないよう、日頃から通知設定を確認しておきましょう。通知の設定は、マイページの会員情報から行っていただけます。</p>
						</div>
						<div class="secretPager">
							<div class="secretPagerPrev"><a href="{{ route('secret01') }}">前へ</a></div>
							<select onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option value="{{ route('secret01') }}">1/5</option>
								<option value="{{ route('secret02') }}" selected>2/5</option>
								<option value="{{ route('secret03') }}">3/5</option>
								<option value="{{ route('secret04') }}">4/5</option>
								<option value="{{ route('secret05') }}">5/5</option>
							</select>
							<div class="secretPagerNext"><a href="{{ route('secret03') }}">次へ</a></div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
