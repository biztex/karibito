<x-layout>
	<article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>サービスをリクエストする</span>　>　<span>プレビュー</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		<div id="contents" class="detailStyle">
			@if(empty($job_request))
					<form class="contactForm" method="post" action="{{ route('job_request.store.preview') }}">
					@csrf
				@else
					<form class="contactForm" method="post" action="{{ route('job_request.update.preview',$job_request->id) }}">
					@csrf @method('put')
			@endif
			<input type="hidden" value="@if(!is_null($request->category_id)){{ $request->category_id }}@endif" name="category_id">
			<input type="hidden" value="@if(!is_null($request->application_deadline)){{ $request->application_deadline }}@endif" name="application_deadline">
			<input type="hidden" value="@if(!is_null($request->required_date)){{ $request->required_date }}@endif" name="required_date">

			<div class="inner02 ">
				<div class="clearfix">
				<div id="main">
					<div class="title">
						<div class="fun">
							<div class="single">
								<a href="#" tabindex="0">@if(!is_null($request->is_online)) {{ App\Models\JobRequest::IS_ONLINE[$request->is_online] }} @endif</a>
								<input type="hidden" value="@if(!is_null($request->is_online)){{ $request->is_online }}@endif" name="is_online">
							</div>
							<!-- <a href="#" class="favorite">お気に入り(11)</a> -->
						</div>
						<div class="datas">
							<span class="data">電話相談の受付：@if(!is_null($request->is_call)){{ App\Models\JobRequest::IS_CALL[$request->is_call] }} @endif</span>
								<input type="hidden" value="@if(!is_null($request->is_call)){{ $request->is_call }}@endif" name="is_call">
							<!-- <span class="data">閲覧：1000</span> -->
							<span class="data">エリア：@if(!is_null($request->prefecture_id)){{ App\Models\Prefecture::find($request->prefecture_id)->name }} @endif</span>
								<input type="hidden" value="@if(!is_null($request->prefecture_id)){{ $request->prefecture_id }}@endif" name="prefecture_id">
							<!-- <span class="data">販売数：無制限</span> -->
						</div>
						<h2><span>@if(!is_null($request->title)){{ $request->title }}@endif</span></h2>
							<input type="hidden" value="@if(!is_null($request->title)){{ $request->title }}@endif" name="title">
					</div>
					<!-- <div class="slider">
						<div class="big">
							<div class="item"><img src="img/service/img_slider_small03.jpg" srcset="img/service/img_slider_small03.jpg 1x, img/service/img_slider_small03.jpg 2x" alt=""></div>
							<div class="item"><img src="img/service/img_slider_big01.jpg" srcset="img/service/img_slider_big01.jpg 1x, img/service/img_slider_big01@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="img/service/img_slider_big.jpg" srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="img/service/img_slider_big.jpg" srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="img/service/img_slider_big.jpg" srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x" alt=""></div>
							<div class="item"><img src="img/service/img_slider_big.jpg" srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x" alt=""></div>
						</div>
						<div class="small">
							<div class="item"><img src="img/service/img_slider_small03.jpg" alt=""></div>
							<div class="item"><img src="img/service/img_slider_small04.jpg" alt=""></div>
							<div class="item"><img src="img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="img/service/img_slider_small.jpg" alt=""></div>
							<div class="item"><img src="img/service/img_slider_small.jpg" alt=""></div>
						</div>
					</div> -->
					<div class="content">
						<h2 class="hdM">サービス内容</h2>
						<p style="overflow-wrap: break-word;">@if(!is_null($request->content)) {!! nl2br(e($request->content)) !!} @endif</p>
							<textarea style="display:none;" name="content">@if(!is_null($request->content)){{ $request->content }}@endif</textarea>
					</div>
					<!-- <div class="optional">
						<h2 class="hdM">オプション追加料金</h2>
						<ul>
							<li><span class="add">＋ 新規１案デザイン製作</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ ヒアリング完了後、翌日初稿提出</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ イラストデザイン初稿提案数１案追加</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ 新規追加オプション</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ 新規追加オプション</span><span class="price">￥10,000</span></li>
						</ul>
					</div> -->
					<!-- <div class="optional faq">
						<h2 class="hdM">よくあるご質問</h2>
						<ul class="toggleWrapPC">
							<li>
								<p class="quest toggleBtn"><span>どんな方におすすめですか？</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">どんな方におすすめですかどんな方におすすめですかどんな方におすすめですかどんな方におすすめですか</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
						</ul>
					</div> -->
				</div>
				<aside id="side" class="pc">
					<div class="box reservate">
						<h3>@if(!is_null($request->price)) {{ number_format($request->price) }} @endif円</h3>
						<input type="hidden" value="@if(!is_null($request->price)){{ $request->price }}@endif" name="price">
						<p class="status">予約状況</p>
						<p class="date">5日</p>
						<div class="calendar"><div id="datepicker"></div></div>
					</div>
					<div>
						<div class="peace">
							<h3>カリビト安心への取り組み</h3>
							<p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
						</div>
						<div class="functeBtns">
							<a href="javascript:history.back();" class="orange_o">編集画面に戻る</a>
						</div>
						<div class="functeBtns">
							<input type="submit" name="regist" class="orange" style="color:white;" value="サービス提供を開始">
						</div>
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
			</form>
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
