<x-layout>
    <body id="estimate" class="friends-page">
        <x-parts.post-button/>
        <x-parts.ban-msg/>
        <article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>フォロ・フォロワー</span>
			</div>
		</div><!-- /.breadcrumb -->
        <x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">フォロ・フォロワー</h2>
						<div class="friendsTop">
							<ul>
								<li>
									<p class="number">{{ count($followings) }}</p>
									<p class="txt">フォロー中</p>
								</li>
								<li>
									<p class="number">{{ count($followeds) }}</p>
									<p class="txt">フォロワー</p>
								</li>
							</ul>
						</div>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">フォロー中</a></li>
								<li><a href="#tab_box02">フォロワー</a></li>
							</ul>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="friendsUl01">
                                    @foreach ($followings as $following)
                                    <li>
										<a href="{{ route('user.mypage', $following->followingUser->id) }}">
											<div class="user">
                                                @if(null !== $following->followingUser->userProfile->icon)
                                                    <dt><img src="{{ asset('/storage/'.$following->followingUser->userProfile->icon) }}" alt="" style="height:132px;"></dt>
                                                @else
                                                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                @endif
												<div class="introd">
													<p class="name">{{ $following->followingUser->name }}</p>
													<p>({{ App\Models\UserProfile::GENDER[$following->followingUser->userProfile->gender] }}/
                                                        {{ $following->followingUser->userProfile->age }}代/
                                                        {{ $following->followingUser->userProfile->prefecture->name}})</p>
												</div>
											</div>
											<x-parts.evaluation-star :star='$following->followingUser->avg_star'/>
										</a>
									</li>
                                    @endforeach
								</ul>
							</div>
							<div class="tabBox" id="tab_box02">
								<ul class="friendsUl01">
									@foreach ($followeds as $followed)
                                    <li>
										<a href="{{ route('user.mypage', $followed->followedUser->id) }}">
											<div class="user">
												@if(null !== $followed->followedUser->userProfile->icon)
                                                    <dt><img src="{{ asset('/storage/'.$followed->followedUser->userProfile->icon) }}" alt="" style="height:132px;"></dt>
                                                @else
                                                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                @endif
												<div class="introd">
													<p class="name">{{ $followed->followedUser->name }}</p>
													<p>({{ App\Models\UserProfile::GENDER[$followed->followedUser->userProfile->gender] }}/
                                                        {{ $followed->followedUser->userProfile->age }}代/
                                                        {{ $followed->followedUser->userProfile->prefecture->name}})</p>
												</div>
											</div>
                                            <x-parts.evaluation-star :star='$followed->followedUser->avg_star'/>
										</a>
									</li>
                                    @endforeach
								</ul>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
                <x-side-menu/>
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
	</article>
</x-layout>
</body>
</div><!-- /#wrapper -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="js/jquery.biggerlink.min.js"></script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
$(function(){

});
</script>
</body>
</html>
