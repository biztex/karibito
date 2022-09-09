<x-layout>
<article>
<body id="news">
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<span>お知らせ</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">お知らせ</h2>
						<div class="">
							<ul class="mypageUl02 newsUl01">
								@if(empty($user_notifications[0]))
									<div class="pl10">カリビトからのお知らせがありません。</div>
								@else
									@foreach($user_notifications as $user_notification)
										<li>
											@if ($user_notification->reference_type === 'App\Models\Chatroom')
												<a href="{{route('chatroom.show', $user_notification->reference_id)}}" @if ($user_notification->is_view === 1) class="already" @endif>
											@elseif ($user_notification->reference_type === 'App\Models\Product')
												<a href="{{route('product.show', $user_notification->reference_id)}}" @if ($user_notification->is_view === 1) class="already" @endif>
											@elseif ($user_notification->reference_type === 'App\Models\JobRequest')
												<a href="{{route('job_request.show', $user_notification->reference_id)}}" @if ($user_notification->is_view === 1) class="already" @endif>
											@else
												<a href="{{route('user_notification.show', $user_notification->id)}}" @if ($user_notification->is_view === 1) class="already" @endif>
											@endif
											<dl>
												<dt><img src="img/mypage/img_notice01.png" alt=""></dt>
												<dd>
													<p class="txt">{{$user_notification->title}}</p>
													<p class="time">
														{{$user_notification->created_at->diffForHumans()}}
													</p>
												</dd>
											</dl>
											</a>
										</li>
									@endforeach
								@endif
							</ul>
						</div>
						{{ $user_notifications->links() }}
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>