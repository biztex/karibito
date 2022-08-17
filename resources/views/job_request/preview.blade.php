<x-layout>
	<article>
    	<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                @if(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/create')
                    <a href="{{ route('post') }}">投稿する</a>　>　
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
					@csrf
					<input type="hidden" value="{{ $job_request->id }}" name="id">
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

						@include('job_request.parts.preview.main')

						@include('job_request.parts.preview.side')
						
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
