<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                @if(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/product/create')
                    <a href="{{ route('post') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスを提供する</a>　>　
                @else
                    <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                    <a href="{{(url()->previous())}}">サービスを編集する</a>　>　
                @endif
                    <a href="{{ route('product.preview') }}">プレビュー</a>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="detailStyle">
            <form class="contactForm" method="post" action="{{ route('product.store.preview') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $request->category_id }}" name="category_id">
                <input type="hidden" value="{{ $request->number_of_sale }}" name="number_of_sale">
                <input type="hidden" value="{{ $request->status }}" name="status">
                <div class="inner02 ">
                    <div class="clearfix">
                        
                        @include('product.parts.preview.main')
                        
                        @include('product.parts.preview.side')
                        
                    </div>
                </div><!--inner-->
            </form>
        </div>
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
