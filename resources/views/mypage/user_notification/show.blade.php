<x-layout>
	<article id="user_notification" class="user_notification_show">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{route('home')}}">ホーム</a>　>　<a href="{{route('user_notification.index')}}">お知らせ</a>　>　<span>{{$user_notification->title}}</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.post-button/>
		<div class="btnFixed"><a href="#"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">{{$user_notification->title}}</h2>
						<div class="newsDtWrap">
							<p class="date">{{date('Y/m/d', strtotime($user_notification->created_at))}}</p>
							<div class="cont pre-wrap break-word">{!!$user_notification->content!!}</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>