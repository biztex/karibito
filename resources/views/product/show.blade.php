<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
            @if($product->user_id === Auth::id() )
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                <a href="{{(url()->current())}}">サービス提供の詳細</a>
            @else
                <a href="service.html">サービスを探す</a>　>　
                <a href="#">@if(!is_null($product->category_id)){{$product->mProductChildCategory->mProductCategory->name}} @endif</a>　>　
                <a href="#">@if(!is_null($product->category_id)){{$product->mProductChildCategory->name}} @endif</a>　>　<span>{{$product->title}}</span>
            @endif
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.ban-msg/>

        <div id="contents" class="detailStyle">
            <div class="inner02 ">
                <div class="clearfix">
                    <div id="main">

                        @include('product.parts.show.detail')

                        @include('product.parts.show.evaluation')

                    </div>

                    @include('product.parts.show.side')
                    
                </div>
                
                @include('product.parts.show.others')

            </div><!--inner-->
    </article>
</x-layout>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker();
    });

    var _content = [];
    var moreload = {
        _default: 5, // 初期化により5つのメッセージが表示されます
        _loading: 3, // 一度にさらに3つのアイテムを表示する
        init: function () {
            var lis = $(".clientEvaluate .ftBox li");
            $(".clientEvaluate ul").html("");
            for (var n = 0; n < moreload._default; n++) {
                lis.eq(n).appendTo(".clientEvaluate ul");
            }
            for (var i = moreload._default; i < lis.length; i++) {
                _content.push(lis.eq(i));
            }
            $(".clientEvaluate .ftBox").html("");
        },
        loadMore: function () {
            var mLis = $(".clientEvaluate li").length;
            for (var i = 0; i < moreload._loading; i++) {
                var target = _content.shift();
                if (!target) {
                    $('.clientEvaluate .more').html("").addClass('load');
                    break;
                }
                $(".clientEvaluate ul").append(target);
            }
        }
    }
    moreload.init();
</script>
