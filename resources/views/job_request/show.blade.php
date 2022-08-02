<x-layout>
<x-parts.post-button/>
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
						
						@include('job_request.parts.show.detail')

						@include('job_request.parts.show.side')

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
