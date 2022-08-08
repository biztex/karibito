<x-layout>
	<article>
		<body id="created">
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<ul class="stepUl">
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">仮登録</p>
								</li>
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">基本情報</p>
								</li>
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">完了</p>
								</li>
							</ul>
							<h2 class="registerHd">{{ \Auth::user()->name }} 様<br>会員登録ありがとうございます</h2>
							<p class="registerImg"><img src="img/login/img_register.png" alt=""></p>
							<ul class="loginFormBtn">
								<li><a href="{{ route('mypage') }}">プロフィールを登録</a></li>
								<li><a href="{{ route('home') }}">トップページへ戻る</a></li>
							</ul>
						</div>
					</div><!-- /#main -->
				</div><!--inner-->
			</div><!-- /#contents -->
	</article>
</x-layout>
