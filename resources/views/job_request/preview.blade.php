<x-layout>
	<article>
    	<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                @if(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/create')
                    <a href="{{ route('product.index') }}">投稿する</a>　>　
                    <a href="{{ route('job_request.create') }}">リクエストを提供する</a>　>　
                @else
                    <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                    <a href="{{(url()->previous())}}">リクエストを編集する</a>　>　
                @endif
                <a href="{{ route('job_request.preview') }}">プレビュー</a>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" class="detailStyle">
			@if(empty($job_request))
					<form class="contactForm" method="post" action="{{ route('job_request.store.preview') }}">
					@csrf
				@else
					<form class="contactForm" method="post" action="{{ route('job_request.update.preview',$job_request->id) }}">
					@csrf @method('put')
			@endif
				<input type="hidden" value="{{ $request->category_id }}" name="category_id">
				<input type="hidden" value="{{ $request->title }}" name="title">
				<input type="hidden" value="{{ $request->application_deadline }}" name="application_deadline">
				<input type="hidden" value="{{ $request->is_online }}" name="is_online">
				<input type="hidden" value="{{ $request->is_call }}" name="is_call">
				<input type="hidden" value="{{ $request->price }}" name="price">
				<input type="hidden" value="@if(!is_null($request->required_date)){{ $request->required_date }}@endif" name="required_date">
				<input type="hidden" value="@if(!is_null($request->prefecture_id)){{ $request->prefecture_id }}@endif" name="prefecture_id">
				<textarea style="display:none;" name="content">{{ $request->content }}</textarea>

				<div class="inner02">
					<div class="clearfix">
						<div id="main">
							<div class="title">
								<div class="fun">
									<div class="single">
										<a href="#" tabindex="0"> {{ App\Models\JobRequest::IS_ONLINE[$request->is_online] }} </a>
									</div>
									<!-- <a href="#" class="favorite">お気に入り(11)</a> -->
								</div>
								<div class="datas">
									<span class="data">電話相談の受付：{{ App\Models\JobRequest::IS_CALL[$request->is_call] }}</span>
									<!-- <span class="data">閲覧：1000</span> -->
									<span class="data">エリア：@if(!is_null($request->prefecture_id)){{ App\Models\Prefecture::find($request->prefecture_id)->name }} @endif</span>
								</div>
							</div>
							<div class="drawIllustration">
								<h2 class="hdM">{{ $request->title }}</h2>
								<table>
									<tr>
										<th><span class="th">予算</span></th>
										<td><big>{{ number_format($request->price) }}円〜</big></td>
									</tr>
									<tr>
										<th><span class="th">残り時間</span></th>
										<td><big>{{ $diff_date_time['days'] }}日と{{ $diff_date_time['hours'] }}時間</big></td>
									</tr>
									@if(!is_null($request->required_date)) 
									<tr>
										<th><span class="th">納品希望日</span></th>
										<td>{{ date('Y年m月d日',strtotime($request->required_date)) }}</td>
									</tr>
									@endif
									<tr>
										<th><span class="th">掲載日</span></th>
										<td>{{ date('Y年m月d日', strtotime(today())) }}</td>
									</tr>
									<tr>
										<th><span class="th">締切日</span></th>
										<td>{{ date('Y年m月d日',strtotime($request->application_deadline)) }}</td>
									</tr>
									<!-- <tr>
										<th><span class="th">提案人数</span></th>
										<td>20人</td>
									</tr> -->
								</table>
							</div>
							<div class="content">
								<h2 class="hdM">サービス内容</h2>
								<p style="overflow-wrap: break-word;">{!! nl2br(e($request->content)) !!}</p>
							</div>					

						</div>

						<aside id="side" class="pc">
							<div class="box reservate">
								<h3>{{ number_format($request->price) }}円</h3>
								<p class="status">応募期限</p>
								<p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($request->application_deadline)) }}</p>
								@if(!is_null($request->required_date)) 
									<p class="status">納品希望日</p>
									<p class="date">{{ date('Y/m/d',strtotime($request->required_date)) }}</p>
								@endif
								<!-- <div class="calendar"><div id="datepicker"></div></div> -->
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
									<input type="submit" name="regist" class="orange full" style="color: #fff;font-weight:700;box-shadow: 0 6px 0 #d85403;height: 55px;font-size: 1.8rem;" value="サービス提供を開始">
								</div>
								<p class="specialtyBtn"><span>この情報をシェアする</span></p>
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
