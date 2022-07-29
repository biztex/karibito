<x-other-user.layout>
<body id="estimate" class="dm-page">
	<x-parts.post-button/>
	<x-parts.ban-msg/>
	<article>
		{{-- パンクズがない --}}
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
												<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
											@else
												<p class="ico"><img src="{{ asset('/storage/'.$dmroom_user->toUser->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover; border-radius: 50%;"></p>
											@endif
											<div class="introd">
												<p class="name">{{ $dmroom_user->toUser->name }}</p>
											</div>
										@else
											@if($dmroom_user->fromUser->userProfile->icon === null)
												<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
											@else
												<p class="ico"><img src="{{ asset('/storage/'.$dmroom_user->fromUser->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover; border-radius: 50%;"></p>
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
		<x-hide-modal/>
	</body>
</article>
</x-layout>