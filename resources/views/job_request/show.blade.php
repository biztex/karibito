<x-layout>
	<article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>  >  <a href="#">掲載一覧</a>@if(!is_null($job_request->title))  >  <span>{{ $job_request->title }}</spa> @endif
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		<x-parts.flash-msg/>
		<div id="contents" class="detailStyle">
			<div class="inner02 ">
				<div class="clearfix">
				<div id="main">
					<div class="title">
						<div class="fun">
							<div class="single">
								<a href="#" tabindex="0">@if(!is_null($job_request->is_online)) {{ App\Models\JobRequest::IS_ONLINE[$job_request->is_online] }} @endif</a>
							</div>
							<!-- <a href="#" class="favorite">お気に入り(11)</a> -->
						</div>
						<div class="datas">
							<span class="data">電話相談の受付：@if(!is_null($job_request->is_call)){{ App\Models\JobRequest::IS_CALL[$job_request->is_call] }} @endif</span>
							<!-- <span class="data">閲覧：1000</span> -->
							<span class="data">エリア：@if(!is_null($job_request->prefecture_id)){{ $job_request->prefecture->name }} @endif</span>
							<!-- <span class="data">販売数：無制限</span> -->
						</div>
						<h2><span>{{ $job_request->title }}</span></h2>
					</div>
					<!-- <div class="slider">
						<div class="big">
							<div class="item"><img src="/img/service/img_slider_small03.jpg" srcset="/img/service/img_slider_small03.jpg 1x, /img/service/img_slider_small03.jpg 2x" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_big01.jpg" srcset="/img/service/img_slider_big01.jpg 1x, /img/service/img_slider_big01@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_big.jpg" srcset="/img/service/img_slider_big.jpg 1x, /img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_big.jpg" srcset="/img/service/img_slider_big.jpg 1x, /img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_big.jpg" srcset="/img/service/img_slider_big.jpg 1x, /img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_big.jpg" srcset="/img/service/img_slider_big.jpg 1x, /img/service/img_slider_big@2x.jpg 2x" alt=""></div>
						</div>
						<div class="small">
							<div class="item"><img src="/img/service/img_slider_small03.jpg" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_small04.jpg" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
						</div>
					</div> -->
					<div class="content">
						<h2 class="hdM">サービス内容</h2>
						<p style="overflow-wrap: break-word;">@if(!is_null($job_request->content)) {!! nl2br(e($job_request->content)) !!} @endif</p>
					</div>

				</div>
				<aside id="side" class="pc">
					<div class="box reservate">
						<h3>@if(!is_null($job_request->price)) {{ number_format($job_request->price) }} @endif円</h3>
						<p class="status">応募期限</p>
						<p class="date" style="margin-bottom:10px;height:33.5px;">@if(!is_null($job_request->application_deadline)) {{ date('Y/m/d',strtotime($job_request->application_deadline)) }}@endif</p>
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
						@endif
					</div>
					<div class="box seller">
						<h3>スキル出品者</h3>
								@if(empty($user->userProfile->icon))
									<a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
								@else
									<a href="#" class="head"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt=""></a>
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
        </div><!--inner-->
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
