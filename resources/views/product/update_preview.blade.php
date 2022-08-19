<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>サービスを提供する</span>　>　<span>プレビュー</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="detailStyle">
            <form class="contactForm" method="post" action="{{ route('product.update.preview',$product->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="@if(!is_null($request->category_id)){{ $request->category_id }}@endif" name="category_id">
                <input type="hidden" value="@if(!is_null($request->number_of_sale)){{ $request->number_of_sale }}@endif" name="number_of_sale">
                <input type="hidden" value="@if(!is_null($request->status)){{ $request->status }}@endif" name="status">
                <input type="hidden" value="{{ $product->id }}" name="id">
                <div class="inner02 ">
                    <div class="clearfix">

                        @include('product.parts.preview.update-main')

                        @include('product.parts.preview.side')

                    </div>
                </div><!--inner-->
            </form>
        </div>
    </article>
</x-layout>
<script>
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
