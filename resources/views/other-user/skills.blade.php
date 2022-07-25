<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
				<li><a href="#">評価</a></li>
				<li><a href="#" class="is_active">スキル・経歴</a></li>
				<li><a href="#">ポートフォリオ</a></li>
				<li><a href="{{ route('user.publication', $user->id) }}">出品サービス</a></li>
				<li><a href="#">ブログ</a></li>
			</ul>
		</div>
	</div>
	<x-parts.post-button/>
	<article>
        <x-parts.flash-msg/>
        <div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="">

						<div class="mypageSec04">
							<p class="mypageHd02"><span>スキル・経歴・職務</span></p>
							<div class="mypageItem">
								<p class="mypageHd03">スキル</p>
								<div class="mypageBox">
									<dl class="mypageDl02">
										<dt>スキル詳細</dt>
										<dd>
											<ul class="mypageUl03">
												@foreach($skills as $skill)
													<li><span>{{ $skill->name }}</span>経験：{{ $skill->year }}年</li>
												@endforeach
											</ul>
										</dd>
									</dl>
								</div>
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">経歴</p>
								<div class="mypageBox">
									<ul class="mypageUl03">
										@foreach($careers as $career)
											<li>
												<dl class="mypageDl02">
													<dt>経歴名</dt>
													<dd><span>{{ $career->name }}</span></dd>
												</dl>
												<dl class="mypageDl02">
													<dt>在籍期間</dt>
													<dd>{{ $career->first_year }}年 {{ $career->first_month }}月 〜 {{ $career->last_year }}年 {{ $career->last_month }}月</dd>
												</dl>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">職務</p>
								<div class="mypageBox">
									<div class="mypageDuties" style="word-wrap: break-word;">
										<p>@if(!is_null($jobs)){!!nl2br($jobs->content)!!}@endif</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<aside id="side" class="">
					<div class="box seller">
						<h3>スキル出品者</h3>
						@if(null !== $user->userProfile->icon)
							<a href="#" class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
						@else
							<a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
						@endif
						<!-- <p class="login">最終ログイン：8時間前</p> -->
						<p class="introd"><span>{{$user->userProfile->name}}</span><br>({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$age}}/ {{$user->userProfile->prefecture->name}})</p>
						<!-- <div class="evaluate three"></div> -->
						<p class="check"><a href="#">本人確認済み</a></p>
						<!-- <p class="check"><a href="#">機密保持契約(NDA) 可能</a></p> -->
						<div class="blogDtOtherBtn">
							<a href="#" class="followA">フォローする</a>
							@if(empty($dmrooms))
								<a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
							@else
								<a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
							@endif
						</div>
					</div>
				</aside><!-- /#side -->
			</div><!--inner-->
			<div class="aboutFeatures">
				<div class="inner">
					<h2 class="hdM">カリビトの特徴</h2>
					<div class="slider">
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">検索機能</h3>
							<p class="ico ico_feat02"></p>
							<p>あなたの見たい情報を簡単に探せる<br>ために検索機能があります。<br>条件を入力するだけで簡単です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">シェア機能</h3>
							<p class="ico ico_feat03"></p>
							<p>いいなと思った仕事をSNSを使って<br>シェアすることができます。<br>仲の良いメンバーに知らせる時に便利。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">お気に入り機能</h3>
							<p class="ico ico_feat04"></p>
							<p>気になる仕事や人材を<br>お気に入り登録をする事で<br>分からなくなることがありません。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
					</div>
				</div>
			</div>
			<div class="downloadWrap">
				<div class="inner">
					<div class="img"><img src="img/common/img_download.png" srcset="img/common/img_download.png 1x, img/common/img_download@2x.png 2x" alt=""><a href="#" target="_blank" class="logo sp"><img src="img/common/ico_sns_logo.svg" alt="LOGO"></a></div>
					<div class="info">
						<h2 class="tit">さあ、はじめよう！<span class="foucs">今すぐ無料ダウンロード！</span></h2>
						<div class="links">
							<a href="#" target="_blank" class="logo pc"><img src="img/common/ico_sns_logo.svg" alt="LOGO"></a>
							<a href="#" target="_blank"><img src="img/common/btn_app.svg" alt="App Store"></a>
							<a href="#" target="_blank"><img src="img/common/btn_google.svg" alt="Google"></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
        <x-hide-modal/>
	</article>
</x-other-user.layout>