<x-layout>
    <x-parts.post-button/>{{--投稿ボタンの読み込み--}}
<article>
	<body id="mypage">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>マイページ</span>
			</div>
		</div><!-- /.breadcrumb -->

		@if(empty($user_profile->identification_path))
			<div class="unregisteredP">
				<div> </div>
				<div>△サービスの登録には身分証明書の登録が必要です。 <a href="#fancybox_register"  class="fancybox fancybox_register">登録する</a></div>
				<div class="pop_close">×</div>
			</div>
		@endif

		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="mypageWrap">
						<div class="mypageSec01">
						<div class="mypageCover">
							@if(!empty($user_profile->cover))
								<img src="{{asset('/storage/'.$user_profile->cover) }}" style="width: 100%;height: 100%;object-fit: cover;">
							@else
								<img src="/img/mypage/img_rainbow.png" style="width: 100%;height: 100%;object-fit: cover;">
							@endif

							<form method="POST" action="{{ route('cover.update') }}" enctype="multipart/form-data">
								@csrf @method('PUT')
									<input type="file" name="cover" class="cover1" style="display:none;">
									<label for="file" class="update_cover"><img class="add_cover" src="/img/mypage/icon_cover.svg" alt="カバー写真を追加"></label>
									<input type="submit" name="submit_cover" style="display:none;">
							</form>

							</div>
							<dl class="mypageDl01">
								@if(empty($user_profile->icon))
								    <dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
								@else
								     <dt><img src="{{asset('/storage/'.$user_profile->icon) }}" alt="" style="width: 140px;height: 140px;object-fit: cover;"></dt>
								@endif
								<dd>
									<p class="mypageP01">{{$user_profile->user->name}} <a href="#fancybox_person" class="fancybox fancybox_profile"><img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></p>
									<!-- <p class="mypageP02">最終ログイン：8時間前</p> -->
									<p class="mypageP03">({{App\Models\UserProfile::GENDER[$user_profile->gender]}} / {{$age}} / {{$user_profile->prefecture->name}}) <!-- <span>所持ポイント：0000pt</span> --></p>
									<p class="mypageP04 check">
										@if($user_profile->is_identify == 1)
											<a href="#">本人確認済み</a>
										@endif
										<!-- <a href="#">機密保持契約(NDA) 可能</a></p> -->
									<p class="mypageP05"><a href="{{ route('evaluation') }}" class="more">過去の評価を詳しく見る</a></p>
									<div class="mypageP06">
										<div class="evaluate three"></div><a href="#">(3.0)</a>
									</div> 
								</dd>
						</dl>
							<div class="mypageIntro">
								<p class="mypageHd01">自己紹介</p>
								<p class="mypageIntroTxt">{!! nl2br(e($user_profile->introduction)) !!}</p>
							</div>
							<div class="mypageProud">
								@if($specialties->isNotEmpty())
								<p class="mypageHd01">得意分野</p>
								@endif
								<ul class="mypageProudUl">
									@foreach($specialties as $specialty)
									<li>{{ $specialty->content }}</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="mypageShare"><a href="#">お友達を紹介して300pt GETする</a></div>
						<div class="mypageSec02">
							<p class="mypageHd02">お知らせ<a href="{{ route('user_notification.index') }}" class="more">お知らせをもっと見る</a></p>
							<ul class="mypageUl02">
								@if(empty($user_notifications[0]))
                                    <div class="pl10">カリビトからのお知らせがありません。</div>
                                @else
                                    @foreach($user_notifications as $user_notification)
										<li>
											<a href="{{route('user_notification.show', $user_notification->id)}}">
												<dl>
													<dt><img src="img/mypage/img_notice01.png" alt=""></dt>
													<dd>
														<p class="txt">{{$user_notification->title}}</p>
														<p class="time">{{$user_notification->created_at->diffForHumans()}}</p>
													</dd>
												</dl>
											</a>
										</li>
                                    @endforeach
                                @endif
							</ul>
						</div>
						<div class="mypageSec03">
							<p class="mypageHd02">出品サービス<a href="#" class="more">出品サービスを編集する</a></p>
							<div class="box">
								<p class="title">出品サービス</p>
								<p class="txt">カリビトは、知識・スキル・経験を売り買いできるオンラインマーケットです。<br>あなたの ”得意” や ”経験” を必要としている人がきっといます。<br>カリビトで出品してみませんか？</p>
								<p class="link "><a href="#" class="more">追加する</a></p>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->

		</div><!-- /#contents -->
		<x-hide-modal/>
	</body>
</article>
</x-layout>
