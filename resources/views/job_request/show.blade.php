<x-layout>
	<article>
    	<div id="breadcrumb">
			<div class="inner">

                <a href="{{ route('home') }}">ホーム</a>　>　
                @if($job_request->user_id === Auth::id())
                    <a href="{{ route('mypage') }}">マイページ</a>　>　
                    <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                    <a href="{{(url()->current())}}">リクエストの詳細</a>
                @else
{{--                    <a href="service.html">サービスを探す</a>　>　--}}

                    {{--<a href="#"></a>@if(!is_null($job_request->title))  >  <span>{{ $job_request->title }}</span> @endif--}}
                @endif
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" class="detailStyle">
				<div class="inner02">
					<div class="clearfix">
						<div id="main">
							<div class="title">
								<div class="fun">
									<div class="single">
										<a href="#" tabindex="0"> {{ App\Models\JobRequest::IS_ONLINE[$job_request->is_online] }} </a>
									</div>
									<!-- <a href="#" class="favorite">お気に入り(11)</a> -->
								</div>
								<div class="datas">
									<span class="data">電話相談の受付：{{ App\Models\JobRequest::IS_CALL[$job_request->is_call] }}</span>
									<!-- <span class="data">閲覧：1000</span> -->
									@if(!is_null($job_request->prefecture_id))
										<span class="data">エリア：{{ App\Models\Prefecture::find($job_request->prefecture_id)->name }}</span>
									@endif
								</div>
							</div>
							<div class="drawIllustration">
								<h2 class="hdM">{{ $job_request->title }}</h2>
								<table>
									<tr>
										<th><span class="th">予算</span></th>
										<td><big>{{ number_format($job_request->price) }}円〜</big></td>
									</tr>
									<tr>
										<th><span class="th">残り時間</span></th>
										<td><big>{{ $diff_date_time['days'] }}日と{{ $diff_date_time['hours'] }}時間</big></td>
									</tr>
									@if(!is_null($job_request->required_date))
									<tr>
										<th><span class="th">納品希望日</span></th>
										<td>{{ date('Y年m月d日',strtotime($job_request->required_date)) }}</td>
									</tr>
									@endif
									<tr>
										<th><span class="th">掲載日</span></th>
										<td>{{ date('Y年m月d日', strtotime($job_request->created_at)) }}</td>
									</tr>
									<tr>
										<th><span class="th">締切日</span></th>
										<td>{{ date('Y年m月d日',strtotime($job_request->application_deadline)) }}</td>
									</tr>
									<!-- <tr>
										<th><span class="th">提案人数</span></th>
										<td>20人</td>
									</tr> -->
								</table>
							</div>
							<div class="content">
								<h2 class="hdM">サービス内容</h2>
								<p style="overflow-wrap: break-word;">{!! nl2br(e($job_request->content)) !!}</p>
							</div>
						</div>

						<aside id="side">
							<div class="box reservate">
								<h3>{{ number_format($job_request->price) }}円</h3>
								<p class="status">応募期限</p>
								<p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($job_request->application_deadline)) }}</p>
								@if(!is_null($job_request->required_date))
									<p class="status">納品希望日</p>
									<p class="date">{{ date('Y/m/d',strtotime($job_request->required_date)) }}</p>
								@endif
								<!-- <div class="calendar"><div id="datepicker"></div></div> -->
							</div>
							<div>
								<div class="peace">
									<h3>カリビト安心への取り組み</h3>
									<p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
								</div>
								@if($user->id === Auth::id() )
									<div class="functeBtns">
										<a href="{{ route('job_request.edit', $job_request->id ) }}" class="full orange">編集</a>
									</div>
									<form method="post" action="{{ route('job_request.destroy', $job_request->id ) }}">
										@csrf @method('delete')
										<div class="functeBtns">
											<input type="submit" class="full" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
										</div>
									</form>
								@else
									<div class="functeBtns">
										<a href="{{ route('chatroom.new.job_request', $job_request->id ) }}" class="orange full">交渉画面へ進む</a>
									</div>
								@endif
								<p class="specialtyBtn"><span>この情報をシェアする</span></p>
							</div>
							<div class="box seller">
								<h3>スキル出品者</h3>
									@if(empty($user->userProfile->icon))
										<a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
									@else
										<a href="#" class="head"><img src="{{asset('/storage/'.$user->userProfile->icon) }}" alt=""></a>
									@endif
								<!-- <p class="login">最終ログイン：8時間前</p> -->
								<p class="introd"><a href="#" class="name">{{ $user->name }}</a><br>({{ App\Models\UserProfile::GENDER[$user->userProfile->gender] }}/ {{ $age }} / {{ $user->userProfile->prefecture->name }})</p>
								<!-- <div class="evaluate three"></div> -->
								@if($user->userProfile->is_identify == 1)
									<p class="check"><a href="#">本人確認済み</a></p>
								@endif
							</div>
						</aside>
					</div>
				</div><!--inner02-->
			</form>
        </div><!--contents-->
    </article>
</x-layout>
<script type="text/javascript">
	$(function(){
		$( "#datepicker" ).datepicker();
	});

	var _content = [];
	var moreload = {
		_default:5, // 初期化により5つのメッセージが表示されます
		_loading:3, // 一度にさらに3つのアイテムを表示する
		init:function(){
			var lis = $(".clientEvaluate .ftBox li");
			$(".clientEvaluate ul").html("");
			for(var n=0;n<moreload._default;n++){
				lis.eq(n).appendTo(".clientEvaluate ul");
			}
			for(var i=moreload._default;i<lis.length;i++){
				_content.push(lis.eq(i));
			}
			$(".clientEvaluate .ftBox").html("");
		},
		loadMore:function(){
			var mLis = $(".clientEvaluate li").length;
			for(var i =0;i<moreload._loading;i++){
				var target = _content.shift();
				if(!target){
					$('.clientEvaluate .more').html("").addClass('load');
					break;
				}
				$(".clientEvaluate ul").append(target);
			}
		}
	}
	moreload.init();
</script>
