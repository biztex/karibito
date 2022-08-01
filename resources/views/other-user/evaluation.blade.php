<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
				<li><a href="#" class="is_active">評価</a></li>
				<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
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
					<div class="subPagesWrap evaluationWrap">
						<h2 class="subPagesHd">評価一覧</h2>
						<div class="evaluationStar">
							<span>総評</span>
							<div class="evaluate three"></div>
						</div>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
                                <li><a href="#tab_box01" class="is_active"><img src="/img/common/ico_like_top.png">良かった({{ $counts['good'] }})</a></li>
								<li><a href="#tab_box02" id="box02"><img src="/img/common/ico_like_middle.png">普通({{ $counts['usually'] }})</a></li>
								<li><a href="#tab_box03" id="box03"><img src="/img/common/ico_like_no.png">残念だった({{ $counts['pity'] }})</a></li>
							</ul>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="evaluationUl01">
                                @if($evaluations['good']->isEmpty())
                                        <p>「良かった」の評価はありません。</p>
                                @else
                                    @foreach($evaluations['good'] as $value)
                                    <li>
                                        <div class="img">
                                            <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                        </div>
                                        <div class="info">
                                            <p class="name">{{ $value->user->name }}</p>
                                            <div class="cont">
                                                <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                            </div>
                                        </div>
                                    </li>
									@endforeach
                                @endif
                                    {{ $evaluations['good']->fragment('')->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box02">
								<ul class="evaluationUl01">
                                @if($evaluations['usually']->isEmpty())
                                    <p>「普通」の評価はありません。</p>
                                @else
                                    @foreach($evaluations['usually'] as $value)
                                    <li>
                                        <div class="img">
                                            <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                        </div>
                                        <div class="info">
                                            <p class="name">{{ $value->user->name }}></p>
                                            <div class="cont">
                                                <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                    {{ $evaluations['usually']->fragment('usually')->links() }}
								</ul>
							</div>
							<div class="tabBox " id="tab_box03">
								<ul class="evaluationUl01">
                                @if($evaluations['pity']->isEmpty())
                                     <p>「残念だった」の評価はありません。</p>
                                @else
                                    @foreach($evaluations['pity'] as $value)
                                    <li>
                                        <div class="img">
                                            <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                                        </div>
                                        <div class="info">
                                            <p class="name">{{ $value->user->name }}</p>
                                            <div class="cont">
                                                <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
                                                <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                    {{ $evaluations['pity']->fragment('pity')->links() }}
								</ul>
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

						<p class="introd"><span>{{$user->name}}</span><br>({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$age}}/ {{$user->userProfile->prefecture->name}})</p>


						<!-- <div class="evaluate three"></div> -->
						<p class="check"><a href="#">本人確認済み</a></p>
						<!-- <p class="check"><a href="#">機密保持契約(NDA) 可能</a></p> -->
                        @if (\Auth::id() !== $user->id)
						    <div class="blogDtOtherBtn">
							<a href="#" class="followA">フォローする</a>
							@if(empty($dmrooms))
								<a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
							@else
								<a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
							@endif
                        @endif
						</div>
					</div>
				</aside><!-- /#side -->
			</div><!--inner-->
		</div><!-- /#contents -->
        <x-hide-modal/>
	</article>
</x-other-user.layout>
