<x-layout>
<body id="estimate" class="dm-page">
	<x-parts.post-button/>
	<x-parts.ban-msg/>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>DM</span>
			</div>
		</div><!-- /.breadcrumb -->
	<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<p class="subPagesHd">DM</p>
						<div class="">
							@if(empty($dmroom_users[0]))
								<p class="name">DMはありません。</p>
							@else
							<ul class="mypageUl02 friendsUl02">
								@foreach($dmroom_users as $dmroom_user)
								<li>
									<a href="{{ route('dm.show', $dmroom_user->id) }}">
										<div class="user">
										@if($dmroom_user->from_user_id === Auth::id())
											@if($dmroom_user->toUser->userProfile->icon === null)
												<a href="{{ route('user.mypage', $dmroom_user->toUser->id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
											@else
												<a href="{{ route('user.mypage', $dmroom_user->toUser->id) }}" class="ico"><img src="{{ asset('/storage/'.$dmroom_user->toUser->userProfile->icon) }}" alt=""></a>
											@endif
											<div class="introd">
												<p class="name">{{ $dmroom_user->toUser->name }}</p>
											</div>
										@else
											@if($dmroom_user->fromUser->userProfile->icon === null)
												<a href="{{ route('user.mypage', $dmroom_user->fromUser->id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
											@else
												<a href="{{ route('user.mypage', $dmroom_user->fromUser->id) }}" class="ico"><img src="{{ asset('/storage/'.$dmroom_user->fromUser->userProfile->icon) }}" alt=""></a>
											@endif
											<div class="introd">
												<p class="name">{{ $dmroom_user->fromUser->name }}</p>
											</div>
										@endif
										</div>
											<p class="time">{{ $dmroom_user->dmroomMessages->last()->created_at->diffForHumans() }}</p>
									</a>
								</li>
								@endforeach
							</ul>
							{{ $dmroom_users->links() }}
							@endif
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>