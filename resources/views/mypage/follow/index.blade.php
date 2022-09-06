<x-layout>
    <div id="friends">
    <body id="estimate">
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
									<p class="number">{{ $followings->total() }}</p>
									<p class="txt">フォロー中</p>
								</li>
								<li>
									<p class="number">{{ $followeds->total() }}</p>
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
                                {{ $followings->links() }}
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
                                {{ $followeds->links() }}
							</div>
						</div>
					</div>
				</div><!-- /#main -->
                <x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
    <x-hide-modal/>
    </body>
    </div>
</x-layout>
